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
            $deliverable_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->deliverable_date);
        }

        if (!empty($request->official_date)) {
            $official_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->official_date);
        }

        if (count($project->deliver) == 0) {
            $project->deliver()->create([
                'project_id' => $project->id, 
                'officer_name' => $request->officer_name,
                'position' => $request->officer_position,
                'deliverable_date' => $deliverable_date,
                'official_deliverable_date' => $official_date,
                'created_by' => \Auth::user()->id,
                'active' => 1
            ]);
        } else {
            $deliver = $project->deliver;
            $deliver->project_id = $project->id;
            $deliver->officer_name = $request->officer_name;
            $deliver->position = $request->officer_position;
            $deliver->deliverable_date = $deliverable_date;
            $deliver->official_deliverable_date = $official_date;
            $deliver->updated_by = \Auth::user()->id;
            $deliver->save();
        }
        

        return redirect()
            ->route('deliverables.index', $project->id)
            ->with('success', 'Serahan projek telah berjaya dikemaskini.');
    }
}
