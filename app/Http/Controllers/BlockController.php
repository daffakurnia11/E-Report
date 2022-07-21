<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Equipment;
use App\Models\EquipmentElectric;
use App\Models\EquipmentGas;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

    public function approval(Block $block)
    {
        $block->update([
            'status'    => 'Preparation'
        ]);
        return back()->with('message', 'Block Approved');
    }

    public function update_status(Block $block)
    {
        $canUpdate = true;
        $equipment = Equipment::where('block_id', $block->id)->get();
        foreach ($equipment as $item) {
            if (!$item->stopped_at) {
                $canUpdate = false;
            }
        }
        if (!$canUpdate) {
            return back()->with('message', 'Block update failed');
        } else {
            switch ($block->status) {
                case 'Preparation':
                    $status = 'Fabrication';
                    break;
                case 'Fabrication':
                    $status = 'Sub Assembly';
                    break;
                case 'Sub Assembly':
                    $status = 'Assembly';
                    break;
                default:
                    $status = 'Erection';
                    break;
            }
            $block->update([
                'status'    => $status
            ]);
            return back()->with('message', 'Block update success');
        }
    }

    public function report(Project $project)
    {
        return view('project.report-block', [
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
            $gas_usage = 0;
            $kWh = 0;
            foreach ($blocks as $block) {
                foreach ($block->equipment as $item) {
                    $gas_usage += $item->equipment_process->gas_usage;
                    $kWh += $item->equipment_process->kWh;
                }
            }
            $result['kWh'][] = $kWh;
            $result['gas_usage'][] = $gas_usage;
        }

        // return $result;
        return response()->json([
            'monthlist' => $monthlist,
            'data' => $result,
        ]);
    }
}
