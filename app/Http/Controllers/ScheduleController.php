<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ScheduleController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.planning-schedule.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.planning-schedule.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $activity = $project->schedules()->create([
            'project_id' => $project->id,
            'parent_id' => 0,
            'activity' => $request->activity,
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        if (!empty($request->sub_activity)) {
            foreach ($request->sub_activity as $key => $sub) {
                $project->schedules()->create([
                    'project_id' => $project->id,
                    'parent_id' => $activity->id,
                    'activity' => $sub,
                    'start_date' => !empty($request->start_date[$key]) ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date[$key]) : null,
                    'end_date' => !empty($request->end_date[$key]) ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date[$key]) : null,
                    'created_by' => \Auth::user()->id,
                    'active' => 1
                ]);
            }
        }

        return redirect()
            ->route('schedules.index', $project->id)
            ->with('success', 'Jadual Perancangan telah berjaya dikemaskini.');
    }

    public function update($project_id, $id, Request $request)
    {
        $project = Project::find($project_id);
        $schedule = $project->schedules()->where('id', $id)->first();

        $schedule->activity = $request->activity;
        $schedule->start_date = !empty($request->start_date) ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date) : null;
        $schedule->end_date = !empty($request->end_date) ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date) : null;
        $schedule->updated_by = \Auth::user()->id;
        $schedule->save();

        return redirect()
            ->back()
            ->with('success', 'Maklumat aktiviti telah berjaya dikemaskini.');
    }
}
