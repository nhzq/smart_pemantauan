<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contractor;
use App\Models\Appointment;
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
        $contractor_sst = null;

        if (!empty($project->contractorAppointment)) {
            
            if (!empty($request->contractor_sst)) {
                $contractor_sst = Carbon::parse($request->contractor_sst);
            }

            $project->contractorAppointment->sst = $contractor_sst;
            $project->contractorAppointment->sst_reference_no = $request->contractor_sst_reference;
            $project->contractorAppointment->contract_value = !empty($request->contractor_value) ? removeMaskMoney($request->contractor_value) : null;
            $project->contractorAppointment->updated_by = \Auth::user()->id;
            $project->contractorAppointment->active = 1;
            $project->contractorAppointment->save();

            return redirect()
                ->route('contractors.index', $project->id)
                ->with('success', 'Maklumat perlantikan kontraktor telah berjaya dikemaskini.');
        } else {
            if (!empty($request->contractor_sst)) {
                $contractor_sst = Carbon::parse($request->contractor_sst);
            }

            $appointment = new Appointment;
            $appointment->project_id = $project->id;
            $appointment->sst = $contractor_sst;
            $appointment->sst_reference_no = $request->contractor_sst_reference;
            $appointment->contract_value = !empty($request->contractor_value) ? removeMaskMoney($request->contractor_value) : null;
            $appointment->created_by = \Auth::user()->id;
            $appointment->active = 1;
            $appointment->save();

            return redirect()
                ->route('contractors.index', $project->id)
                ->with('success', 'Maklumat perlantikan kontraktor telah berjaya dikemaskini.');
        }
    }

    public function storeDetails($project_id, Request $request)
    {
        $project = Project::find($project_id);
        $contractor_ssm_start_date = null;
        $contractor_ssm_end_date = null;
        $contractor_mof_start_date = null;
        $contractor_mof_end_date = null;

        if (!empty($project->contractorAppointment)) {
            if (!empty($request->contractor_ssm_start_date)) {
                $contractor_ssm_start_date = Carbon::parse($request->contractor_ssm_start_date);
            }

            if (!empty($request->contractor_ssm_end_date)) {
                $contractor_ssm_end_date = Carbon::parse($request->contractor_ssm_end_date);
            }

            if (!empty($request->contractor_mof_start_date)) {
                $contractor_mof_start_date = Carbon::parse($request->contractor_mof_start_date);
            }

            if (!empty($request->contractor_mof_end_date)) {
                $contractor_mof_end_date = Carbon::parse($request->contractor_mof_end_date);
            }
            $project->contractorAppointment->ssm_no = $request->contractor_ssm;
            $project->contractorAppointment->ssm_reference_no = $request->contractor_ssm_reference;
            $project->contractorAppointment->ssm_start_date = $contractor_ssm_start_date;
            $project->contractorAppointment->ssm_end_date = $contractor_ssm_end_date;
            $project->contractorAppointment->mof_no = $request->contractor_mof;
            $project->contractorAppointment->mof_reference_no = $request->contractor_mof_reference;
            $project->contractorAppointment->mof_start_date = $contractor_mof_start_date;
            $project->contractorAppointment->mof_end_date = $contractor_mof_end_date;
            $project->contractorAppointment->company_name = $request->contractor_company_name;
            $project->contractorAppointment->company_address = $request->contractor_company_address;
            $project->contractorAppointment->company_tel = $request->contractor_company_tel;
            $project->contractorAppointment->company_fax = $request->contractor_company_fax;
            $project->contractorAppointment->updated_by = \Auth::user()->id;
            $project->contractorAppointment->active = 1;
            $project->contractorAppointment->save();

            return redirect()
                ->route('contractors.index', $project->id)
                ->with('success', 'Maklumat syarikat untuk kontraktor telah berjaya dikemaskini.');
        } else {
            if (!empty($request->contractor_ssm_start_date)) {
                $contractor_ssm_start_date = Carbon::parse($request->contractor_ssm_start_date);
            }

            if (!empty($request->contractor_ssm_end_date)) {
                $contractor_ssm_end_date = Carbon::parse($request->contractor_ssm_end_date);
            }

            if (!empty($request->contractor_mof_start_date)) {
                $contractor_mof_start_date = Carbon::parse($request->contractor_mof_start_date);
            }

            if (!empty($request->contractor_mof_end_date)) {
                $contractor_mof_end_date = Carbon::parse($request->contractor_mof_end_date);
            }

            $appointment = new Appointment;
            $appointment->ssm_no = $request->contractor_ssm;
            $appointment->ssm_reference_no = $request->contractor_ssm_reference;
            $appointment->ssm_start_date = $contractor_ssm_start_date;
            $appointment->ssm_end_date = $contractor_ssm_end_date;
            $appointment->mof_no = $request->contractor_mof;
            $appointment->mof_reference_no = $request->contractor_mof_reference;
            $appointment->mof_start_date = $contractor_mof_start_date;
            $appointment->mof_end_date = $contractor_mof_end_date;
            $appointment->company_name = $request->contractor_company_name;
            $appointment->company_address = $request->contractor_company_address;
            $appointment->company_tel = $request->contractor_company_tel;
            $appointment->company_fax = $request->contractor_company_fax;
            $appointment->created_by = \Auth::user()->id;
            $appointment->active = 1;
            $appointment->save();

            return redirect()
                ->route('contractors.index', $project->id)
                ->with('success', 'Maklumat syarikat untuk kontraktor telah berjaya dikemaskini.');
        }
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
        $contractor_duration_start_date = null;
        $contractor_duration_end_date = null;

        if (!empty($project->contractorAppointment)) {
            if (!empty($request->contractor_duration_start_date)) {
                $contractor_duration_start_date = Carbon::parse($request->contractor_duration_start_date);
            }

            if (!empty($request->contractor_duration_end_date)) {
                $contractor_duration_end_date = Carbon::parse($request->contractor_duration_end_date);
            }

            $project->contractorAppointment->contract_start_date = $contractor_duration_start_date;
            $project->contractorAppointment->contract_end_date = $contractor_duration_end_date;
            $project->contractorAppointment->save();

            return redirect()
                ->route('contractors.index', $project->id)
                ->with('success', 'Tempoh kontrak telah berjaya dikemaskini.');
        } else {
            if (!empty($$request->contractor_duration_start_date)) {
                $contractor_duration_start_date = Carbon::parse($request->contractor_duration_start_date);
            }

            if (!empty($request->contractor_duration_end_date)) {
                $contractor_duration_end_date = Carbon::parse($request->contractor_duration_end_date);
            }

            $appointment = new Appointment;
            $appointment->contract_start_date = Carbon::parse($request->contractor_duration_start_date);
            $appointment->contract_end_date = Carbon::parse($request->contractor_duration_end_date);
            $appointment->save();

            return redirect()
                ->route('contractors.index', $project->id)
                ->with('success', 'Tempoh kontrak telah berjaya dikemaskini.');
        }
    }
}
