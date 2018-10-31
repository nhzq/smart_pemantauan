<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Helpers\ProjectStatus as Status;
use App\Models\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ketua-seksyen|ketua-jabatan-bahagian-teknologi-maklumat']);
    }

    public function index()
    {
        $projects = Project::paginate(20);
        $projectsKS = Project::whereIn('status', [Status::isApprovedByKS(), Status::isApprovedByKJ(), Status::isRejectedByKJ()])->paginate(20);

        return view('modules.reviews.index', [
            'projects' => $projects,
            'projectsKS' => $projectsKS
        ]);
    }

    public function show($id)
    {
        $project = Project::find($id);

        return view('modules.reviews.view', [
            'project' => $project
        ]);
    }

    public function approveKS($id)
    {
        $project = Project::find($id);
        $project->status = Status::isApprovedByKS();
        $project->updated_by = \Auth::user()->id;
        $project->save();

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Project has been approved');
    }

    public function rejectKS(Request $request, $id)
    {
        $project = Project::find($id);
        $project->status = Status::isRejectedByKS();
        $project->updated_by = \Auth::user()->id;
        $project->save();

        $request->validate(['review_content' => 'required']);
        
        $review = Review::create([
            'project_id' => $id,
            'content' => $request->review_content,
            'created_by' => \Auth::user()->id
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Project has been rejected');
    }

    public function approveKJ($id)
    {
        $project = Project::find($id);
        $project->status = Status::isApprovedByKJ();
        $project->updated_by = \Auth::user()->id;
        $project->save();

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Project has been approved');
    }

    public function rejectKJ(Request $request, $id)
    {
        $project = Project::find($id);
        $project->status = Status::isRejectedByKJ();
        $project->updated_by = \Auth::user()->id;
        $project->save();

        $request->validate(['review_content' => 'required']);
        
        $review = Review::create([
            'project_id' => $id,
            'content' => $request->review_content,
            'created_by' => \Auth::user()->id
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Project has been rejected');
    }
}
