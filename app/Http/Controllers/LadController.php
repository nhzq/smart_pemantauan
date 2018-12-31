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
        $diff = '';

        if (!empty($project->contractorAppointment)) {
            $start_date = $project->contractorAppointment->contract_start_date;
            $end_date = $project->contractorAppointment->contract_end_date;
            $eot = $project->eots->last()->extend_date;
            $diff = 0;

            if (!empty($eot)) {
                $diff = $start_date->diffInDays($eot);
            } else if (!empty($end_date)) {
                $diff = $start_date->diffInDays($end_date);
            }
        }

        return view('modules.lad.create', [
            'project' => $project,
            'diff' => $diff
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $payment_amount = null;

        if (!empty($request->payment_amount)) {
            $payment_amount = removeMaskMoney($request->payment_amount);
        }

        if (count($project->lads) == 0) {
            $project->lads()->create([
                'total_days' => $request->total_fine_days,
                'total_fine' => $payment_amount,
                'action' => $request->action_taken,
                'created_by' => \Auth::user()->id,
                'active' => 1
            ]);
        } else {
            $lad = $project->lads[0];
            $lad->total_days = $request->total_fine_days;
            $lad->total_fine = $payment_amount;
            $lad->action = $request->action_taken;
            $lad->updated_by = \Auth::user()->id;
            $lad->save();
        }

        return redirect()
            ->route('lad.index', $project->id)
            ->with('success', 'Bayaran Ganti Rugi (LAD) telah berjaya dikemaskini.');
    }
}
