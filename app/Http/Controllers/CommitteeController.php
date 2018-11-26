<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class CommitteeController extends Controller
{
    public function project($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.collections.index', [
            'project' => $project
        ]);
    }

    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.committees.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        return view('modules.committees.create');
    }
}
