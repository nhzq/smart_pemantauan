<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ScopeController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.scopes.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.scopes.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $project->scope = $request->scope_contract;
        $project->save();

        return redirect()
            ->route('scopes.index', $project->id)
            ->with('success', 'Skop Kontrak telah berjaya dikemaskini.');
    }
}
