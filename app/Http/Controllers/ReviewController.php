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
            $project->status = Status::initial_approved_by_ks();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $review = Review::create([
                'project_id' => $id,
                'status' => Status::initial_approved_by_ks(),
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
            $project->status = Status::initial_rejected_by_ks();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $request->validate(['review_content' => 'required']);
            
            $review = Review::create([
                'project_id' => $id,
                'status' => Status::initial_rejected_by_ks(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah ditolak.');
    }

    public function kivKS(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $project = Project::find($id);
            $project->status = Status::initial_kiv_by_ks();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $request->validate(['review_content' => 'required']);
            
            $review = Review::create([
                'project_id' => $id,
                'status' => Status::initial_kiv_by_ks(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Status projek telah berjaya dikemaskini.');
    }

    public function approveSUB(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $project = Project::find($id);
            $project->status = Status::initial_approved_by_sub();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $review = Review::create([
                'project_id' => $id,
                'status' => Status::initial_approved_by_sub(),
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
            $project->status = Status::initial_rejected_by_sub();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $request->validate(['review_content' => 'required']);
            
            $review = Review::create([
                'project_id' => $id,
                'status' => Status::initial_rejected_by_sub(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah ditolak');
    }

    public function kivSUB(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $project = Project::find($id);
            $project->status = Status::initial_kiv_by_sub();
            $project->updated_by = \Auth::user()->id;
            $project->save();

            $request->validate(['review_content' => 'required']);
            
            $review = Review::create([
                'project_id' => $id,
                'status' => Status::initial_kiv_by_sub(),
                'content' => $request->review_content,
                'created_by' => \Auth::user()->id
            ]);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Projek telah berjaya dikemaskini.');
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

        $project->status = Status::planning_approved_by_ks();
        $project->save();

        $project->reviews()->create([
            'project_id' => $project_id,
            'status' => Status::planning_approved_by_ks(),
            'content' => $request->review_comment,
            'created_by' => \Auth::user()->id
        ]);

        return redirect()->back();
    }

    public function planningRejectKS($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $project->status = Status::planning_rejected_by_ks();
        $project->save();

        $project->reviews()->create([
            'project_id' => $project_id,
            'status' => Status::planning_rejected_by_ks(),
            'content' => $request->review_comment,
            'created_by' => \Auth::user()->id
        ]);

        return redirect()->back();
    }

    public function planningKivKS($project_id, Request $request)
    {
        $project = Project::find($project_id);

        $project->status = Status::planning_kiv_by_ks();
        $project->save();

        $project->reviews()->create([
            'project_id' => $project_id,
            'status' => Status::planning_kiv_by_ks(),
            'content' => $request->review_comment,
            'created_by' => \Auth::user()->id
        ]);

        return redirect()->back();
    }
}
