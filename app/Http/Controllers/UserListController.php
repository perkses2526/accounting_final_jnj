<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade

class UserListController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('superadmin')) {
            return view('user_list.index');
        } else {
            abort(403, 'Unauthorized'); // Or redirect to another page
        }
    }

    public function set_add_role()
    {
        $roles = Role::select('id', 'name')->get(); // Retrieve roles with both 'id' and 'name' columns
        return response()->json($roles); // Return as JSON
    }

    public function get_data()
    {

        $users = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') // Join condition
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id') // Include role information
            ->select(
                'users.id',
                'users.last_name',
                'users.first_name',
                'users.middle_name',
                'users.email',
                DB::raw('IF(GROUP_CONCAT(roles.name SEPARATOR ", ") IS NULL, CONCAT(\'<button class=\"btn btn-sm btn-warning btn-add-role\">Add Role</button>\') , GROUP_CONCAT(roles.name SEPARATOR ", ")) as roles'), // Aggregate role names with a comma separator
                'users.created_at',
                DB::raw("CONCAT('<button class=\"btn btn-sm btn-primary\">View</button>') as Action")
            )
            ->groupBy('users.id', 'users.last_name', 'users.first_name', 'users.middle_name', 'users.email', 'users.created_at') // Group by all selected fields except for aggregated ones
            ->orderBy('users.created_at', 'desc')
            ->get();

        return response()->json(['data' => $users]); // Return the data as JSON

    }
}