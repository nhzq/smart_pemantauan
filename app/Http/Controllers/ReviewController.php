<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Helpers\Status;
use App\Models\Review;

class ReviewController extends Controller
{
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

    public function planningIndex($project_id)
    {
        $project = Project::find($project_id);

        return view('modules.reviews.index', [
            'project' => $project
        ]);
    }

    public function planningApproveKS($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $project->status = Status::planningApprovedByKS();
        $project->save();

        $project->reviews()->create([
            'project_id' => $project_id,
            'status' => Status::planningApprovedByKS(),
            'content' => $request->review_comment,
            'created_by' => \Auth::user()->id
        ]);

        return redirect()->back();
    }

    public function planningRejectKS($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $project->status = Status::planningRejectedByKS();
        $project->save();

        $project->reviews()->create([
            'project_id' => $project_id,
            'status' => Status::planningRejectedByKS(),
            'content' => $request->review_comment,
            'created_by' => \Auth::user()->id
        ]);

        return redirect()->back();
    }
}
