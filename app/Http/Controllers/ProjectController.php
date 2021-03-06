<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Status;
use App\Models\Project;
use App\Models\LookupBudgetType as Budget;
use App\Models\LookupSubBudgetType as SubBudget;
use App\Models\Allocation;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $subs = SubBudget::where('lookup_budget_type_id', 2)->get();

        $projects = Project::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->paginate(20);

        $projectsForOfficer = Project::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->where('appointed_to', \Auth::user()->id)
            ->paginate(20);

        $projectsForSUB = Project::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->whereNotIn('status', [1, 3])
            ->paginate(20);

        return view('modules.projects.index', [
            'subs' => $subs,
            'projects' => $projects,
            'projectsForSUB' => $projectsForSUB,
            'projectsForOfficer' => $projectsForOfficer
        ]);
    }

    public function create()
    {
        $budgets = Budget::where('lookup_department_id', 2)->get();

        return view('modules.projects.create', [
            'budgets' => $budgets
        ]);
    }

    public function ajaxSubType(Request $request)
    {
        $data = SubBudget::where('lookup_budget_type_id', $request->id)->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $estimate_cost = removeMaskMoney($request->project_estimate_cost);

        $allocation = Allocation::where('lookup_sub_budget_type_id', $request->project_sub_budget_type)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        $total_estimate_cost = Project::where('lookup_sub_budget_type_id', $request->project_sub_budget_type)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->sum('estimate_cost');

        $from_transfer = 0;
        $to_transfer = 0;
        $net_allocation = $allocation->amount ?? 0;

        if (!empty($allocation)) {
            $from_transfer = $allocation->transfers()
                ->where('from_sub_type_id', $allocation->lookup_sub_budget_type_id)
                ->where('active', 1)
                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            $to_transfer = $allocation->transfers()
                ->where('to_sub_type_id', $allocation->lookup_sub_budget_type_id)
                ->where('active', 1)
                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            if ($from_transfer > 0) {
                $net_allocation = $net_allocation - $from_transfer;
            }

            if ($to_transfer > 0) {
                $net_allocation = $net_allocation + $to_transfer;
            }
        }

        $balance = getEstimateCostBalance($total_estimate_cost, $net_allocation);

        if (!empty($allocation)) {
            if ($estimate_cost <= $balance) {
                DB::transaction(function () use ($request, $allocation) {
                    $project = Project::create([
                        'allocation_id' => $allocation->id,
                        'section_id' => $this->getSection(),
                        'unit_id' => $this->getUnit(),
                        'lookup_budget_type_id' => $request->project_budget_type,
                        'lookup_sub_budget_type_id' => $request->project_sub_budget_type,
                        'name' => $request->project_name,
                        'file_reference_no' => $request->project_file_reference,
                        'initial_scope' => $request->project_scope,
                        // 'initial_concept' => $request->project_concept,
                        'initial_purpose' => $request->project_purpose,
                        'estimate_cost' => removeMaskMoney($request->project_estimate_cost),
                        'approval_date' => setDateValue($request->project_approval_date, Carbon::createFromFormat('d/m/Y', $request->project_approval_date)),
                        'rmk' => $request->project_rmk,
                        'market_research' => $request->optradio,
                        'status' => Status::project_application(),
                        'year' => Carbon::now()->year,
                        'created_by' => \Auth::user()->id,
                        'active' => 1
                    ]);

                    if ($request->hasFile('project_proposal_files')) {
                        foreach ($request->project_proposal_files as $data) {
                            if (!empty($data)) {
                                $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                                $data->storeAs('/public/projects/' . $project->id . '/', $doc_new_name);
                                $project->documents()->create([
                                    'project_id' => $project->id,
                                    'category' => 'kertas-cadangan',
                                    'file_name' => $doc_new_name,
                                    'original_name' => $data->getClientOriginalName(),
                                    'mime_type' => $data->getMimeType(),
                                    'size' => $data->getSize()
                                ]);
                            }
                        }
                    }

                    if ($request->hasFile('project_market_research_files')) {
                        foreach ($request->project_market_research_files as $data) {
                            if (!empty($data)) {
                                $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                                $data->storeAs('/public/projects/' . $project->id . '/', $doc_new_name);
                                $project->documents()->create([
                                    'project_id' => $project->id,
                                    'category' => 'kajian-pasaran',
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
                    ->route('projects.index')
                    ->with('success', 'Projek telah berjaya disimpan.');
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Anggaran kos projek ini telah melebihi kos projek yang ditetapkan.');
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Maaf, peruntukan untuk projek tidak ditetapkan lagi.');
    }

    public function show($id)
    {
        $project = Project::find($id);
        
        return view('modules.projects.view', [
            'project' => $project
        ]);
    }

    public function timeline($id)
    {
        $project = Project::find($id);

        return view('modules.projects.timeline', [
            'project' => $project
        ]);
    }

    public function edit($id)
    {
        $project = Project::find($id);
        $budgets = Budget::where('lookup_department_id', 2)->get();
        $subBudgets = SubBudget::where('lookup_budget_type_id', $project->lookup_budget_type_id)->get();

        if (Status::initial_approved_by_ks($project->status) || Status::initial_approved_by_sub($project->status)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Projek: ' . ucwords($project->name) . ' tidak boleh dikemaskini.');
        }

        return view('modules.projects.edit', [
            'project' => $project,
            'budgets' => $budgets,
            'subBudgets' => $subBudgets
        ]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        $approval_date = null;
        $estimate_cost = removeMaskMoney($request->project_estimate_cost);

        if (!empty($request->project_approval_date)) {
            $approval_date = Carbon::createFromFormat('d/m/Y', $request->project_approval_date);
        }

        $allocation = Allocation::where('lookup_sub_budget_type_id', $request->project_sub_budget_type)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->first();

        $total_estimate_cost = Project::where('lookup_sub_budget_type_id', $request->project_sub_budget_type)
            ->where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->sum('estimate_cost');

        $from_transfer = 0;
        $to_transfer = 0;
        $net_allocation = $allocation->amount ?? 0;

        if (!empty($allocation)) {
            $from_transfer = $allocation->transfers()
                ->where('from_sub_type_id', $allocation->lookup_sub_budget_type_id)
                ->where('active', 1)
                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            $to_transfer = $allocation->transfers()
                ->where('to_sub_type_id', $allocation->lookup_sub_budget_type_id)
                ->where('active', 1)
                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                ->sum('transfer_amount');

            if ($from_transfer > 0) {
                $net_allocation = $net_allocation - $from_transfer;
            }

            if ($to_transfer > 0) {
                $net_allocation = $net_allocation + $to_transfer;
            }
        }

        $balance = getEstimateCostBalance($total_estimate_cost, $net_allocation + $project->estimate_cost);

        if (!empty($allocation)) {
            if ($estimate_cost <= $balance) {
                $project->lookup_budget_type_id = $request->project_budget_type;
                $project->section_id = $this->getSection();
                $project->unit_id = $this->getUnit();
                $project->lookup_sub_budget_type_id = $request->project_sub_budget_type;
                $project->name = $request->project_name;
                $project->file_reference_no = $request->project_file_reference;
                $project->initial_scope = $request->project_scope;
                // $project->initial_concept = $request->project_concept;
                $project->initial_purpose = $request->project_purpose;
                $project->estimate_cost = removeMaskMoney($request->project_estimate_cost);
                $project->approval_date = $approval_date;
                $project->rmk = $request->project_rmk;
                $project->market_research = $request->optradio;
                $project->created_by = \Auth::user()->id;
                $project->status = Status::project_application();
                $project->save();

                return redirect()
                    ->route('projects.index')
                    ->with('success', 'Projek telah berjaya dikemaskini.');
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Anggaran kos projek ini telah melebihi kos projek yang ditetapkan.');
        }
    }

    public function delete($id)
    {
        //
    }

    public function getSection()
    {
        $user_section = null;

        if (!empty(\Auth::user()->unit->lookup_section_id)) {
            $user_section = \Auth::user()->unit->lookup_section_id;
        }

        return $user_section;
    }

    public function getUnit()
    {
        $user_unit = null;

        if (!empty(\Auth::user()->lookup_unit_id)) {
            $user_unit = \Auth::user()->lookup_unit_id;
        }

        return $user_unit;
    }
}
