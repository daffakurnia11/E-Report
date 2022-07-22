<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Models\GasEquipment;
use App\Models\Project;
use App\Models\ProjectPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GasPlanController extends Controller
{
    public function index()
    {
        return view('planning.gas_index', [
            'projects'      => Project::all(),
            'equipments'    => GasEquipment::all()
        ]);
    }

    public function equipment_index(GasEquipment $gasEquipment)
    {
        return view('planning.gas_equipment_index', [
            'projects'      => Project::all(),
            'equipments'    => GasEquipment::all(),
            'equipment'     => $gasEquipment
        ]);
    }
    public function create(Request $request, GasEquipment $gasEquipment, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'total_plan' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Planning failed']);
        }

        $validated = $validator->validated();

        $plans = ProjectPlan::where('project_id', $project->id)->where('plan_type', 'Gas')->where('gas_equipment_id', $gasEquipment->id)->get();
        if ($plans) {
            foreach ($plans as $plan) {
                $plan->delete();
            }
        }

        for ($i = 0.2; $i <= 1; $i = $i + 0.2) {
            ProjectPlan::create([
                'project_id'        => $project->id,
                'project_code'      => $project->code,
                'plan_type'         => 'Gas',
                'gas_equipment_id'  => $gasEquipment->id,
                'period_interval'   => $i,
                'total_plan'        => $validated['total_plan'],
            ]);
        }

        return response()->json(['message' => 'Planning success', 'plan' => $validated['total_plan']]);
    }

    public function show(GasEquipment $gasEquipment, Project $project)
    {
        return view('planning.gas_show', [
            'gas_plans'     => ProjectPlan::where('project_code', $project->code)->where('gas_equipment_id', $gasEquipment->id)->where('plan_type', 'Gas')->get(),
            'equipments'    => GasEquipment::all(),
            'equipment'     => $gasEquipment,
            'project'       => $project
        ]);
    }

    public function update(Request $request, ProjectPlan $projectPlan)
    {
        $validator = Validator::make($request->all(), [
            'persen_plan' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Planning failed']);
        }

        $validated = $validator->validated();
        $projectPlan->update($validated);
        return response()->json(['message' => 'Planning success', 'plan' => $projectPlan]);
    }
}
