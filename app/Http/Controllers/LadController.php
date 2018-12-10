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
        $start_date = $project->contractorAppointment->contract_start_date;
        $end_date = $project->contractorAppointment->contract_end_date;
        $eot = $project->eots->last()->extend_date;
        $diff = 0;

        if (!empty($eot)) {
            $diff = $start_date->diffInDays($eot);
        } else if (!empty($end_date)) {
            $diff = $start_date->diffInDays($end_date);
        }

        return view('modules.lad.create', [
            'project' => $project,
            'diff' => $diff
        ]);
    }
}
