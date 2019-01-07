<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LookupSubBudgetType as Sub;
use App\Models\Allocation;
use App\Models\AllocationTransfer as Transfer;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AllocationTransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->paginate(20);

        return view('modules.financial.transfer.B01.index', [
            'transfers' => $transfers
        ]);
    }

    public function create()
    {
        $subs = Sub::where('lookup_budget_type_id', 2)->get();

        return view('modules.financial.transfer.B01.create', [
            'subs' => $subs
        ]);
    }

    public function ajaxType(Request $request)
    {
        $allocation = Allocation::where('lookup_sub_budget_type_id', $request->id)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        $from_transfer = 0;
        $to_transfer = 0;
        $net_allocation = $allocation->amount;

        if (!empty($allocation->transfers)) {
            $from_transfer = $allocation->transfers()
                ->where('from_sub_type_id', $allocation->lookup_sub_budget_type_id)
                ->where('active', 1)
                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            $to_transfer = $allocation->transfers()
                ->where('to_sub_type_id', $allocation->lookup_sub_budget_type_id)
                ->where('active', 1)
                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            if ($from_transfer > 0) {
                $net_allocation = $net_allocation - $from_transfer;
            }

            if ($to_transfer > 0) {
                $net_allocation = $net_allocation + $to_transfer;
            }
        }

        $total_estimate_cost = $allocation->projects()
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->sum('estimate_cost');

        $balance = getEstimateCostBalance($total_estimate_cost, $net_allocation);

        $data = [
            'amount' => $net_allocation,
            'balance' => $balance
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $allocation_from = Allocation::where('lookup_sub_budget_type_id', $request->sub_from_b01)->first();
        $allocation_to = Allocation::where('lookup_sub_budget_type_id', $request->sub_to_b01)->first();

        if (empty($allocation_from) || empty($allocation_to)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Sila tetapkan peruntukan terlebih dahulu sebelum melakukan pindah peruntukan.');
        }

        $total_allocation = $allocation_from->amount;

        $total_estimate_cost = Project::where('lookup_budget_type_id', 2)
            ->where('lookup_sub_budget_type_id', $request->sub_from_b01)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->sum('estimate_cost');

        $balance = $total_allocation - $total_estimate_cost;

        if (removeMaskMoney($request->transfer_total_allocation) > $balance) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Jumlah pindah peruntukan melebihi baki semasa. Sila kemaskini jumlah pindah peruntukan');
        }

        DB::transaction(function () use ($request, $allocation_from, $allocation_to) {
            // Update allocation
            // $allocation_from->amount = $allocation_from->amount - removeMaskMoney($request->transfer_total_allocation);
            // $allocation_from->updated_by = \Auth::user()->id;
            // $allocation_from->save();

            // Update allocation
            // $allocation_to->amount = $allocation_to->amount + removeMaskMoney($request->transfer_total_allocation);
            // $allocation_to->updated_by = \Auth::user()->id;
            // $allocation_to->save();

            $transfer = Transfer::create([
                'approval_date' => setDateValue($request->transfer_approval_date, Carbon::createFromFormat('d/m/Y', $request->transfer_approval_date)),
                'approval_letter_ref_no' => $request->transfer_approval_ref_no,
                'warrant_no' => $request->transfer_warrant_no,
                'warrant_date' => setDateValue($request->transfer_warrant_date, Carbon::createFromFormat('d/m/Y', $request->transfer_warrant_date)),
                'budget_type_id' => 2,
                'from_sub_type_id' => $request->sub_from_b01,
                'to_sub_type_id' => $request->sub_to_b01,
                'transfer_amount' => removeMaskMoney($request->transfer_total_allocation),
                'purpose' => $request->transfer_allocation_purpose,
                'created_by' => \Auth::user()->id,
                'active' => 1
            ]);

            $transfer->allocations()->sync([$allocation_from->id, $allocation_to->id]);

            if ($request->hasFile('transfer_letter')) {
                foreach ($request->transfer_letter as $data) {
                    if (!empty($data)) {
                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('/public/transfers/' . $transfer->id . '/', $doc_new_name);
                        $transfer->documents()->create([
                            'allocation_transfer_id' => $transfer->id,
                            'category' => 'pindah-peruntukan',
                            'file_name' => $doc_new_name,
                            'original_name' => $data->getClientOriginalName(),
                            'mime_type' => $data->getMimeType(),
                            'size' => $data->getSize()
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('transfers.index')
            ->with('success', 'Pindah peruntukan telah berjaya dilakukan.');
    }
}
