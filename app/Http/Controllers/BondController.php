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
        $bond_value = 0;

        if (!empty($request->total_payment)) {
            $total_payment = removeMaskMoney($request->total_payment);
        }

        if (!empty($request->bond_value)) {
            $bond_value = removeMaskMoney($request->bond_value);
        }

        $bond = $project->bond()->where('active', 1)->first();

        if (!empty($bond)) {
            $bond->project_id = $project->id;
            $bond->guarantee_money = $request->guarantee_money;
            $bond->total_payment = $total_payment;
            $bond->bond_value = $bond_value;
            $bond->bank_name = $request->bank_name;
            $bond->start_date = setDateValue($request->start_date, \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date));
            $bond->end_date = setDateValue($request->end_date, \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date));
            $bond->notes = $request->notes;
            $bond->updated_by = \Auth::user()->id;
            $bond->active = 1;
            $bond->save();
        } else {
            $project->bond()->create([
                'project_id' => $project->id,
                'guarantee_money' => $request->guarantee_money,
                'total_payment' => $total_payment,
                'bond_value' => $bond_value,
                'bank_name' => $request->bank_name,
                'start_date' => setDateValue($request->start_date, \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)),
                'end_date' => setDateValue($request->end_date, \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)),
                'notes' => $request->notes,
                'created_by' => \Auth::user()->id,
                'active' => 1
            ]);
        }

        return redirect()
                ->route('bond.index', $project->id)
                ->with('success', 'Maklumat Bon Perlaksanaan telah berjaya disimpan.'); 
    }
}
