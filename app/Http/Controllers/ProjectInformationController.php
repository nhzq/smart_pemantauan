<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\LookupCollectionType as Collection;
use Carbon\Carbon;

class ProjectInformationController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.project-information.index', [
            'project' => $project
        ]);
    }

    public function edit($project_id)
    {
        $project = Project::find($project_id);
        $collections = Collection::all();

        return view('modules.project-information.edit', [
            'project' => $project,
            'collections' => $collections
        ]);
    }

    public function update(Request $request, $project_id)
    {
        $project = Project::find($project_id);
        $project->objective = $request->info_objective_project;
        $project->minute_approval_date = Carbon::parse($request->info_date_approval_minute);
        $project->approval_pwn_date = Carbon::parse($request->info_date_approval_pwn);
        $project->lookup_collection_type_id = $request->info_collection_types;
        $project->save();

        return redirect()
            ->route('info.index', $project->id)
            ->with('success', 'Projek telah berjaya dikemaskini.');
    }
}
