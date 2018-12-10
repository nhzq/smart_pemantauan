<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class LadController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.lad.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.lad.create', [
            'project' => $project
        ]);
    }
}
