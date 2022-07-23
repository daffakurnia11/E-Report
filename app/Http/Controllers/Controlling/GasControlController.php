<?php

namespace App\Http\Controllers\Controlling;

use App\Http\Controllers\Controller;
use App\Models\GasEquipment;
use App\Models\Project;
use Illuminate\Http\Request;

class GasControlController extends Controller
{
    public function index()
    {
        // return Project::with(['block' => fn ($query) => $query->with(['equipment' => fn ($query) => $query->with('equipment_gas')->get()])->get()])->get();
        return view('controlling.gas_index', [
            'projects'      => Project::all(),
            'equipments'    => GasEquipment::all(),
        ]);
    }
}
