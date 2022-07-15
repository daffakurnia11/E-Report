<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Equipment;
use App\Models\EquipmentElectric;
use App\Models\EquipmentGas;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'watt'      => 'required',
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        //
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
                'watt'      => 'required',
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
        $equipment->update([
            'stopped_at'    => Carbon::now()
        ]);

        return back()->with('message', 'Equipment Updated');
    }
}
