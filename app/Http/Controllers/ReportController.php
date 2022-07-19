<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentProcess;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function gas_usage()
    {
        return view('report.gas-usage', [
            'equipments'    => EquipmentProcess::where('equipment_type', 'Gas')->get()
        ]);
    }

    public function electric_usage()
    {
        return view('report.electric-usage', [
            'equipments'    => EquipmentProcess::where('equipment_type', 'Electric')->get()
        ]);
    }
}
