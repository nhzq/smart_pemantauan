<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(5);

        return view('modules.acl.roles.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('modules.acl.roles.create', [
            'permissions' => $permissions 
        ]);
    }

    public function store(Request $request)
    {
        $role_name = strtolower($request->role_name);

        if (!empty($role_name)) {
            $findRole = Role::where('name', '=', $role_name)->first();
            
            if (!empty($findRole)) {
                return redirect()
                        ->back()
                        ->with('error', ucwords($request->role_name) . ' already exists. Please use different name');
            } else {
                $role = Role::create(['name' => $role_name]);
                $permission = $role->syncPermissions($request->permission_name);

                return redirect()
                        ->route('roles.index')
                        ->with('success', ucwords($request->role_name) . ' has been saved');
            }
        }

        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();

        return view('modules.acl.roles.edit', [
            'role' => $role, 
            'permissions' => $permissions 
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (!empty($role)) {
            $role->name = strtolower($request->role_name);
            $role->save();

            // Update permission
            $role->syncPermissions($request->permission_name);

            return redirect()
                    ->route('roles.index')
                    ->with('success', ucwords($request->role_name) . ' has been updated');
        }
    }

    public function destroy($id)
    {
        //
    }
}
