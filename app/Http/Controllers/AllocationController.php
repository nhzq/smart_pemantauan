<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LookupDepartment as Department;
use App\Models\LookupBudgetType as Budget;
use App\Models\LookupSubBudgetType as SubBudget;
use App\Models\Allocation;
use App\Models\Project;

class AllocationController extends Controller
{
    public function index()
    {
        $allocations = Allocation::where('lookup_department_id', 2)->where('active', 1)->orderBy('lookup_budget_type_id', 'ASC')->get();

        return view('modules.financial.allocation.index', [
            'allocations' => $allocations
        ]);
    }

    public function create()
    {
        $budgets = Budget::where('lookup_department_id', 2)->get();

        return view('modules.financial.allocation.create', [
            'budgets' => $budgets
        ]);
    }

    public function ajaxType(Request $request)
    {
        $data = SubBudget::where('lookup_budget_type_id', $request->id)->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $value = Allocation::where('lookup_sub_budget_type_id', $request->budget_sub)->where('active', 1)->first();

        if (count($value) > 0) {
            return redirect()
                ->back()
                ->with('error', $value->sub->code . ' : ' . $value->sub->description . ' ada di dalam pangkalan data. Sila kemaskini sekiranya perlu.');
        }

        Allocation::create([
            'lookup_department_id' => 2,
            'lookup_budget_type_id' => $request->budget_type,
            'lookup_sub_budget_type_id' => $request->budget_sub,
            'amount' => removeMaskMoney($request->budget_allocation),
            'balance' => removeMaskMoney($request->budget_allocation),
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
            ->route('allocations.index')
            ->with('success', 'Peruntukan telah berjaya disimpan.');
    }

    public function edit($id)
    {
        $allocation = Allocation::find($id);
        $budgets = Budget::where('lookup_department_id', 2)->get();
        $subBudgets = \App\Models\LookupSubBudgetType::where('lookup_budget_type_id', $allocation->lookup_budget_type_id)->get();

        return view('modules.financial.allocation.edit', [
            'allocation' => $allocation,
            'budgets' => $budgets,
            'subBudgets' => $subBudgets
        ]);
    }

    public function update(Request $request, $id)
    {
        $allocation = Allocation::find($id);
        $min_total_cost = $allocation->amount - $allocation->balance;

        if (removeMaskMoney($request->budget_allocation) > $min_total_cost) {
            $allocation->lookup_budget_type_id = $request->budget_type;
            $allocation->lookup_sub_budget_type_id = $request->budget_sub;
            $allocation->amount = removeMaskMoney($request->budget_allocation);
            $allocation->balance = removeMaskMoney($request->budget_allocation) - $min_total_cost;
            $allocation->updated_by = \Auth::user()->id;
            $allocation->save();

            return redirect()
                ->route('allocations.index')
                ->with('success', 'Peruntukan telah berjaya dikemaskini.');
        }

        return redirect()
            ->back()
            ->with('error', 'Peruntukan baru tidak boleh lagi rendah dari anggaran kos.');
    }
}
