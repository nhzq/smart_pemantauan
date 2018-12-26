<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class InterimController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.interims.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.interims.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $payment_date = null;
        $amount = '';

        if (!empty($request->payment_date)) {
            $payment_date = \Carbon\Carbon::parse($request->payment_date);
        }

        if (!empty($request->payment_amount)) {
            $amount = removeMaskMoney($request->payment_amount);
        }

        $project->interims()->create([
            'project_id' => $project->id,
            'payment_type' => $request->payment_type,
            'payment_no' => $request->payment_no,
            'payment_date' => $payment_date,
            'amount' => $amount,
            'description' => $request->description,
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
            ->route('interims.index', $project_id)
            ->with('success', 'Maklumat Pembayaran Kontrak telah dikemaskini.');
    }

    public function notify($project_id, $interim_id)
    {
        $project = Project::find($project_id);

        $interim = $project->interims()
            ->where('id', $interim_id)
            ->where('active', 1)
            ->first();

        $interim->status = 1;
        $interim->updated_by = \Auth::user()->id;
        $interim->save();

        return redirect()
            ->back()
            ->with('success', 'Maklumat pembayaran kontrak telah pun di kemaskini untuk Unit Kewangan.');
    }
}
