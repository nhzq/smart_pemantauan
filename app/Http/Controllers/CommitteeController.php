<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Committee;

class CommitteeController extends Controller
{
    public function project($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.collections.index', [
            'project' => $project
        ]);
    }

    public function index($project_id)
    {
        $project = Project::find($project_id);
        $committee = new Committee;

        return view('modules.committees.index', [
            'project' => $project,
            'committee' => $committee
        ]);
    }

    public function create($project_id)
    {
        return view('modules.committees.create', [
            'project_id' => $project_id
        ]);
    }

    public function store($project_id, Request $request)
    {
        $committee_type = $request->committee_type;
        $committee_name = $request->committee_name;
        $committee_position = $request->committee_position;
        $committee_department = $request->committee_department;

        if (!empty($committee_type)) {
            if (is_array($committee_type)) {
                foreach ($committee_type as $key => $data) {
                    Committee::create([
                        'project_id' => $project_id,
                        'committee_type_id' => $data,
                        'committee_name' => $committee_name[$key],
                        'committee_position' => $committee_position[$key],
                        'committee_department' => $committee_department[$key]
                    ]);
                }

                return redirect()->back();
            }
        }
    }
}
