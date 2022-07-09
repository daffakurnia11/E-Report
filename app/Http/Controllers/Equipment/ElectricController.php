<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\EquipmentElectric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ElectricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('equipment.electric', [
            'items'     => EquipmentElectric::all()
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
            'name'          => 'required',
            'volt'          => 'required|numeric',
            'ampere'        => 'required|numeric',
            'watt'          => 'required|numeric',
            'power_factor'  => 'required|numeric',
            'quantity'      => 'required|numeric',
            'spesification' => 'nullable'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();
        $validated['user_id'] = auth()->user()->id;

        EquipmentElectric::create($validated);
        return back()->with('message', 'Equipment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentElectric  $equipmentElectric
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentElectric $equipmentElectric)
    {
        return response()->json(['equipment' => $equipmentElectric]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipmentElectric  $equipmentElectric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentElectric $equipmentElectric)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'volt'          => 'required|numeric',
            'ampere'        => 'required|numeric',
            'watt'          => 'required|numeric',
            'power_factor'  => 'required|numeric',
            'quantity'      => 'required|numeric',
            'spesification' => 'nullable'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();

        $equipmentElectric->update($validated);
        return back()->with('message', 'Equipment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentElectric  $equipmentElectric
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentElectric $equipmentElectric)
    {
        $equipmentElectric->delete();
        return back()->with('message', 'Equipment Deleted');
    }
}
