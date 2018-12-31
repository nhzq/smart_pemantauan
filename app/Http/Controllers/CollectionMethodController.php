<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class CollectionMethodController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.methods.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.methods.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $open_date = null;
        $close_date = null;
        $meeting_date = null;

        if ($request->method_open_date) {
            $open_date = Carbon::createFromFormat('d/m/Y', $request->method_open_date);
        }

        if ($request->method_close_date) {
            $close_date = Carbon::createFromFormat('d/m/Y', $request->method_close_date);
        }

        if ($request->method_meeting_date) {
            $meeting_date = Carbon::createFromFormat('d/m/Y', $request->method_meeting_date);
        }

        $project = Project::find($project_id);
        $project->collection_file_no = $request->method_file_no;
        $project->collection_open_date = $open_date;
        $project->collection_close_date = $close_date;
        $project->duration = $request->method_duration;
        $project->collection_meeting_date = $meeting_date;
        $project->updated_by = \Auth::user()->id;
        $project->save();

        return redirect()
            ->route('methods.index', $project_id)
            ->with('success', 'Kaedah perolehan telah berjaya disimpan');
    }
}
