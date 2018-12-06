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
        $project = Project::find($project_id);
        $project->collection_file_no = $request->method_file_no;
        $project->collection_open_date = Carbon::parse($request->method_open_date);
        $project->collection_close_date = Carbon::parse($request->method_close_date);
        $project->duration = $request->method_duration;
        $project->collection_meeting_date = Carbon::parse($request->method_meeting_date);
        $project->save();


        return redirect()
            ->route('methods.index', $project_id)
            ->with('success', 'Kaedah perolehan telah berjaya disimpan');
    }
}
