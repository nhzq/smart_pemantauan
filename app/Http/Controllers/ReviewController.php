<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Helpers\Status;
use App\Models\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ks|sub']);
    }

    public function show($id)
    {
        $project = Project::find($id);

        return view('modules.reviews.view', [
            'project' => $project
        ]);
    }

    public function approveKS(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $project = Project::find($id);
            $project->status = Status::isApprovedByKS();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $review = Review::create([
                'project_id' => $id,
                'status' => Status::isApprovedByKS(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah diterima.');
    }

    public function rejectKS(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $project = Project::find($id);
            $project->status = Status::isRejectedByKS();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $request->validate(['review_content' => 'required']);
            
            $review = Review::create([
                'project_id' => $id,
                'status' => Status::isRejectedByKS(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah ditolak.');
    }

    public function approveSUB(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $project = Project::find($id);
            $project->status = Status::isApprovedBySUB();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $review = Review::create([
                'project_id' => $id,
                'status' => Status::isApprovedBySUB(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah diterima');
    }

    public function rejectSUB(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $project = Project::find($id);
            $project->status = Status::isRejectedBySUB();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $request->validate(['review_content' => 'required']);
            
            $review = Review::create([
                'project_id' => $id,
                'status' => Status::isRejectedBySUB(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah ditolak');
    }

    public function timeline($id)
    {
        $project = Project::find($id);

        return view('modules.projects.timeline', [
            'project' => $project
        ]);
    }
}
