<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class ResultController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.results.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.results.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $project->actual_approval_date = Carbon::createFromFormat('d/m/Y', $request->result_approval_date);
        $project->actual_project_cost = removeMaskMoney($request->result_actual_project_cost);
        $project->justification = $request->result_justification;
        $project->save();

        return redirect()
            ->route('results.index', $project_id)
            ->with('success', 'Keputusan Perolehan telah dikemaskini');
    }
}
