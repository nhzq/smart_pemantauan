<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class MeetingController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.meetings.index', [
            'project' => $project
        ]);
    }

    public function updateMeeting($project_id, $id, Request $request)
    {
        $project = Project::find($project_id);
        $meeting = $project->meetings->where('id', $id)->first();
        $actual_date = null;

        if (!empty($request->actual_date)) {
            $actual_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->actual_date);
        }

        if ($request->file('minute_meeting')) {
            $doc_new_name = time() . str_replace(' ', '-', $request->minute_meeting->getClientOriginalName());
            $request->minute_meeting->storeAs('/public/projects/' . $project->id . '/minute-meetings/', $doc_new_name);

            $meeting->file_name = $doc_new_name;
            $meeting->original_name = $request->minute_meeting->getClientOriginalName();
            $meeting->mime_type = $request->minute_meeting->getMimeType();
            $meeting->size = $request->minute_meeting->getSize();
        }

        $meeting->actual_meeting_dates = $actual_date;
        $meeting->updated_by = \Auth::user()->id;
        $meeting->save();

        return redirect('/development/' . $project->id . '/meetings#tab_tab' . $meeting->lookup_project_team_id)
            ->with('success', 'Maklumat Mesyuarat telah berjaya dikemaskini.');
    }
}
