<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Show Role & Permission management page.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        $roles = Role::orderBy('name')->get();

        $permissions = Permission::orderBy('name')->get();

         $this->authorize("view-dashboard");

         
            return view('access-control.index', compact(
                'users',
                'roles',
                'permissions'
            ));
        


        // dd(auth()->user());
        abort(403);
    }


    /**
     * Create Role
     */
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name'
            ],
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return back()->with(
            'success',
            'Role created successfully.'
        );
    }


    /**
     * Create Permission
     */
    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name'
            ],
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return back()->with(
            'success',
            'Permission created successfully.'
        );
    }


    /**
     * Assign Role to User
     */
    public function assignRoleToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);

        $user->assignRole($request->role);

        return back()->with(
            'success',
            'Role assigned to user successfully.'
        );
    }


    /**
     * Assign Permission Directly to User
     */
    public function assignPermissionToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|exists:permissions,name',
        ]);

        $user = User::findOrFail($request->user_id);

        $user->givePermissionTo($request->permission);

        return back()->with(
            'success',
            'Permission assigned to user successfully.'
        );
    }


    /**
     * Assign Permissions to Role
     */
    public function assignPermissionsToRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        $permissions = Permission::whereIn(
            'id',
            $request->permissions
        )->get();

        $role->syncPermissions($permissions);

        return back()->with(
            'success',
            'Permissions assigned to role successfully.'
        );
    }
}
