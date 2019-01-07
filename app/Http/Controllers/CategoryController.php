<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LookupBudgetType as Budget;

class CategoryController extends Controller
{
    public function index()
    {
        $budgets = Budget::all();

        return view('modules.categories.index', [
            'budgets' => $budgets
        ]);
    }
}
