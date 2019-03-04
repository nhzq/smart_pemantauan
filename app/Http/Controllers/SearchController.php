<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\LookupSubBudgetType as SubBudget;

class SearchController extends Controller
{
    public function project(Request $request)
    {
        $subs = null;
        $projects = null;
        $request_year = $request->search_year;
        
        if (count($this->searchProject($request)) > 0) {
            $projects = $this->searchProject($request);
            $subs = SubBudget::where('lookup_budget_type_id', 2)->get();
        }
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

        if (!empty($param->search_year)) {
            $projects = $projects->where('created_at', 'LIKE', '%' . $param->search_year . '%');
        }

        if (!empty($param->search_name)) {
            $projects = $projects->where('name', 'LIKE', '%' . $param->search_name . '%');
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
