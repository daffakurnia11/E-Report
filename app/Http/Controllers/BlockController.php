<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return view('block.block-project', [
            'project'   => $project,
            'blocks'    => Block::where('project_id', $project->id)->get(),
            'managers'  => User::where('roles', 'PIC')->get()
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
        $validator = Validator::make($request->all(), [
            'block_name'        => 'required',
            'block_weight'      => 'required|numeric',
            'sequence'          => 'required',
            'user_id'           => 'required',
            'build_start'       => 'required',
            'build_ended'       => 'required',
            'filename'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:5128'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();
        $validated['status'] = 'Waiting for approval';
        $validated['project_id'] = $project->id;

        if ($request->hasFile('filename')) {
            $imageFile = $validated['block_name'] . '-Block.' . $request->filename->extension();
            $validated['filename'] = $imageFile;
            $request->filename->move(public_path('files/block/'), $imageFile);
        }
        Block::create($validated);
        return back()->with('message', 'Block Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Block $block)
    {
        if ($block->user_id) {
            $user = User::firstWhere('id', $block->user_id);
        } else {
            $user = null;
        }
        return response()->json(['project' => $project, 'block' => $block, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Block $block)
    {
        $validator = Validator::make($request->all(), [
            'block_name'        => 'required',
            'block_weight'      => 'required|numeric',
            'sequence'          => 'required',
            'user_id'           => 'nullable',
            'build_start'       => 'required',
            'build_ended'       => 'required',
            'filename'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:5128'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Failed to submit');
        }

        $validated = $validator->validated();
        $validated['project_id'] = $project->id;

        if ($request->hasFile('filename')) {
            if ($block->filename) {
                unlink('files/block/' . $block->filename);
            }
            $imageFile = $validated['block_name'] . '-Block.' . $request->filename->extension();
            $validated['filename'] = $imageFile;
            $request->image->move(public_path('files/block/'), $imageFile);
        }

        $block->update($validated);
        return back()->with('message', 'Block Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Block $block)
    {
        if ($block->filename) {
            unlink('files/block/' . $block->filename);
        }
        $block->delete();
        return back()->with('message', 'Block Deleted');
    }

    public function pic_block()
    {
        return view('block.my-block', [
            'blocks'    => Block::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function pic_approval(Block $block)
    {
        $block->update([
            'status'    => 'Preparation'
        ]);
        return back()->with('message', 'Block Approved');
    }
}
