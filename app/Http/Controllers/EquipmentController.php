<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Equipment;
use App\Models\EquipmentElectric;
use App\Models\EquipmentGas;
use App\Models\EquipmentProcess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Block $block)
    {
        return view('block.equipment', [
            'block'         => $block,
            'gases'         => EquipmentGas::all(),
            'electrics'     => EquipmentElectric::all(),
            'equipments'    => Equipment::where('block_id', $block->id)->get()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Block $block)
    {
        if ($request->type == 'Gas') {
            $validator = Validator::make($request->all(), [
                'type'      => 'required',
                'equipment_gas_id' => 'required',
                'flowmeter' => 'required',
                'activity'  => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('message', 'Failed to submit');
            }
            $validated = $validator->validated();
        } else {
            $validator = Validator::make($request->all(), [
                'type'      => 'required',
                'equipment_electric_id' => 'required',
                'volt'      => 'required',
                'ampere'    => 'required',
                'activity'  => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('message', 'Failed to submit');
            }
            $validated = $validator->validated();
        }
        $validated['status'] = $block->status;
        $validated['user_id'] = auth()->user()->id;
        $validated['block_id'] = $block->id;

        Equipment::create($validated);
        return back()->with('message', 'Equipment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block, Equipment $equipment)
    {
        if ($equipment->type === 'Gas') {
            $tools = EquipmentGas::firstWhere('id', $equipment->equipment_gas_id);
        } else {
            $tools = EquipmentElectric::firstWhere('id', $equipment->equipment_electric_id);
        }
        return response()->json([
            'equipment' => $equipment,
            'block' => $block,
            'tools' => $tools
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block, Equipment $equipment)
    {
        if ($request->type == 'Gas') {
            $validator = Validator::make($request->all(), [
                'type'      => 'required',
                'equipment_gas_id' => 'required',
                'flowmeter' => 'required',
                'activity'  => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('message', 'Failed to submit');
            }
            $validated = $validator->validated();
        } else {
            $validator = Validator::make($request->all(), [
                // 'type'      => 'required',
                'equipment_electric_id' => 'required',
                'volt'      => 'required',
                'ampere'    => 'required',
                'activity'  => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('message', 'Failed to submit');
            }
            $validated = $validator->validated();
        }

        $equipment->update($validated);
        return back()->with('message', 'Equipment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block, Equipment $equipment)
    {
        $equipment->delete();

        return back()->with('message', 'Equipment Deleted');
    }

    public function finished(Block $block, Equipment $equipment)
    {
        $finish = Carbon::now();

        $start = $equipment->created_at;
        $duration = $start->diffInSeconds($finish);

        if ($equipment->type == 'Gas') {
            $duration = $duration / 60; // Seconds to Minutes
            $flowmeter = $equipment->flowmeter;
            $density = $equipment->equipment_gas->density;
            $liter = ($duration * $flowmeter) / 1000;
            $gas_usage = $liter * $density;

            EquipmentProcess::create([
                'block_id'          => $block->id,
                'equipment_id'      => $equipment->id,
                'equipment_type'    => $equipment->type,
                'gas_usage'         => $gas_usage
            ]);
        } else {
            $duration = $duration / 3600; // Seconds to Hours
            $volt = $equipment->volt;
            $ampere = $equipment->ampere;
            $kiloWatt = ($volt * $ampere * (0.5 ** (1 / 3))) / 1000;
            $kWh = $duration * $kiloWatt;

            $wbp_limit1 = new Carbon('17:00:00');
            $wbp_limit2 = new Carbon('22:00:00');
            if ($finish->greaterThan($wbp_limit1) && $finish->lessThan($wbp_limit2)) {
                $period = 'LWBP';
            } else {
                $period = 'WBP';
            }

            EquipmentProcess::create([
                'block_id'          => $block->id,
                'equipment_id'      => $equipment->id,
                'equipment_type'    => $equipment->type,
                'period'            => $period,
                'kWh'               => $kWh
            ]);
        }

        $equipment->update([
            'stopped_at'    => $finish
        ]);

        return back()->with('message', 'Equipment Updated');
    }

    public function get_report(Block $block)
    {
        return view('block.report-usage', [
            'electrics' => EquipmentProcess::where('equipment_type', 'Electric')->where('block_id', $block->id)->get(),
            'gases'     => EquipmentProcess::where('equipment_type', 'Gas')->where('block_id', $block->id)->get(),
            'block'     => $block
        ]);
    }
}
