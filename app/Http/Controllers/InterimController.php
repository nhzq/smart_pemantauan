<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class InterimController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.interim.index', [
            'project' => $project
        ]);
    }
}
