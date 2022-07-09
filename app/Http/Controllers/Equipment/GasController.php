<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\EquipmentGas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('equipment.gas', [
            'items'     => EquipmentGas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gas_filter'        => 'required',
            'flowmeter'         => 'required|numeric',
            'capacity'          => 'nullable|numeric',
            'unit'              => 'nullable',
            'quantity'          => 'required|numeric',
            'density'           => 'nullable',
            'activity'          => 'nullable'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();
        $validated['user_id'] = auth()->user()->id;

        EquipmentGas::create($validated);
        return back()->with('message', 'Equipment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentGas  $equipmentGas
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentGas $equipmentGas)
    {
        return response()->json(['equipment' => $equipmentGas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipmentGas  $equipmentGas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentGas $equipmentGas)
    {
        $validator = Validator::make($request->all(), [
            'gas_filter'        => 'required',
            'flowmeter'         => 'required|numeric',
            'capacity'          => 'nullable|numeric',
            'unit'              => 'nullable',
            'quantity'          => 'required|numeric',
            'density'           => 'nullable',
            'activity'          => 'nullable'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();

        $equipmentGas->update($validated);
        return back()->with('message', 'Equipment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentGas  $equipmentGas
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentGas $equipmentGas)
    {
        $equipmentGas->delete();
        return back()->with('message', 'Equipment Deleted');
    }
}
