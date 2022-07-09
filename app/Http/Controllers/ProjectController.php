<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.index', [
            'projects'      => Project::all(),
            'managers'      => User::where('roles', 'PM')->get()
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
            'code'              => 'required|unique:projects',
            'ship_name'         => 'required',
            'ship_owner'        => 'required',
            'ship_size'         => 'required',
            'contract_start'    => 'required',
            'contract_ended'    => 'required',
            'user_id'           => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect('/project')->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();

        Project::create($validated);
        return redirect('/project')->with('message', 'Project Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if ($project->user_id) {
            $user = User::firstWhere('id', $project->user_id);
        } else {
            $user = null;
        }
        return response()->json(['project' => $project, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if ($project->code != $request->code) {
            $codeValidator = 'required|unique:projects';
        } else {
            $codeValidator = 'required';
        }

        $validator = Validator::make($request->all(), [
            'code'              => $codeValidator,
            'ship_name'         => 'required',
            'ship_owner'        => 'required',
            'ship_size'         => 'required',
            'contract_start'    => 'required',
            'contract_ended'    => 'required',
            'user_id'           => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect('/project')->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();

        $project->update($validated);
        return redirect('/project')->with('message', 'Project Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/project')->with('message', 'Project Deleted');
    }

    public function mark_as_done(Project $project)
    {
        $project->update([
            'status'    => 'Finished'
        ]);
        return redirect('/project')->with('message', 'Project Finished');
    }

    public function add_pm(Request $request, Project $project)
    {
        $project->update([
            'user_id'   => $request->user_id
        ]);
        return redirect('/project')->with('message', 'Project Assigned');
    }

    public function pm_project()
    {
        return view('project.pm-project', [
            'projects'  => Project::where('user_id', auth()->user()->id)->get()
        ]);
    }
}
