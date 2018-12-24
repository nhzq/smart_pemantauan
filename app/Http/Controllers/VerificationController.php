<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Helpers\Status;

class VerificationController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.verifications.index', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $project->verification_date = \Carbon\Carbon::parse($request->verification_date);
        $project->verified_by = \Auth::user()->id;
        $project->status = Status::project_verification();
        $project->save();

        return redirect()
            ->route('info.index', $project->id)
            ->with('success', 'Maklumat projek telah berjaya dihantar untuk pengesahan.');
    }
}
