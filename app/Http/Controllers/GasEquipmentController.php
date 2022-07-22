<?php

namespace App\Http\Controllers;

use App\Models\GasEquipment;
use Illuminate\Http\Request;

class GasEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('equipment.gas-management', [
            'items' => GasEquipment::all()
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
        $message = [
            'name.required' => 'Equipment name must be filled.',
            'name.unique'   => 'Equipment name has already taken.'
        ];
        $validated = $request->validate([
            'name'  => 'required|unique:gas_equipment'
        ], $message);

        GasEquipment::create($validated);
        return back()->with('message', 'Equipment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GasEquipment  $gasEquipment
     * @return \Illuminate\Http\Response
     */
    public function show(GasEquipment $gasEquipment)
    {
        return response()->json(['equipment' => $gasEquipment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GasEquipment  $gasEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GasEquipment $gasEquipment)
    {
        $message = [
            'name.required' => 'Equipment name must be filled.',
            'name.unique'   => 'Equipment name has already taken.'
        ];
        if ($request->name == $gasEquipment->name) {
            $validator = 'required';
        } else {
            $validator = 'required|unique:gas_equipment';
        }

        $validated = $request->validate([
            'name'  => $validator
        ], $message);

        $gasEquipment->update($validated);
        return back()->with('message', 'Equipment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GasEquipment  $gasEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(GasEquipment $gasEquipment)
    {
        $gasEquipment->delete();

        return back()->with('message', 'Equipment Deleted');
    }
}
