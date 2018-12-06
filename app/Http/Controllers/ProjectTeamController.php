<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectTeam as PT;
use App\Models\LookupProjectTeam as Team;
use App\Models\LookupDepartment as Department;

class ProjectTeamController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);
        $team = new PT;

        return view('modules.project-team.index', [
            'project' => $project,
            'team' => $team
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);
        $teams = Team::where('id', '<', 5)->get();
        $departments = Department::whereNotIn('code', ['DEV001'])->get();

        return view('modules.project-team.create', [
            'project' => $project,
            'teams' => $teams,
            'departments' => $departments
        ]);
    }

    public function ajaxType(Request $request)
    {
        $data = Team::where('id', $request->id)->first()->teams;

        return response()->json($data);
    }

    public function store($project_id, Request $request)
    {
        $project_team = Team::where('id', $request->team_type)->first()->name;

        $arrayDate = [];
        $arrayDateToString = null;

        if (!empty($request->team_meeting_date)) {
            foreach ($request->team_meeting_date as $date) {
                $arrayDate[] = \Carbon\Carbon::parse($date)->format('Y-m-d');
            }

            $arrayDateToString = implode('|', $arrayDate);
        }

        PT::create([
            'project_id' => $project_id,
            'lookup_project_team_id' => $request->team_type,
            'lookup_project_role_id' => $request->team_role,
            'name' => $request->team_name,
            'position' => $request->team_position,
            'department_id' => $request->team_department,
            'group' => $request->team_part,
            'unit' => $request->team_unit,
            'total_meeting' => $request->team_meeting,
            'meeting_dates' => $arrayDateToString,
            'created_by' => \Auth::user()->id,
            'updated_by' => null,
            'active' => 1
        ]);

        return redirect('/planning/' . $project_id . '/project-team/#tab_tab' . $request->team_type)
            // ->route('project-team.index', $project_id)
            ->with('success', $project_team . ' telah berjaya disimpan');
    }

    public function edit($project_id, $id)
    {
        $pt = PT::find($id);
        $teams = new Team;
        $departments = Department::whereNotIn('code', ['DEV001'])->get();

        return view('modules.project-team.edit', [
            'pt' => $pt,
            'teams' => $teams,
            'project_id' => $project_id,
            'departments' => $departments
        ]);
    }

    public function update($project_id, $id, Request $request)
    {
        $project_team = Team::where('id', $request->team_type)->first()->team;

        $arrayDate = [];
        $arrayDateToString = null;

        if (!empty($request->team_meeting_date)) {
            foreach ($request->team_meeting_date as $date) {
                $arrayDate[] = \Carbon\Carbon::parse($date)->format('Y-m-d');
            }

            $arrayDateToString = implode('|', $arrayDate);
        }

        $pt = PT::find($id);
        $pt->project_id = $project_id;
        $pt->lookup_project_team_id = $request->team_type;
        $pt->lookup_project_role_id = $request->team_role;
        $pt->name = $request->team_name;
        $pt->position = $request->team_position;
        $pt->department_id = $request->team_department;
        $pt->group = $request->team_part;
        $pt->unit = $request->team_unit;
        $pt->total_meeting = $request->team_meeting;
        $pt->meeting_dates = $arrayDateToString;
        $pt->updated_by = \Auth::user()->id;
        $pt->save();

        return redirect()
            ->route('project-team.index', $project_id)
            ->with('success', $project_team . ' telah berjaya dikemaskini.');
    }
}
