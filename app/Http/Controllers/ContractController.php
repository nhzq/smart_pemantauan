<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contract;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function project($project_id)
    {
        $project = Project::find($project_id);

        if ($project->status <= 11 || $project->status == 13) {
            return redirect()
                ->back()
                ->with('error', 'Maaf, projek masih lagi di fasa perancangan.');
        }

        return view('modules.developments.index', [
            'project' => $project
        ]);
    }

    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.contracts.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.contracts.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);

        if (!empty($project->contract)) {
            $project->contract->project_id = $project_id;
            $project->contract->title = $request->contract_title;
            $project->contract->contract_no = $request->contract_no;
            $project->contract->aggreement_date = Carbon::parse($request->contract_agreement_date);
            // $project->contract->agreement_date = Carbon::parse($request->contract_agreement_date);
            $project->contract->cost = removeMaskMoney($request->contract_cost);
            $project->contract->puu_review_date = Carbon::parse($request->contract_review_date);
            $project->contract->puu_receive_date = Carbon::parse($request->contract_receive_date);
            // $project->contract->duration = $request->duration
            $project->contract->updated_by = \Auth::user()->id;
            $project->contract->active = 1;
            $project->contract->save();

            return redirect()
                ->route('contracts.index', $project->id)
                ->with('success', 'Maklumat butiran kontrak telah berjaya dikemaskini.');
        } else {
            $contract = new Contract;

            $contract->project_id = $project_id;
            $contract->title = $request->contract_title;
            $contract->contract_no = $request->contract_no;
            $contract->aggreement_date = Carbon::parse($request->contract_agreement_date);
            // $contract->agreement_date = Carbon::parse($request->contract_agreement_date);
            $contract->cost = removeMaskMoney($request->contract_cost);
            $contract->puu_review_date = Carbon::parse($request->contract_review_date);
            $contract->puu_receive_date = Carbon::parse($request->contract_receive_date);
            // $contract->duration = $request->duration
            $contract->created_by = \Auth::user()->id;
            $contract->active = 1;
            $contract->save();

            return redirect()
                ->route('contracts.index', $project->id)
                ->with('success', 'Maklumat butiran kontrak telah berjaya dikemaskini.');
        }
    }
}
