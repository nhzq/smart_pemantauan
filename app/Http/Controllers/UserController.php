<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\LookupJabatan as Jabatan;

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
        $jabatans = Jabatan::whereNotIn('nama', ['Developer'])->get();

        return view('modules.users.index', [
            'users' => $users,
            'roles' => $roles, 
            'jabatans' => $jabatans
        ]);
    }

    public function search(Request $request)
    {
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        $jabatans = Jabatan::whereNotIn('nama', ['Developer'])->get();
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

        if (!empty($request->user_jabatan)) {
            $users = $users->whereHas('jabatan', function ($query) use ($request) {
                        $query->where('id', 'LIKE', '%' . $request->user_jabatan . '%');
                    });
        }

        if (!empty($request->user_role)) {
            $users = $users->whereHas('roles', function ($query) use ($request) {
                        $query->where('id', 'LIKE', '%' . $request->user_role . '%');
                    });
        }

        $users = $users->paginate(12);

        return view('modules.users.index', [
            'users' => $users,
            'roles' => $roles, 
            'jabatans' => $jabatans
        ]);
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        $jabatans = Jabatan::whereNotIn('nama', ['Developer'])->get();

        return view('modules.users.create', [
            'roles' => $roles,
            'jabatans' => $jabatans
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'user_username' => 'required|string|unique:users,username',
            'user_email' => 'required|email|unique:users,email',
            'user_role' => 'required|not_in:0',
            'user_jabatan' => 'required|not_in:0'
        ]);

        $user = User::create([
            'name' => $request->user_name,
            'username' => $request->user_username,
            'email' => $request->user_email,
            'lookup_jabatan_id' => $request->user_jabatan,
            'password' => bcrypt('password')
        ]);

        $user->syncRoles($request->user_role);

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        $jabatans = Jabatan::whereNotIn('nama', ['Developer'])->get();

        if ($user->hasRole('superadmin')) {
            return redirect()
                ->back()
                ->with('error', 'Superadmin cannot be edited');
        }

        return view('modules.users.edit', [
            'user' => $user,
            'roles' => $roles, 
            'jabatans' => $jabatans
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        $request->validate([
            'user_name' => 'required|string',
            'user_username' => 'required|string|unique:users,username,' . $user->id,
            'user_email' => 'required|email|unique:users,email,' . $user->id,
            'user_role' => 'required|not_in:0',
            'user_jabatan' => 'required|not_in:0'
        ]);

        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->username = $request->user_username;
        $user->lookup_jabatan_id = $request->user_jabatan;
        $user->save();

        $user->syncRoles($request->user_role);

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been updated');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return redirect()
                ->back()
                ->with('error', 'Inactive user cannot be deleted');
        }

        if ($user->hasRole('superadmin')) {
            return redirect()
                ->back()
                ->with('error', 'Superadmin cannot be deactivated');
        }

        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'User has been deactivated');
    }

    public function activate($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        if (!empty($user)) {
            $user->restore();

            return redirect()
                ->route('users.index')
                ->with('success', 'User has been activated');
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
                ->with('success', 'User\'s password has been reset');
        }
    }
}
