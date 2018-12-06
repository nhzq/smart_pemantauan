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
        $projects = Project::where('active', 1)->paginate(20);
        // $projectsForSUB = Project::where('active', 1)->whereIn('status', [2, 4, 5])->paginate(20);
        $projectsForSUB = Project::where('active', 1)->whereNotIn('status', [1, 3])->paginate(20);

        return view('modules.projects.index', [
            'projects' => $projects,
            'projectsForSUB' => $projectsForSUB
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
        $get_budget_limit_id = $request->project_sub_budget_type;
        $estimate_cost = removeMaskMoney($request->project_estimate_cost);

        $allocation = Allocation::where('lookup_sub_budget_type_id', $get_budget_limit_id)->first();

        if (!empty($allocation)) {
            if ($estimate_cost <= $allocation->balance) {
                DB::transaction(function () use ($request, $allocation) {
                    $project = Project::create([
                        'lookup_budget_type_id' => $request->project_budget_type,
                        'lookup_sub_budget_type_id' => $request->project_sub_budget_type,
                        'name' => $request->project_name,
                        'file_reference_no' => $request->project_file_reference,
                        'concept' => $request->project_concept,
                        'estimate_cost' => !is_null($request->project_estimate_cost) ? removeMaskMoney($request->project_estimate_cost) : 0,
                        'approval_date' => Carbon::parse($request->project_approval_date),
                        'rmk' => $request->project_rmk,
                        'market_research' => $request->optradio,
                        'status' => Status::isAppliedByKU(),
                        'created_by' => \Auth::user()->id,
                        'active' => 1
                    ]);

                    if ($request->hasFile('project_proposal_files')) {
                        foreach ($request->project_proposal_files as $data) {
                            if (!empty($data)) {
                                $doc_new_name = time() . str_replace(' ', '-', $data->getClientOriginalName());
                                $data->storeAs('projects/' . $project->id . '/', $doc_new_name);
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
                                $data->storeAs('projects/' . $project->id . '/', $doc_new_name);
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

                    $total_estimate_cost = Project::where('lookup_sub_budget_type_id', $request->project_sub_budget_type)
                                                ->sum('estimate_cost');
                    $allocation->balance = $allocation->amount - $total_estimate_cost;
                    $allocation->save();
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

        if (Status::isApprovedByKS($project->status) || Status::isApprovedBySUB($project->status)) {
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

        $project->lookup_budget_type_id = $request->project_budget_type;
        $project->lookup_sub_budget_type_id = $request->project_sub_budget_type;
        $project->name = $request->project_name;
        $project->file_reference_no = $request->project_file_reference;
        $project->concept = $request->project_concept;
        $project->estimate_cost = removeMaskMoney($request->project_estimate_cost);
        $project->approval_date = Carbon::parse($request->project_approval_date);
        $project->rmk = $request->project_rmk;
        $project->market_research = $request->optradio;
        $project->created_by = \Auth::user()->id;
        $project->status = Status::isAppliedByKU();
        $project->save();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah berjaya dikemaskini.');
    }

    public function downloadFile($id, $filename)
    {
        $project = Project::find($id);

        return Storage::download('/projects/' . $project->id . '/' . $filename);
    }

    public function planningPhase($id)
    {
        $project = Project::find($id);
        $project->status = Status::toPlanningPhase();
        $project->save();

        return redirect()->route('info.index', $project->id);
    }

    public function delete($id)
    {
        //
    }
}
