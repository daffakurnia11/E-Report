<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectPlan;
use Illuminate\Support\Facades\Validator;

class ElectricPlanController extends Controller
{
    public function index()
    {
        return view('planning.electric_index', [
            'projects'      => Project::all(),
        ]);
    }

    public function create(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'total_kWh' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Planning failed']);
        }

        $validated = $validator->validated();

        $plans = ProjectPlan::where('project_id', $project->id)->get();
        if ($plans) {
            foreach ($plans as $plan) {
                $plan->delete();
            }
        }

        for ($i = 0.2; $i <= 1; $i = $i + 0.2) {
            ProjectPlan::create([
                'project_id'        => $project->id,
                'project_code'      => $project->code,
                'plan_type'         => 'Electric',
                'period_interval'   => $i,
                'total_kWh'         => $validated['total_kWh'],
            ]);
        }

        return response()->json(['message' => 'Planning success', 'plan' => $validated['total_kWh']]);
    }

    public function show(Project $project)
    {
        return view('planning.electric_show', [
            'electric_plans'    => ProjectPlan::where('project_code', $project->code)->where('plan_type', 'Electric')->get(),
            'project'           => $project
        ]);
    }

    public function update(Request $request, Project $project, ProjectPlan $projectPlan)
    {
        $validator = Validator::make($request->all(), [
            'electric_plan' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Planning failed']);
        }

        $validated = $validator->validated();
        $projectPlan->update($validated);
        return response()->json(['message' => 'Planning success', 'plan' => $projectPlan]);
    }
}
