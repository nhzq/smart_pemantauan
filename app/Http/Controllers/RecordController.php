<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Record;

class RecordController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.records.index', [ 
            'project' => $project
        ]);
    }

    public function create($project_id, Request $request)
    {
        $project = Project::find($project_id);

        return view('modules.records.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);

        if (!empty($project->record)) {
            $project->record->project_id = $project_id;
            $project->record->record_type = $request->record_type;
            $project->record->authorized_officer = $request->record_officer;
            $project->record->record_location = $request->record_location;
            $project->record->updated_by = \Auth::user()->id;
            $project->record->active = 1;
            $project->record->save();

            return redirect()
                ->route('records.index', $project->id)
                ->with('success', 'Rekod telah berjaya dikemaskini');
        } else {
            $record = new Record;
            $record->project_id = $project_id;
            $record->record_type = $request->record_type;
            $record->authorized_officer = $request->record_officer;
            $record->record_location = $request->record_location;
            $record->created_by = \Auth::user()->id;
            $record->active = 1;
            $record->save();

            return redirect()
                ->route('records.index', $project->id)
                ->with('success', 'Rekod telah berjaya dikemaskini');
        }
    }
}
