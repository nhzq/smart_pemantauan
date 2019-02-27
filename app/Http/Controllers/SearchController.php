<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\LookupSubBudgetType as SubBudget;

class SearchController extends Controller
{
    public function project(Request $request)
    {
        $subs = SubBudget::where('lookup_budget_type_id', 2)->get();
        $request_year = $request->search_year;

        $projects = Project::query();

        if (!empty($request->search_year)) {
            $projects = $projects->where('created_at', 'LIKE', '%' . $request->search_year . '%');
        }

        if (!empty($request->search_name)) {
            $projects = $projects->where('name', 'LIKE', '%' . $request->search_name . '%');
        }

        $projects = $projects->where('active', 1)->paginate(20);

        return view('modules.projects.index', [
            'projects' => $projects,
            'subs' => $subs,
            'request_year' => $request_year
        ]);
    }
}
