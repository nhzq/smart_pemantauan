<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contractor;
use Carbon\Carbon;

class ContractorController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);
        
        return view('modules.contractors.index', [
            'project' => $project
        ]);
    }

    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.contractors.create', [
            'project' => $project
        ]);
    }

    public function storeAppointment($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $project->sst = Carbon::parse($request->contractor_sst);
        $project->sst_reference_no = $request->contractor_sst_reference;
        $project->contract_value = removeMaskMoney($request->contractor_value);
        $project->save();

        return redirect()
            ->route('contractors.index', $project->id)
            ->with('success', 'Maklumat perlantikan kontraktor telah berjaya dikemaskini.');
    }

    public function storeDetails($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $project->ssm_no = $request->contractor_ssm;
        $project->ssm_reference_no = $request->contractor_ssm_reference;
        $project->ssm_start_date = Carbon::parse($request->contractor_ssm_start_date);
        $project->ssm_end_date = Carbon::parse($request->contractor_ssm_end_date);
        $project->mof_no = $request->contractor_mof;
        $project->mof_reference_no = $request->contractor_mof_reference;
        $project->mof_start_date = Carbon::parse($request->contractor_mof_start_date);
        $project->mof_end_date = Carbon::parse($request->contractor_mof_end_date);
        $project->company_name = $request->contractor_company_name;
        $project->company_address = $request->contractor_company_address;
        $project->company_tel = $request->contractor_company_tel;
        $project->company_fax = $request->contractor_company_fax;
        $project->save();

        return redirect()
            ->route('contractors.index', $project->id)
            ->with('success', 'Maklumat syarikat untuk kontraktor telah berjaya dikemaskini.');
    }

    public function storeLists($project_id, Request $request)
    {
        $project = Project::find($project_id);

        if (!empty($request->contractor_name)) {
            foreach ($request->contractor_name as $key => $name) {
                Contractor::create([
                    'project_id' => $project_id,
                    'name' => $name,
                    'position' => $request->contractor_position[$key],
                    'ic' => $request->contractor_ic[$key],
                    'email' => $request->contractor_email[$key],
                    'tel' => $request->contractor_tel[$key],
                    'created_by' => \Auth::user()->id,
                    'active' => 1
                ]);
            }
        }

        return redirect()
            ->route('contractors.index', $project->id)
            ->with('success', 'Maklumat senarai kontraktor telah berjaya dikemaskini.');
    }

    public function storeDuration($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $project->contract_start_date = Carbon::parse($request->contractor_duration_start_date);
        $project->contract_end_date = Carbon::parse($request->contractor_duration_end_date);
        $project->save();

        return redirect()
            ->route('contractors.index', $project->id)
            ->with('success', 'Tempoh kontrak telah berjaya dikemaskini.');
    }
}
