<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provision;
use App\Models\Allocation;
use App\Models\LookupBudgetType as Budget;

class ProvisionController extends Controller
{
    public function index()
    {
        $lists = Budget::all();

        return view('modules.financial.provision.index', [
            'lists' => $lists
        ]);
    }

    public function edit($provision)
    {
        $budget = Budget::find($provision);

        $provision = Provision::where('lookup_budget_type_id', $budget->id)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        return view('modules.financial.provision.create', [
            'budget' => $budget,
            'provision' => $provision
        ]);
    }

    public function store(Request $request)
    {
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

    public function update(Request $request, $provision)
    {
        $provision = Provision::find($provision);

        $provision->lookup_budget_type_id = $request->budget_type;
        $provision->amount = removeMaskMoney($request->budget_allocation);
        $provision->extra_budget = !empty($request->additional_provision) ? removeMaskMoney($request->additional_provision) : null;
        $provision->extra_budget_from = !empty($request->allocation_type) ? $request->allocation_type : null;
        $provision->updated_by = \Auth::user()->id;
        $provision->save();

        return redirect()
            ->route('provisions.index')
            ->with('success', 'Peruntukan telah berjaya dikemaskini');
    }
}
