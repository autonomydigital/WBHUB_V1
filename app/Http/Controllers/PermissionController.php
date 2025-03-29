<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all()->groupBy(function($perm) {
            return explode(' ', $perm->name)[0];
        });

        $selected = $request->role_id ?: $roles->first()->id;
        $role = Role::findOrFail($selected);

        return view('permissions.index', compact('roles','permissions','role','selected'));
    }

    public function update(Request $request)
    {
        $request->validate(['role_id'=>'required|exists:roles,id']);

        $role = Role::findById($request->role_id);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('permissions.index', ['role_id'=>$role->id])
                         ->with('success','Permissions updated successfully.');
    }
}