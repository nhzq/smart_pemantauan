<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class GanttController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);
        $activity = $project->schedules;

        return view('modules.planning-gantt.index', [
            'project' => $project,
            'activity' => $activity
        ]);
    }   
}
