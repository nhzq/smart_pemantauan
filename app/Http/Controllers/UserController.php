<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\LookupDepartment as Department;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin']);
    }

    public function index()
    {
        $users = User::withTrashed()->paginate(12);
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        $departments = Department::whereNotIn('name', ['Developer'])->get();

        return view('modules.settings.users.index', [
            'users' => $users,
            'roles' => $roles, 
            'departments' => $departments
        ]);
    }

    public function search(Request $request)
    {
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        $departments = Department::whereNotIn('name', ['Developer'])->get();
        $users = User::query();

        if (!empty($request->user_name)) {
            $users = $users->where('name', 'LIKE', '%' . $request->user_name . '%');
        }

        if (!empty($request->user_username)) {
            $users = $users->where('username', 'LIKE', '%' . $request->user_username . '%');
        }

        if (!empty($request->user_email)) {
            $users = $users->where('email', 'LIKE', '%' . $request->user_email . '%');
        }

        if (!empty($request->user_department)) {
            $users = $users->whereHas('department', function ($query) use ($request) {
                        $query->where('id', 'LIKE', '%' . $request->user_department . '%');
                    });
        }

        if (!empty($request->user_role)) {
            $users = $users->whereHas('roles', function ($query) use ($request) {
                        $query->where('id', 'LIKE', '%' . $request->user_role . '%');
                    });
        }

        $users = $users->paginate(12);

        return view('modules.settings.users.index', [
            'users' => $users,
            'roles' => $roles, 
            'departments' => $departments
        ]);
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        $departments = Department::whereNotIn('name', ['Developer'])->get();

        return view('modules.settings.users.create', [
            'roles' => $roles,
            'departments' => $departments
        ]);
    }

    public function ajaxSection(Request $request)
    {
        $data = \App\Models\LookupSection::all();

        return response()->json($data);
    }

    public function ajaxUnit(Request $request)
    {
        $data = \App\Models\LookupUnit::all();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'user_ic' => 'required|digits:12',
            'user_department' => 'required|not_in:0',
            'user_role' => 'required|not_in:0',
        ]);

        $user = User::create([
            'name' => $request->user_name,
            'ic' => $request->user_ic,
            'lookup_department_id' => $request->user_department,
            'lookup_section_id' => $request->user_section ?? null,
            'lookup_unit_id' => $request->user_unit ?? null,
            'password' => bcrypt('password')
        ]);

        $user->syncRoles($request->user_role);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna telah berjaya disimpan.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        $departments = Department::whereNotIn('name', ['Developer'])->get();

        if ($user->hasRole('superadmin')) {
            return redirect()
                ->back()
                ->with('error', 'Superadmin tidak boleh dikemaskini.');
        }

        return view('modules.settings.users.edit', [
            'user' => $user,
            'roles' => $roles, 
            'departments' => $departments
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        $request->validate([
            'user_name' => 'required|string',
            'user_ic' => 'required|digits:12|unique:users,ic,' . $user->id,
            'user_role' => 'required|not_in:0',
            'user_department' => 'required|not_in:0'
        ]);

        $user->name = $request->user_name;
        $user->ic = $request->user_ic;
        $user->lookup_department_id = $request->user_department;
        $user->lookup_section_id = $request->user_section ?? null;
        $user->lookup_unit_id = $request->user_unit ?? null;
        $user->save();

        $user->syncRoles($request->user_role);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna telah berjaya dikemaskini');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return redirect()
                ->back()
                ->with('error', 'Pengguna tidak aktif tidak boleh dihapuskan.');
        }

        if ($user->hasRole('superadmin')) {
            return redirect()
                ->back()
                ->with('error', 'Superadmin tidak boleh dinyahaktifkan');
        }

        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'Pengguna telah berjaya dinyahaktifkan');
    }

    public function activate($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        if (!empty($user)) {
            $user->restore();

            return redirect()
                ->route('users.index')
                ->with('success', 'Pengguna telah berjaya diaktifkan.');
        }
    }

    public function reset($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        if (!empty($user)) {
            $user->password = bcrypt('password');
            $user->save();

            return redirect()
                ->route('users.index')
                ->with('success', 'Kata laluan pengguna telah berjaya di set semula.');
        }
    }
}
