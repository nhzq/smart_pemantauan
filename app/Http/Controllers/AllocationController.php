<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LookupDepartment as Department;
use App\Models\LookupBudgetType as Budget;
use App\Models\LookupSubBudgetType as SubBudget;
use App\Models\Allocation;

class AllocationController extends Controller
{
    public function index()
    {
        $budgets = Budget::where('lookup_department_id', 2)->get();

        return view('modules.financial.allocation.index', [
            'budgets' => $budgets
        ]);
    }

    public function type($id)
    {
        $budget = Budget::find($id);
        $allocations = Allocation::where('lookup_budget_type_id', $id)->get();

        return view('modules.financial.allocation.type', [
            'budget' => $budget,
            'allocations' => $allocations
        ]);
    }

    public function create($id)
    {
        $budget = Budget::find($id);

        return view('modules.financial.allocation.create', [
            'budget' => $budget
        ]);
    }

    public function store(Request $request, $id)
    {
        Allocation::create([
            'lookup_department_id' => $request->budget_department_id,
            'lookup_budget_type_id' => $id,
            'lookup_sub_budget_type_id' => $request->budget_type,
            'amount' => $request->budget_allocation,
            'estimate_cost' =>  $request->budget_estimate,
            'project_cost' => $request->budget_project_cost,
            'total_spending' => $request->budget_spending,
            'balance' => $request->budget_balance
        ]);

        return redirect()
            ->route('allocations.type', $id)
            ->with('success', 'Allocation has been saved');
    }
}
