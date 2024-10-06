<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //
    public function index()
    {
        if (auth()->user()->hasRole('superadmin')) {
            return view('roles.index'); // Create this view
        } else {
            abort(403, 'Unauthorized'); // Or redirect to another page
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
                <button class=\"btn btn-sm m-1 btn-info view_user\">Manage Permission</button>
                <button class=\"btn btn-sm m-1 btn-warning view_user\">Edit Role Details</button>
                <button class=\"btn btn-sm m-1 btn-danger view_user\" onclick=\"remove_role(this);\">Delete Role</button>
                ') as action")
            )
            ->leftJoin('role_has_permissions as r_p', 'r.id', '=', 'r_p.role_id')
            ->leftJoin('permissions as p', 'r_p.permission_id', '=', 'p.id')
            ->groupBy('r.id', 'r.name')
            ->get();
        return response()->json(['data' => $roles]); // Ensure correct JSON response
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
                'guard_name' => 'web', // Always default to 'web'
            ]);

            return response()->json(['success' => 'Role added successfully']);
        }

        return response()->json(['error' => 'Validation failed'], 422);
    }



    public function create()
    {
        return view('roles.create');
    }

    public function destroy(Request $request)
    {
        try {
            // Find the role by its ID or fail
            $role = Role::findOrFail($request->id);

            // Delete the role
            $role->delete();

            // Return success response
            return response()->json(['success' => 'Role deleted successfully']);
        } catch (\Exception $e) {
            // Handle any errors, for instance if the role is not found or fails to delete
            return response()->json(['error' => 'Error deleting role: ' . $e->getMessage()], 500);
        }
    }
}
