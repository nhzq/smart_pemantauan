<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Models\LookupCollectionType as Collection;
use Carbon\Carbon;
use App\Helpers\Status;

class ProjectInformationController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        if ($project->status < Status::toPlanningPhase()) {
            return redirect()->back()->with('error', 'Maaf, projek ini masih di masa PERMULAAN.');
        }

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

        DB::transaction(function () use ($request, $project) {
            $approval_minute = null;
            $approval_pwn = null;

            if (!empty($request->info_date_approval_minute)) {
                $approval_minute = Carbon::parse($request->info_date_approval_minute);
            }

            if (!empty($request->info_date_approval_pwn)) {
                $approval_pwn = Carbon::parse($request->info_date_approval_pwn);
            }

            $project->objective = $request->info_objective_project;
            $project->minute_approval_date = $approval_minute;
            $project->approval_pwn_date = $approval_pwn;
            $project->lookup_collection_type_id = $request->info_collection_types;
            $project->status = Status::toPlanningPhase();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            if ($request->hasFile('info_minute')) {
                foreach ($request->info_minute as $data) {
                    if (!empty($data)) {
                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('projects/' . $project->id . '/', $doc_new_name);
                        $project->documents()->create([
                            'project_id' => $project->id,
                            'category' => 'minit-bebas',
                            'file_name' => $doc_new_name,
                            'original_name' => $data->getClientOriginalName(),
                            'mime_type' => $data->getMimeType(),
                            'size' => $data->getSize()
                        ]);
                    }
                }
            }

            if ($request->hasFile('info_approval_pwn')) {
                foreach ($request->info_approval_pwn as $data) {
                    if (!empty($data)) {
                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('projects/' . $project->id . '/', $doc_new_name);
                        $project->documents()->create([
                            'project_id' => $project->id,
                            'category' => 'surat-pwn',
                            'file_name' => $doc_new_name,
                            'original_name' => $data->getClientOriginalName(),
                            'mime_type' => $data->getMimeType(),
                            'size' => $data->getSize()
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('info.index', $project->id)
            ->with('success', 'Projek telah berjaya dikemaskini.');
    }
}
