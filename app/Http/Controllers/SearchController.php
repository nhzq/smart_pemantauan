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

        $projects = $this->searchProject($request);
        $projectsForSUB = $this->searchProjectForSUB($request);


        return view('modules.projects.index', [
            'projects' => $projects,
            'subs' => $subs,
            'request_year' => $request_year
        ]);
    }

    public function searchProject($param)
    {
        $projects = Project::query();

        if (!empty($request->search_year)) {
            $projects = $projects->where('created_at', 'LIKE', '%' . $param . '%');
        }

        if (!empty($request->search_name)) {
            $projects = $projects->where('name', 'LIKE', '%' . $param . '%');
        }

        $projects = $projects->where('active', 1)->paginate(20);

        return $projects;
    }

    public function searchProjectForSUB($param)
    {
        $projectsForSUB = Project::query();

        if (!empty($request->search_year)) {
            $projectsForSUB = $projectsForSUB->where('created_at', 'LIKE', '%' . $param . '%');
        }

        if (!empty($request->search_name)) {
            $projectsForSUB = $projectsForSUB->where('name', 'LIKE', '%' . $param . '%');
        }

        $projectsForSUB = $projectsForSUB
            ->where('active', 1)
            ->whereNotIn('status', [1, 3])
            ->paginate(20);

        return $projectsForSUB;
    }
}
