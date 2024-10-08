<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('superadmin')) {
            return view('roles.index');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function get_data()
    {
        $roles = DB::table('roles as r')
            ->select(
                'r.id',
                'r.name',
                DB::raw('GROUP_CONCAT(
                CONCAT(
                    "<span class=\"inline-block bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded mb-2\">",
                    p.name,
                    "</span>"
                ) SEPARATOR " "
            ) as permissions'),
                DB::raw("CONCAT('
                    <button class=\"btn btn-sm m-1 btn-info manage-permission-btn\" data-role-id=\"', r.id, '\" >Manage Permission</button>
                    <button class=\"btn btn-sm m-1 btn-danger delete-role-btn\" data-role-id=\"', r.id, '\">Delete Role</button>
                ') as action")
            )
            ->leftJoin('role_has_permissions as r_p', 'r.id', '=', 'r_p.role_id')
            ->leftJoin('permissions as p', 'r_p.permission_id', '=', 'p.id')
            ->groupBy('r.id', 'r.name')
            ->get();
        return response()->json(['data' => $roles]); // Ensure correct JSON response
        // <button class=\"btn btn-sm m-1 btn-warning edit-role-btn\" data-role-id=\"', r.id, '\">Edit Role Details</button>
    }

    public function view_permission_role($id)
    {
        $permission_role = Role::with('permissions')->find($id);

        if (!$permission_role) {
            // Optionally, handle the case where the role doesn't exist
            return redirect()->back()->with('error', 'Role not found.');
        }

        // Transform the permissions data
        $permissionData = $permission_role->permissions->map(function ($permission) {
            return [
                'permission_role_id' => $permission->pivot->id, // Assuming the pivot has an id
                'permission_name' => $permission->name,
            ];
        });

        return view('roles.view_permission', compact('permission_role', 'permissionData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // If validation passes
        if ($validated) {
            Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web',
            ]);

            return response()->json(['success' => 'Role added successfully']);
        }

        return response()->json(['error' => 'Validation failed'], 422);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function edit($id)
    {
        $roles = Role::findOrFail($id);
        if (!$roles) {
            return redirect()->route('roles.index')->with('error', 'roles not found.');
        }

        return view('roles.edit', ['roles' => $roles]);
    }

    public function update(Request $request, Role $roles)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try {
            $roles->update($validated);
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);
            $role->delete();
            return response()->json(['success' => 'Role deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting role: ' . $e->getMessage()], 500);
        }
    }
}
