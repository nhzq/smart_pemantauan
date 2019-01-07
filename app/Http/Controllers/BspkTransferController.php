<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BspkTransfer as Bspk;
use App\Models\Project;
use Carbon\Carbon;
use App\Models\LookupSubBudgetType as Sub;

class BspkTransferController extends Controller
{
    public function index() 
    {
        $bspk = Bspk::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->paginate(20);

        return view('modules.financial.transfer.BSPK.index', [
            'bspk' => $bspk
        ]);
    }

    public function create()
    {
        $subs = Sub::where('lookup_budget_type_id', 2)->get();

        return view('modules.financial.transfer.BSPK.create', [
            'subs' => $subs
        ]);
    }

    public function ajaxType(Request $request)
    {
        $data = Project::where('lookup_sub_budget_type_id', $request->id)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->get();

        return response()->json($data);
    }

    public function ajaxProject(Request $request)
    {
        $project = Project::where('id', $request->id)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        $actual_cost = !empty($project->actual_project_cost) ? $project->actual_project_cost : 0;
        $estimate_cost = !empty($project->estimate_cost) ? $project->estimate_cost : 0;

        $from_transfer = 0;
        $to_transfer = 0;
        $net_bspk = getEstimateCostBalance($actual_cost, $estimate_cost);

        if (!empty($project->bspkTransfers)) {
            $from_transfer = $project->bspkTransfers()
                ->where('from_project_id', $project->id)
                ->where('active', 1)
                ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            $to_transfer = $project->bspkTransfers()
                ->where('to_project_id', $project->id)
                ->where('active', 1)
                ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            if ($from_transfer > 0) {
                $net_bspk = $net_bspk - $from_transfer;
            }

            if ($to_transfer > 0) {
                $net_bspk = $net_bspk + $to_transfer;
            }
        }

        $data = [
            'amount' => $estimate_cost,
            'balance' => $net_bspk
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (empty($request->from_sub) || empty($request->to_sub)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Sila tetapkan maklumat butiran terlebih dahulu sebelum melakukan pindah peruntukan.');
        }

        if (empty($request->project_from_sub) || empty($request->project_to_sub)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Sila tetapkan maklumat projek terlebih dahulu sebelum melakukan pindah peruntukan.');
        }

        $bspk = Bspk::create([
            'approval_date' => !empty($request->transfer_approval_date) ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->transfer_approval_date) : null, 
            'approval_letter_ref_no' => $request->transfer_approval_ref_no,
            'warrant_no' => $request->transfer_warrant_no,
            'warrant_date' => !empty($request->transfer_warrant_date) ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->transfer_warrant_date) : null,
            'from_project_id' => $request->project_from_sub,
            'to_project_id' => $request->project_to_sub,
            'transfer_amount' => $request->transfer_verify,
            'purpose' => $request->transfer_purpose,
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        $bspk->projects()->sync([$request->project_from_sub, $request->project_to_sub]);

        return redirect()
            ->route('bspk.transfers.index')
            ->with('success', 'Pindah peruntukan telah berjaya dilakukan.');
    }
}
