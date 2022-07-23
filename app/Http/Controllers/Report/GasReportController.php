<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\GasEquipment;
use App\Models\Project;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class GasReportController extends Controller
{
    public function index()
    {
        return view('report.gas-index', [
            'projects'      => Project::all(),
            'equipments'    => GasEquipment::all()
        ]);
    }

    public function equipment_index(GasEquipment $gasEquipment)
    {
        return view('report.gas-equipment-index', [
            'projects'      => Project::all(),
            'equipments'    => GasEquipment::all(),
            'equipment'     => $gasEquipment
        ]);
    }

    public function show(GasEquipment $gasEquipment, Project $project)
    {
        return view('report.gas-show', [
            'project'       => $project,
            'blocks'        => Block::where('project_id', $project->id)->get(),
            'equipments'    => GasEquipment::all(),
            'equipment'     => $gasEquipment
        ]);
    }

    public function monthly_usage(GasEquipment $gasEquipment, Project $project)
    {
        $result = [];

        $start = $project->contract_start;
        $finish = $project->contract_ended;

        foreach (CarbonPeriod::create($start, '1 month', $finish) as $month) {
            $monthParam = $month->format('m');
            $yearParam = $month->format('Y');
            $blocks = Block::where('project_id', $project->id)->with([
                'equipment' => fn ($query) => $query->whereYear('stopped_at', $yearParam)->whereMonth('stopped_at', $monthParam)->with('equipment_process')
            ])->get();

            $monthlist[] = $month->format('m Y');
            $gas_usage = 0;
            foreach ($blocks as $block) {
                foreach ($block->equipment as $item) {
                    if ($item->type == 'Gas') {
                        if ($item->equipment_gas->gas_equipment_id == $gasEquipment->id) {
                            $gas_usage += $item->equipment_process->gas_usage;
                        }
                    }
                }
            }
            $result['gas_usage'][] = $gas_usage;
        }

        // return $result;
        return response()->json([
            'monthlist' => $monthlist,
            'data' => $result,
        ]);
    }
}
