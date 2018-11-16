<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin']);
    }

    public function index()
    {
        $roles = Role::all();

        return view('modules.settings.roles.index', [
            'roles' => $roles
        ]);
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if ($role->name === 'superadmin') {
            return redirect()
                ->back()
                ->with('error', 'Superadmin cannot be edited');
        }

        return view('modules.settings.roles.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_displayed_name' => 'required|string|min:3'
        ]);

        $role = Role::find($id);
        $role->displayed_name = $request->role_displayed_name;
        $role->save();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role\'s displayed name has been updated');
    }

    public function destroy($id)
    {
        //
    }
}
