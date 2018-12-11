<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DeliverController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.deliver.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.deliver.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $deliverable_date = null;
        $official_date = null;

        if (!empty($request->deliverable_date)) {
            $deliverable_date = \Carbon\Carbon::parse($request->deliverable_date);
        }

        if (!empty($request->official_date)) {
            $official_date = \Carbon\Carbon::parse($request->official_date);
        }

        $project->deliver()->create([
            'project_id' => $project->id, 
            'officer_name' => $request->officer_name,
            'position' => $request->officer_position,
            'deliverable_date' => $deliverable_date,
            'official_deliverable_date' => $official_date,
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
            ->route('deliverables.index', $project->id)
            ->with('success', 'Serahan projek telah berjaya dikemaskini.');
    }
}
