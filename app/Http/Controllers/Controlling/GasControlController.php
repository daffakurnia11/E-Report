<?php

namespace App\Http\Controllers\Controlling;

use App\Http\Controllers\Controller;
use App\Models\GasEquipment;
use App\Models\Block;
use App\Models\Project;
use App\Models\ProjectPlan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class GasControlController extends Controller
{
    public function index()
    {
        return view('controlling.gas_index', [
            'projects'      => Project::all(),
            'equipments'    => GasEquipment::all(),
        ]);
    }

    public function equipment_detail(GasEquipment $gasEquipment)
    {
        return view('controlling.gas_equipment_index', [
            'projects'      => Project::all(),
            'equipments'    => GasEquipment::all(),
            'gasEquipment'  => $gasEquipment
        ]);
    }

    public function show(GasEquipment $gasEquipment, Project $project)
    {
        $start = Carbon::parse($project->contract_start);
        $ended = Carbon::parse($project->contract_ended);
        $diff = $start->diffInMonths($ended);

        $result = [];
        $sCurve = 0;

        $plans = ProjectPlan::where('project_code', $project->code)->where('plan_type', 'Gas')->where('gas_equipment_id', $gasEquipment->id)->get();

        foreach (CarbonPeriod::create($project->contract_start, '1 month', $project->contract_ended) as $month) {
            $monthParam = $month->format('m');
            $yearParam = $month->format('Y');
            $blocks = Block::where('project_id', $project->id)->with([
                'equipment' => fn ($query) => $query->whereYear('stopped_at', $yearParam)->whereMonth('stopped_at', $monthParam)->with('equipment_process')
            ])->get();
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
            $sCurve = $sCurve + $gas_usage;
            $temp = [];
            $temp['month'] = $month->format('m Y');
            $temp['gas_usage'] = $gas_usage;
            $temp['sCurve'] = $sCurve;
            $result[] = $temp;
        }

        $interpolation = [];
        $dataInter = [];

        foreach ($plans as $plan) {
            $dataInter['period'] = $plan->period_interval;
            $dataInter['month'] = floatVal($plan->period_interval * $diff);
            $dataInter['x1'] = floor($plan->period_interval * $diff);
            $dataInter['x2'] = ceil($plan->period_interval * $diff);
            for ($i = 1; $i < count($result); $i++) {
                if ($i == $dataInter['x1']) {
                    $dataInter['y1'] = $result[$i - 1]['sCurve'];
                }
                if ($i == $dataInter['x2']) {
                    $dataInter['y2'] = $result[$i - 1]['sCurve'];
                }
            }
            if ($dataInter['x2'] - $dataInter['x1'] > 0) {
                $interpolationCalc = (($dataInter['y2'] - $dataInter['y1']) / ($dataInter['x2'] - $dataInter['x1'])) * ($dataInter['month'] - $dataInter['x1']);
            } else {
                $interpolationCalc  = 0;
            }
            $dataInter['gas_usage'] = ($interpolationCalc) + $dataInter['y1'];
            $interpolation[] = $dataInter['gas_usage'];
        }


        return view('controlling.gas_show', [
            'gas_plans'         => $plans,
            'project'           => $project,
            'equipments'        => GasEquipment::all(),
            'gasEquipment'      => $gasEquipment,
            'diff'              => $diff,
            'monthly_datas'     => $result,
            'interpolation'     => $interpolation
        ]);
    }
}
