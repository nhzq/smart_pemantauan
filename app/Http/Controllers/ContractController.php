<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ContractController extends Controller
{
    public function project($project_id)
    {
        $project = Project::find($project_id);

        if ($project->status <= 11 || $project->status == 13) {
            return redirect()
                ->back()
                ->with('error', 'Maaf, projek masih lagi di fasa perancangan.');
        }

        return view('modules.developments.index', [
            'project' => $project
        ]);
    }

    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.contracts.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.contracts.create', [
            'project' => $project
        ]);
    }
}
