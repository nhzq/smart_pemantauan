<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class BondController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.bond.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.bond.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $total_payment = 0;

        if (!empty($request->total_payment)) {
            $total_payment = removeMaskMoney($request->total_payment);
        }

        $project->bond()->create([
            'project_id' => $project->id,
            'guarantee_money' => $request->guarantee_money,
            'total_payment' => $total_payment,
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
                ->route('bond.index', $project->id)
                ->with('success', 'Maklumat Bon Perlaksanaan telah berjaya disimpan.');
    }
}
