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

        $planningStatuses = [10, 11];

        if ($project->status <= 8 || in_array($project->status, $planningStatuses)) {
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
        $contract_agreement_date = null;
        $contract_review_date = null;
        $contract_receive_date = null;

        if (!empty($project->contract)) {
            if (!empty($request->contract_agreement_date)) {
                $contract_agreement_date = Carbon::createFromFormat('d/m/Y', $request->contract_agreement_date);
            }

            if (!empty($request->contract_review_date)) {
                $contract_review_date = Carbon::createFromFormat('d/m/Y', $request->contract_review_date);
            }

            if (!empty($request->contract_review_date)) {
                $contract_review_date = Carbon::createFromFormat('d/m/Y', $request->contract_review_date);
            }

            if (!empty($request->contract_receive_date)) {
                $contract_receive_date = Carbon::createFromFormat('d/m/Y', $request->contract_receive_date);
            }

            $project->contract->project_id = $project_id;
            $project->contract->title = $request->contract_title;
            $project->contract->contract_no = $request->contract_no;
            $project->contract->agreement_date = $contract_agreement_date;
            $project->contract->puu_review_date = $contract_review_date;
            $project->contract->puu_receive_date = $contract_receive_date;
            $project->contract->updated_by = \Auth::user()->id;
            $project->contract->active = 1;
            $project->contract->save();

            return redirect()
                ->route('contracts.index', $project->id)
                ->with('success', 'Maklumat butiran kontrak telah berjaya dikemaskini.');
        } else {
            if (!empty($request->contract_agreement_date)) {
                $contract_agreement_date = Carbon::createFromFormat('d/m/Y', $request->contract_agreement_date);
            }

            if (!empty($request->contract_review_date)) {
                $contract_review_date = Carbon::createFromFormat('d/m/Y', $request->contract_review_date);
            }

            if (!empty($request->contract_review_date)) {
                $contract_review_date = Carbon::createFromFormat('d/m/Y', $request->contract_review_date);
            }

            if (!empty($request->contract_receive_date)) {
                $contract_receive_date = Carbon::createFromFormat('d/m/Y', $request->contract_receive_date);
            }

            $contract = new Contract;
            $contract->project_id = $project_id;
            $contract->title = $request->contract_title;
            $contract->contract_no = $request->contract_no;
            $contract->agreement_date = $contract_agreement_date;
            $contract->puu_review_date = $contract_review_date;
            $contract->puu_receive_date = $contract_receive_date;
            $contract->created_by = \Auth::user()->id;
            $contract->active = 1;
            $contract->save();

            return redirect()
                ->route('contracts.index', $project->id)
                ->with('success', 'Maklumat butiran kontrak telah berjaya dikemaskini.');
        }
    }
}
