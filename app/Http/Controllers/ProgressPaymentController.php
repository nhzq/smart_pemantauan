<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Interim;

class ProgressPaymentController extends Controller
{
    public function index()
    {
        $projects = Project::where('active', 1)->get();

        return view('modules.financial.payment.index', [
            'projects' => $projects
        ]);
    }

    public function list($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.financial.payment.list', [
            'project' => $project
        ]);
    }

    public function approve($project_id, $id)
    {
        $project = Project::find($project_id);
        $interim = $project->interims->where('id', $id)->first();

        $interim->status = 2;
        $interim->updated_by = \Auth::user()->id;
        $interim->save();

        return redirect()
            ->back()
            ->with('success', 'Bayaran Kemajuan telah berjaya dikemaskini.');
    }
}
