<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Committee;
use App\Models\CommitteeInformation as Information;

class CommitteeController extends Controller
{
    public function project($project_id)
    {
        $project = Project::find($project_id);

        if ($project->status <= 11 || $project->status == 13) {
            return redirect()
                ->back()
                ->with('error', 'Maaf, projek masih lagi di fasa perancangan.');
        }

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
                        'name' => $committee_name[$key],
                        'position' => $committee_position[$key],
                        'department' => $committee_department[$key]
                    ]);
                }

                return redirect()
                    ->route('committees.index', $project_id)
                    ->with('success', 'Maklumat Jawatankuasa Perolehan telah berjaya disimpan.');
            }

            return redirect()
                ->back()
                ->with('error', 'Sila isi semula maklumat yang cuba disimpan.');
        }
    }

    public function editInformation($project_id, $id, Request $request)
    {
        !empty(Information::find($id)) ? $info = Information::find($id) : $info = null;

        return view('modules.committees.information', [
            'info' => $info,
            'project_id' => $project_id,
            'id' => $id
        ]);
    }

    public function updateInformation($project_id, $id, Request $request)
    {
        !empty(Information::find($id)) ? $info = Information::find($id) : $info = new Information;

        if (isset($info)) {
            $info->project_id = $project_id;
            $info->committee_type_id = $id;
            $info->appointment_date = \Carbon\Carbon::parse($request->committee_appointment_date);
            $info->save();

            return redirect()
                ->back()
                ->with('success', 'Maklumat Jawatankuasa telah berjaya dikemaskini.');
        }
    }
}
