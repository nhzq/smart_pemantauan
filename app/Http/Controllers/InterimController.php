<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\InterimDocument; 

class InterimController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.interims.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.interims.create', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $payment_date = null;
        $amount = '';

        if (!empty($request->payment_date)) {
            $payment_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->payment_date);
        }

        if (!empty($request->payment_amount)) {
            $amount = removeMaskMoney($request->payment_amount);
        }

        $project->interims()->create([
            'project_id' => $project->id,
            'payment_type' => $request->payment_type,
            'payment_no' => $request->payment_no,
            'payment_date' => $payment_date,
            'amount' => $amount,
            'description' => $request->description,
            'created_by' => \Auth::user()->id,
            'active' => 1
        ]);

        return redirect()
            ->route('interims.index', $project_id)
            ->with('success', 'Maklumat Pembayaran Kontrak telah dikemaskini.');
    }

    public function edit($project_id, $id, Request $request)
    {
        $project = Project::find($project_id);

        $interim = $project->interims()
            ->where('id', $id)
            ->where('active', 1)
            ->first();

        return view('modules.interims.edit', [
            'project' => $project,
            'interim' => $interim
        ]);
    }

    public function update($project_id, $id, Request $request)
    {
        $project = Project::find($project_id);

        $interim = $project->interims()
            ->where('id', $id)
            ->where('active', 1)
            ->first();

        $payment_date = null;
        $amount = '';

        if (!empty($request->payment_date)) {
            $payment_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->payment_date);
        }

        if (!empty($request->payment_amount)) {
            $amount = removeMaskMoney($request->payment_amount);
        }

        $interim->project_id = $project->id;
        $interim->payment_type = $request->payment_type;
        $interim->payment_no = $request->payment_no;
        $interim->payment_date = $payment_date;
        $interim->amount = $amount;
        $interim->description = $request->description;
        $interim->updated_by = \Auth::user()->id;
        $interim->active = 1;
        $interim->save();

        return redirect()
            ->route('interims.index', $project_id)
            ->with('success', 'Maklumat Pembayaran Kontrak telah dikemaskini.');
    }

    public function notify($project_id, $interim_id)
    {
        $project = Project::find($project_id);

        $interim = $project->interims()
            ->where('id', $interim_id)
            ->where('active', 1)
            ->first();

        $interim->status = 1;
        $interim->updated_by = \Auth::user()->id;
        $interim->save();

        return redirect()
            ->back()
            ->with('success', 'Maklumat pembayaran kontrak telah pun di kemaskini untuk Unit Kewangan.');
    }

    public function upload($project_id, Request $request)
    {
        $project = Project::find($project_id);

        if ($request->hasFile('upload_files')) {
            foreach ($request->upload_files as $data) {
                if (!empty($data)) {
                    $category = '';

                    if (!empty($request->file_type)) {
                        $category = strtolower(str_replace(' ', '-', $request->file_type));
                    }

                    $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                    $data->storeAs('/public/projects/' . $project->id . '/interims/', $doc_new_name);
                    $project->interim_docs()->create([
                        'project_id' => $project->id,
                        'category' => $category,
                        'file_name' => $doc_new_name,
                        'original_name' => $data->getClientOriginalName(),
                        'mime_type' => $data->getMimeType(),
                        'size' => $data->getSize()
                    ]);
                }
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Fail telah berjaya dimuat naik.');
    }

    public function delete($project_id, Request $request)
    {
        if (!empty($request->file_list)) {
            foreach ($request->file_list as $list) {
                $doc = InterimDocument::where('id', $list)->first();
                $doc->delete();
            }

            return redirect()
                ->back()
                ->with('success', 'Fail telah berjaya dikemaskini.');
        }
    }
}
