<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Helpers\Status;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['unisel', 'ssdu']);
        })->get();

        return view('modules.officers.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['unisel', 'ssdu'])->get();
        $projects = Project::where('active', 1)
            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
            ->where('status', Status::planning_approved_by_ks())
            ->get();

        return view('modules.officers.create', [
            'roles' => $roles,
            'projects' => $projects
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->user_name,
                'ic' => $request->user_ic,
                'password' => bcrypt('password')
            ]);

            $user->syncRoles($request->user_role);

            $project = Project::where('id', $request->user_project)->first();
            $project->appointed_to = $user->id;
            $project->updated_by = \Auth::user()->id;
            $project->save();

            return redirect()
                ->route('officers.index')
                ->with('success', 'Maklumat akaun telah berjaya dikemaskini.');
        });
    }
}
