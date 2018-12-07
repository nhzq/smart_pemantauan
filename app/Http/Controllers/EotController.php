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
}
