<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('superadmin')) {
            return view('permission.index');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function get_data()
    {
        $permissions = DB::table('permissions as p')
            ->select(
                'p.id',
                'p.name',
                DB::raw("IF(
            MAX(rp.role_id) IS NULL,
            CONCAT('<button class=\"btn btn-sm m-1 btn-danger delete-permission-btn\" data-permission-id=\"', p.id, '\">Delete permission</button>'),
            ''
        ) as action")
            )
            ->leftJoin('role_has_permissions as rp', 'p.id', '=', 'rp.permission_id') // Left join to check role associations
            ->groupBy('p.id', 'p.name')
            ->get();

        return response()->json(['data' => $permissions]); // Ensure correct JSON response

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // If validation passes
        if ($validated) {
            Permission::create([
                'name' => $validated['name'],
                'guard_name' => 'web',
            ]);

            return response()->json(['success' => 'Permission added successfully']);
        }

        return response()->json(['error' => 'Validation failed'], 422);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        if (!$permission) {
            return redirect()->route('permission.index')->with('error', 'permission not found.');
        }

        return view('permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try {
            $permission->update($validated);
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Validate that the ID is present in the request
            $permission = Permission::findOrFail($id);

            // Delete the permission
            $permission->delete();

            return response()->json(['success' => 'Permission deleted successfully']);
        } catch (ModelNotFoundException $e) {
            // Specific catch for not found exception
            return response()->json(['error' => 'Permission not found'], 404);
        } catch (\Exception $e) {
            // General exception catch
            return response()->json(['error' => 'Error deleting permission: ' . $e->getMessage()], 500);
        }
    }
}
