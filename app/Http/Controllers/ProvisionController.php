<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provision;
use App\Models\Allocation;
use App\Models\LookupBudgetType as Budget;
use App\Models\AdditionalProvision as AddProv;
use Illuminate\Support\Facades\DB;

class ProvisionController extends Controller
{
    public function index()
    {
        $lists = Budget::all();
        $addProv = AddProv::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->get();

        return view('modules.financial.provision.index', [
            'lists' => $lists,
            'addProv' => $addProv
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

        DB::transaction(function () use ($request, $provision) {
            $provision->lookup_budget_type_id = $request->budget_type;
            $provision->amount = removeMaskMoney($request->budget_allocation);
            $provision->save();

            if (!empty($request->allocation_type) && is_array($request->allocation_type)) {
                if (!empty($provision->additionals)) {
                    $provision->additionals()->delete();
                }

                foreach ($request->allocation_type as $key => $type) {
                    $provision->additionals()->create([
                        'extra_budget_from' => $type,
                        'extra_budget' => removeMaskMoney($request->additional_provision[$key]),
                        'created_by' => \Auth::user()->id,
                        'active' => 1
                    ]);
                }
            }
        });

        return redirect()
            ->route('provisions.index')
            ->with('success', 'Peruntukan telah berjaya dikemaskini');
    }
}
