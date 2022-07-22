<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Project;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ElectricReportController extends Controller
{
    public function index()
    {
        return view('report.electric-index', [
            'projects'      => Project::all(),
        ]);
    }

    public function show(Project $project)
    {
        return view('report.electric-show', [
            'project'   => $project,
            'blocks'    => Block::where('project_id', $project->id)->get()
        ]);
    }

    public function monthly_usage(Project $project)
    {
        $result = [];

        $start = $project->contract_start;
        $finish = $project->contract_ended;

        foreach (CarbonPeriod::create($start, '1 month', $finish) as $month) {
            $monthParam = $month->format('m');
            $blocks = Block::where('project_id', $project->id)->with([
                'equipment' => fn ($query) => $query->whereMonth('stopped_at', $monthParam)->with('equipment_process')
            ])->get();

            $monthlist[] = $month->format('m Y');
            $kWh = 0;
            foreach ($blocks as $block) {
                foreach ($block->equipment as $item) {
                    $kWh += $item->equipment_process->kWh;
                }
            }
            $result['kWh'][] = $kWh;
        }

        // return $result;
        return response()->json([
            'monthlist' => $monthlist,
            'data' => $result,
        ]);
    }
}
