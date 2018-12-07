<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class MeetingController extends Controller
{
    public function index($project_id)
    {
        $project = PRoject::find($project_id);

        return view('modules.meetings.index', [
            'project' => $project
        ]);
    }
}
