<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provision;
use App\Models\LookupBudgetType as Budget;

class AllocationController extends Controller
{
    public function index($provision_id)
    {
        $provision = Provision::find($provision_id);
        $total_estimate = [];

        foreach ($provision->allocations as $data) {
            $total_estimate[] = $data->projects()
                ->where('active', 1)
                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('estimate_cost');
        }

        return view('modules.financial.allocation.index', [
            'provision' => $provision,
            'total_estimate' => $total_estimate
        ]);
    }

    public function create($provision_id)
    {
        $provision = Provision::find($provision_id);

        $budget = Budget::where('lookup_department_id', 2)
            ->where('id', $provision->lookup_budget_type_id)
            ->first();

        return view('modules.financial.allocation.create', [
            'provision' => $provision,
            'budget' => $budget
        ]);
    }

    public function store($provision_id, Request $request)
    {
        $provision = Provision::find($provision_id);

        $request->validate([
            'budget_sub' => 'required|not_in:0'
        ]);

        $allocation_existed = $provision->allocations()
            ->where('lookup_sub_budget_type_id', $request->budget_sub)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        if (count($allocation_existed) > 0) {
            return redirect()
                ->back()
                ->with('error', $allocation_existed->sub->code . ' : ' . $allocation_existed->sub->description . ' ada di dalam pangkalan data. Sila kemaskini sekiranya perlu.');
        }

        $provision_amount = $provision->amount;
        $provision_extra = !empty($provision->extra_budget) ? $provision->extra_budget : 0;
        $provision_limit = $provision_amount + $provision_extra;
        
        $allocation_total = $provision->allocations()->sum('amount');

        if (!empty($request->budget_allocation)) {
            if ($allocation_total + removeMaskMoney($request->budget_allocation) > $provision_limit) {
                return redirect()
                    ->back()
                    ->with('error', 'Jumlah peruntukan telah melebihi had. Sila semak semula nilai peruntukan.');
            }
        }

        $provision->allocations()->create([
            'lookup_department_id' => 2,
            'lookup_sub_budget_type_id' => $request->budget_sub,
            'amount' => removeMaskMoney($request->budget_allocation),
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
            ->route('allocations.index', $provision_id)
            ->with('success', 'Peruntukan telah berjaya disimpan.');
    }

    public function edit($provision_id, $id)
    {
        $provision = Provision::find($provision_id);

        $allocation = $provision->allocations()
            ->where('id', $id)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        $budget = Budget::where('lookup_department_id', 2)
            ->where('id', $provision->lookup_budget_type_id)
            ->first();

        return view('modules.financial.allocation.edit', [
            'provision' => $provision,
            'allocation' => $allocation,
            'budget' => $budget
        ]);
    }

    public function update($provision_id, $id, Request $request)
    {
        $provision = Provision::find($provision_id);

        $allocation = $provision->allocations()
            ->where('id', $id)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        $total_allocation = $provision->allocations()
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->sum('amount');

        $update_total_allocation = $total_allocation - $allocation->amount + removeMaskMoney($request->budget_allocation);

        if ($update_total_allocation > $provision->amount) {
            return redirect()
                ->back()
                ->with('error', 'Jumlah peruntukan baru telah melebihi peruntukan yang ditetapkan.');
        }

        $allocation->lookup_sub_budget_type_id = $request->budget_sub;
        $allocation->amount = removeMaskMoney($request->budget_allocation);
        $allocation->updated_by = \Auth::user()->id;
        $allocation->save();

        return redirect()
            ->route('allocations.index', $provision->id)
            ->with('success', 'Peruntukan telah berjaya dikemaskini.');
    }
}
