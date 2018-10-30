<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Helpers\ProjectStatus as Status;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate('20');

        return view('modules.projects.index', [
            'projects' => $projects
        ]);
    }

    public function create()
    {
        return view('modules.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'project_cost' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'project_description' => 'required'
        ]);

        $project = new Project;
        $last_amount = Project::orderBy('id', 'desc')->pluck('total_amount')->first();

        $project->name = $request->project_name;
        $project->cost = $request->project_cost;
        $project->description = $request->project_description;
        $project->total_amount = !empty($last_amount) ? $last_amount + $request->project_cost : $request->project_cost;
        $project->status = Status::isAppliedByKU();
        $project->created_by = \Auth::user()->id;
        $project->save();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project has been saved');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('modules.projects.edit', [
            'project' => $project 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required',
            'project_cost' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'project_description' => 'required'
        ]);

        $project = Project::find($id);

        try {
            // Update total amount
            $projectLast = Project::getLastRow()->first();
            $projectLast->total_amount = $projectLast->total_amount - $project->cost + $request->project_cost;
            $projectLast->save();
        } catch (ValidationException $e) {
            return redirect()
                ->route('projects.index')
                ->with('error', 'Cannot update total cost of projects');
        }

        try {
            // Update Project
            $project->name = $request->project_name;
            $project->cost = $request->project_cost;
            $project->description = $request->project_description;
            $project->status = Status::isAppliedByKU();
            $project->created_by = \Auth::user()->id;
            $project->updated_by = \Auth::user()->id;
            $project->save();
        } catch (ValidationException $e) {
            return redirect()
                ->route('projects.index')
                ->with('error', 'Project cannot be updated');
        }

        
        return redirect()
            ->route('projects.index')
            ->with('success', 'Project has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $last = Project::getLastRow()->first();

        if ($project->id !== $last->id) {
            $last->total_amount = $last->total_amount - $project->cost;
            $last->save();

            $project->delete();

            return redirect()
                ->back()
                ->with('success', 'Project has been deleted');
        } else {
            $cost = $project->cost;
            $total_amount = $project->total_amount;

            $project->delete();

            $updatedLastRow = Project::getLastRow()->first();
            $updatedLastRow->total_amount = $total_amount - $cost;
            $updatedLastRow->save();

            return redirect()
                ->back()
                ->with('success', 'Project has been deleted');
        }
    }
}
