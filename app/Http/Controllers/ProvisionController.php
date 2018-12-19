<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provision;
use App\Models\LookupBudgetType as Budget;

class ProvisionController extends Controller
{
    public function index()
    {
        $provisions = Provision::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->orderBy('lookup_budget_type_id', 'ASC')
            ->get();

        return view('modules.financial.provision.index', [
            'provisions' => $provisions
        ]);
    }

    public function create()
    {
        $budgets = Budget::all();

        return view('modules.financial.provision.create', [
            'budgets' => $budgets
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'budget_type' => 'required'
        ]);

        Provision::create([
            'lookup_budget_type_id' => $request->budget_type,
            'amount' => removeMaskMoney($request->budget_allocation),
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
            ->route('provisions.index')
            ->with('success', 'Peruntukan telah berjaya dikemaskini');
    }
}
