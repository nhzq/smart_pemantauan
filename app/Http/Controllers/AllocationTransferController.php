<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LookupSubBudgetType as Sub;
use App\Models\Allocation;
use App\Models\AllocationTransfer as Transfer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AllocationTransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::where('active', 1)->paginate(20);

        return view('modules.financial.transfer.index', [
            'transfers' => $transfers
        ]);
    }

    public function create()
    {
        $subs = Sub::where('lookup_budget_type_id', 2)->get();

        return view('modules.financial.transfer.create', [
            'subs' => $subs
        ]);
    }

    public function ajaxType(Request $request)
    {
        $data = Allocation::where('lookup_sub_budget_type_id', $request->id)->first();

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

        if (removeMaskMoney($request->transfer_total_allocation) > $allocation_from->balance) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Jumlah pindah peruntukan melebihi baki semasa. Sila kemaskini jumlah pindah peruntukan');
        }

        DB::transaction(function () use ($request, $allocation_from, $allocation_to) {
            // Update allocation
            $allocation_from->amount = $allocation_from->amount - removeMaskMoney($request->transfer_total_allocation);
            $allocation_from->balance = $allocation_from->balance - removeMaskMoney($request->transfer_total_allocation);
            $allocation_from->updated_by = \Auth::user()->id;
            $allocation_from->save();

            // Update allocation
            $allocation_to->amount = $allocation_to->amount + removeMaskMoney($request->transfer_total_allocation);
            $allocation_to->balance = $allocation_to->balance + removeMaskMoney($request->transfer_total_allocation);
            $allocation_to->updated_by = \Auth::user()->id;
            $allocation_to->save();

            $transfer = Transfer::create([
                'approval_date' => Carbon::parse($request->transfer_approval_date),
                'approval_letter_ref_no' => $request->transfer_approval_ref_no,
                'warrant_no' => $request->transfer_warrant_no,
                'warrant_date' => Carbon::parse($request->transfer_warrant_date),
                'budget_type_id' => 2,
                'from_sub_type_id' => $request->sub_from_b01,
                'to_sub_type_id' => $request->sub_to_b01,
                'transfer_amount' => removeMaskMoney($request->transfer_total_allocation),
                'verify_transfer_amount' => removeMaskMoney($request->transfer_verify_allocation),
                'purpose' => $request->transfer_allocation_purpose,
                'created_by' => \Auth::user()->id,
                'active' => 1
            ]);

            $transfer->allocations()->sync([$allocation_from->id, $allocation_to->id]);

            if ($request->hasFile('transfer_letter')) {
                foreach ($request->transfer_letter as $data) {
                    if (!empty($data)) {
                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('transfer/' . $transfer->id . '/', $doc_new_name);
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
