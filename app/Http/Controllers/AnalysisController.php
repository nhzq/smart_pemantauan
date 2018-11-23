<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analysis;
use App\Models\Project;

class AnalysisController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);
        $analyses = Analysis::where('project_id', $project->id)->paginate(20);

        return view('modules.analyses.index', [
            'project' => $project,
            'analyses' => $analyses
        ]);
    }

    public function create($id)
    {
        $project = Project::find($id);

        return view('modules.analyses.create', [
            'project' => $project
        ]);
    }

    public function store(Request $request, $id)
    {
        if (!empty($request->analyses_position)) {
            foreach ($request->analyses_position as $key => $position) {
                $analysis = new Analysis;
                $analysis->project_id = $id;
                $analysis->position = $position;
                $analysis->total = $request->analyses_total[$key];
                $analysis->save();
            }
        } else {
            return redirect()
                ->back()
                ->with('error', 'Maklumat Pasukan Pembekal/ Kontraktor tidak berjaya disimpan.');
        }

        return redirect()
            ->route('analyses.index', $id)
            ->with('success', 'Maklumat Pasukan Pembekal/ Kontraktor telah berjaya disimpan.');
    }

    public function edit($project_id, $id)
    {
        $analysis = Analysis::find($id);

        return view('modules.analyses.edit', [
            'analysis' => $analysis,
            'project_id' => $project_id
        ]);
    }

    public function update($project_id, $id, Request $request)
    {
        $analysis = Analysis::find($id);
        $analysis->project_id = $project_id;
        $analysis->position = $request->analyses_position;
        $analysis->total = $request->analyses_total;
        $analysis->save();

        return redirect()
            ->route('analyses.index', $project_id)
            ->with('success', 'Maklumat Pasukan Pembekal/ Kontraktor telah berjaya dikemaskini.');
    }

    public function destroy($project_id, $id)
    {
        Analysis::where('id', $id)->delete();

        return redirect()
            ->back()
            ->with('success', 'Maklumat telah berjaya dihapuskan.');
    }
}
