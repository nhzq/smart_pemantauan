<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class CertificateController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.certificate.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.certificate.create', [
            'project' => $project
        ]);
    }

    public function editAccount($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.certificate.edit-account', [
            'project' => $project
        ]);
    }

    public function editAgreement($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.certificate.edit-agreement', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $certificate = $project->certificate;
        $witness_date = null;
        $contractor_date = null;

        if (!empty($request->witness_date)) {
            $witness_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->witness_date);
        }

        if (!empty($request->contractor_date)) {
            $contractor_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->contractor_date);
        }

        if ($request->part == 1) {
            if (!empty($certificate)) {
                $certificate->project_id = $project->id;
                $certificate->definition = $request->definition;
                $certificate->details = $request->details;
                $certificate->updated_by = \Auth::user()->id;
                $certificate->save();
            } else {
                $project->certificate()->create([
                    'project_id' => $project->id,
                    'definition' => $request->definition,
                    'details' => $request->details,
                    'created_by' => \Auth::user()->id,
                    'active' => 1
                ]);
            }
        }

        if ($request->part == 2) {
            if (!empty($certificate)) {
                $certificate->project_id = $project->id;
                $certificate->witness_date = $witness_date;
                $certificate->witness_officer_name = $request->witness_officer_name;
                $certificate->witness_name = $request->witness_name;
                $certificate->witness_ic = $request->witness_ic;
                $certificate->witness_address = $request->witness_address;
                $certificate->contractor_date = $contractor_date;
                $certificate->contractor_name = $request->contractor_name;
                $certificate->contractor_ic = $request->contractor_ic;
                $certificate->contractor_address = $request->contractor_address;
                $certificate->updated_by = \Auth::user()->id;
                $certificate->save();
            } else {
                $project->certificate()->create([
                    'project_id' => $project->id,
                    'witness_date' => $witness_date,
                    'witness_officer_name' => $request->witness_officer_name,
                    'witness_name' => $request->witness_name,
                    'witness_ic' => $request->witness_ic,
                    'witness_address' => $request->witness_address,
                    'contractor_date' => $contractor_date,
                    'contractor_name' => $request->contractor_name,
                    'contractor_ic' => $request->contractor_ic,
                    'contractor_address' => $request->contractor_address,
                    'created_by' => \Auth::user()->id,
                    'active' => 1
                ]);
            }
        }

        return redirect()
            ->route('certificates.index', $project->id)
            ->with('success', 'Maklumat Perakuan Akaun telah berjaya dikemaskini.');
    }
}
