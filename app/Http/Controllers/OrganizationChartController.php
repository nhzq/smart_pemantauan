<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class OrganizationChartController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.chart.index', [
            'project' => $project
        ]);
    }

    public function store($project_id, Request $request)
    {
        $project = Project::find($project_id);
        
        if ($request->file('org_chart')) {
            $doc_new_name = time() . str_replace(' ', '-', $request->org_chart->getClientOriginalName());
            $request->org_chart->storeAs('/public/projects/' . $project->id . '/org-chart/', $doc_new_name);

            $project->chart()->create([
                'project_id' => $project->id,
                'category' => 'carta-organisasi',
                'file_name' => $doc_new_name,
                'original_name' => $request->org_chart->getClientOriginalName(),
                'mime_type' => $request->org_chart->getMimeType(),
                'size' => $request->org_chart->getSize()
            ]);
        }

        return redirect()->back();
    }
}
