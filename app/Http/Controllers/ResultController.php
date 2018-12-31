<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class ResultController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.results.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.results.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $project->actual_approval_date = Carbon::createFromFormat('d/m/Y', $request->result_approval_date);
        $project->actual_project_cost = removeMaskMoney($request->result_actual_project_cost);
        $project->justification = $request->result_justification;
        $project->updated_by = \Auth::user()->id;
        $project->save();

        if ($request->hasFile('result_minute_meeting')) {
            foreach ($request->result_minute_meeting as $data) {
                if (!empty($data)) {
                    $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                    $data->storeAs('/public/projects/' . $project->id . '/results/', $doc_new_name);
                    $project->documents()->create([
                        'project_id' => $project->id,
                        'category' => 'minit-mesyuarat-kelulusan',
                        'file_name' => $doc_new_name,
                        'original_name' => $data->getClientOriginalName(),
                        'mime_type' => $data->getMimeType(),
                        'size' => $data->getSize()
                    ]);
                }
            }
        }

        return redirect()
            ->route('results.index', $project_id)
            ->with('success', 'Keputusan Perolehan telah dikemaskini');
    }
}
