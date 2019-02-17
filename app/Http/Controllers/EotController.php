<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class EotController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.eot.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.eot.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);

        if (!empty($project)) {
            DB::transaction(function () use ($request, $project) {
                $project->eots()->create([
                    'application_date' => setDateValue($request->application_date, \Carbon\Carbon::createFromFormat('d/m/Y', $request->application_date)),
                    'eot_approval_date' => setDateValue($request->eot_approval_date, \Carbon\Carbon::createFromFormat('d/m/Y', $request->eot_approval_date)),
                    'extension_date' => setDateValue($request->extension_date, \Carbon\Carbon::createFromFormat('d/m/Y', $request->extension_date)),
                    'clause' => $request->clause,
                    'remarks' => $request->remarks,
                    'created_by' => \Auth::user()->id,
                    'active' => 1
                ]);

                if ($request->hasFile('eot_doc')) {
                    foreach ($request->eot_doc as $data) {
                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('/public/projects/' . $project->id . '/eot/surat-eot', $doc_new_name);
                        $project->eot_docs()->create([
                            'project_id' => $project->id,
                            'category' => 'surat-eot',
                            'file_name' => $doc_new_name,
                            'original_name' => $data->getClientOriginalName(),
                            'mime_type' => $data->getMimeType(),
                            'size' => $data->getSize()
                        ]);
                    }
                }

                if ($request->hasFile('agreement_doc')) {
                    foreach ($request->agreement_doc as $data) {
                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('/public/projects/' . $project->id . '/eot/perjanjian', $doc_new_name);
                        $project->eot_docs()->create([
                            'project_id' => $project->id,
                            'category' => 'perjanjian',
                            'file_name' => $doc_new_name,
                            'original_name' => $data->getClientOriginalName(),
                            'mime_type' => $data->getMimeType(),
                            'size' => $data->getSize()
                        ]);
                    }
                }
            });
        }
        

        return redirect()
            ->route('eot.index', $project->id)
            ->with('success', 'Lanjutan Masa (EOT) telah berjaya dikemaskini.');
    }
}
