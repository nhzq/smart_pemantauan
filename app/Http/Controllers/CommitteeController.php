<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Committee;
use App\Models\CommitteeInformation as Information;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CommitteeController extends Controller
{
    public function project($project_id)
    {
        $project = Project::find($project_id);

        $planningStatuses = [10, 11];

        if ($project->status <= 8 || in_array($project->status, $planningStatuses)) {
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
        $project = Project::find($project_id);

        return view('modules.committees.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $committee_type = $request->committee_type;
        $committee_name = $request->committee_name;
        $committee_position = $request->committee_position;
        $committee_department = $request->committee_department;

        if ($project->lookup_collection_type_id != 5) {
            if (!empty($committee_type)) {
                if (is_array($committee_type)) {
                    foreach ($committee_type as $key => $data) {
                        Committee::create([
                            'project_id' => $project_id,
                            'committee_type_id' => $data,
                            'name' => $committee_name[$key],
                            'position' => $committee_position[$key],
                            'department' => $committee_department[$key],
                            'created_by' => \Auth::user()->id,
                            'active' => 1
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

        if ($project->lookup_collection_type_id == 5) {
            if (!empty($committee_name)) {
                if (is_array($committee_name)) {
                    foreach ($committee_name as $key => $data) {
                        Committee::create([
                            'project_id' => $project_id,
                            'committee_type_id' => null,
                            'name' => $data,
                            'position' => $committee_position[$key],
                            'department' => $committee_department[$key],
                            'created_by' => \Auth::user()->id,
                            'active' => 1
                        ]);
                    }

                    return redirect()
                        ->route('committees.index', $project_id)
                        ->with('success', 'Maklumat Jawatankuasa Rundingan Harga telah berjaya disimpan.');
                }

                return redirect()
                    ->back()
                    ->with('error', 'Sila isi semula maklumat yang cuba disimpan.');
            }
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
            DB::transaction(function () use ($project_id, $id, $request, $info) {
                $appointment_date = null;

                if (!empty($request->committee_appointment_date)) {
                    $appointment_date = \Carbon\Carbon::parse($request->committee_appointment_date);
                }

                $info->project_id = $project_id;
                $info->committee_type_id = $id;
                $info->appointment_date = $appointment_date;
                $info->save();

                if ($id == 1) {
                    $category_title = 'jawatankuasa-spesifikasi-teknikal';
                } else if ($id == 2) {
                    $category_title = 'jawatankuasa-penilaian-teknikal';
                } else {
                    $category_title = 'jawatankuasa-penilaian-harga';
                }

                if ($request->hasFile('committee_appointment_letter')) {
                    if (!empty($request->committee_appointment_letter)) {
                        $data = $request->committee_appointment_letter;

                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('committees/' . $info->id . '/', $doc_new_name);

                        $obj = $info->with('project.documents')->where('id', $info->id)->first();
                        $obj->project->documents()->create([
                            'category' => $category_title . '-surat-lantikan',
                            'file_name' => $doc_new_name,
                            'original_name' => $data->getClientOriginalName(),
                            'mime_type' => $data->getMimeType(),
                            'size' => $data->getSize()
                        ]);
                    }
                }

                if ($request->hasFile('committee_spec_document')) {
                    if (!empty($request->committee_spec_document)) {
                        $data = $request->committee_spec_document;

                        $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                        $data->storeAs('committees/' . $info->id . '/', $doc_new_name);

                        $obj = $info->with('project.documents')->where('id', $info->id)->first();
                        $obj->project->documents()->create([
                            'category' => $category_title,
                            'file_name' => $doc_new_name,
                            'original_name' => $data->getClientOriginalName(),
                            'mime_type' => $data->getMimeType(),
                            'size' => $data->getSize()
                        ]);
                    }
                }
            });

            return redirect('collection/' . $project_id . '/committees#tab_tab' . $id)
                ->with('success', 'Maklumat Jawatankuasa telah berjaya dikemaskini.');
        }
    }

    public function editInformationDirect($project_id, Request $request)
    {
        !empty(Information::find($project_id)) ? $info = Information::find($project_id) : $info = null;

        return view('modules.committees.information-direct-nego', [
            'info' => $info,
            'project_id' => $project_id
        ]);
    }

    public function downloadFile($committee_id, $filename)
    {
        $project = Project::find($id);

        return Storage::download('/committees/' . $project->id . '/' . $filename);
    }
}
