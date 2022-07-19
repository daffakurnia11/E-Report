<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.plan_index', [
            'projects'      => Project::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        if ($request->plan_type == 'Gas') {
            $validator = Validator::make($request->all(), [
                'plan_type'     => 'required',
                'month'         => 'required',
                'year'          => 'required|numeric',
                'gas_plan'      => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'plan_type'     => 'required',
                'month'         => 'required',
                'year'          => 'required|numeric',
                'electric_plan' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();
        $validated['month'] = $request->month . ' ' . $request->year;
        $validated['project_id'] = $project->id;
        $validated['project_code'] = $project->code;
        ProjectPlan::create($validated);
        return back()->with('message', 'Planning created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.plan_show', [
            'electric_plans'    => ProjectPlan::where('project_code', $project->code)->where('plan_type', 'Electric')->get(),
            'gas_plans'         => ProjectPlan::where('project_code', $project->code)->where('plan_type', 'Gas')->get(),
            'project'           => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, ProjectPlan $projectPlan)
    {
        return response()->json(['project' => $project, 'plan' => $projectPlan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, ProjectPlan $projectPlan)
    {
        if ($request->plan_type == 'Gas') {
            $validator = Validator::make($request->all(), [
                'plan_type'     => 'required',
                'month'         => 'required',
                'year'          => 'required|numeric',
                'gas_plan'      => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'plan_type'     => 'required',
                'month'         => 'required',
                'year'          => 'required|numeric',
                'electric_plan' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();
        $validated['month'] = $request->month . ' ' . $request->year;
        $projectPlan->update($validated);
        return back()->with('message', 'Planning updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, ProjectPlan $projectPlan)
    {
        $projectPlan->delete();
        return back()->with('message', 'Planning deleted');
    }
}
