<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class EotController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.eot.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.eot.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $extend_date = null;

        if (!empty($request->extend_date)) {
            $extend_date = \Carbon\Carbon::parse($request->extend_date);
        }

        $project->eots()->create([
            'project_id' => $project->id,
            'extend_date' => $extend_date,
            'reason' => $request->reasons,
            'action' => $request->action_taken,
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
            ->route('eot.index', $project->id)
            ->with('success', 'Lanjutan Masa (EOT) telah berjaya dikemaskini.');
    }
}
