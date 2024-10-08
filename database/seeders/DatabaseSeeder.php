<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Tickets;
use App\Models\TransactionList;
use App\Models\TransactionPermission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */


        $roles = [
            'superadmin',
            'admin',
            'editor',
            'viewer'
        ];

        foreach ($roles as $roleName) {
            Role::create([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }

        $permissions = [
            'view',
            'create',
            'update',
            'delete'
        ];

        foreach ($permissions as $permissionName) {
            Permission::create([
                'name' => $permissionName,
                'guard_name' => 'web'
            ]);
        }

        $rolePermissions = [
            'superadmin' => ['view', 'create', 'update', 'delete'],
            'admin'      => ['view', 'create', 'update'],
            'editor'     => ['view', 'update'],
            'viewer'     => ['view']
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                $role->givePermissionTo($permission); // Spatie's givePermissionTo method
            }
        }

        $superAdminUser = User::factory()->create([
            'last_name' => 'Admin',
            'first_name' => 'Super',
            'middle_name' => NULL,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'status' => 'Active'
        ]);

        $adminUser = User::factory()->create([
            'last_name' => 'Admin',
            'first_name' => 'Tony',
            'middle_name' => NULL,
            'email' => 'tony.admin@gmail.com',
            'password' => bcrypt('admin123'),
            'status' => 'Active'
        ]);

        $adminUser2 = User::factory()->create([
            'last_name' => 'Admin',
            'first_name' => 'JC',
            'middle_name' => NULL,
            'email' => 'jc_admin@gmail.com',
            'password' => bcrypt('admin123'),
            'status' => 'Active'
        ]);

        $adminUser3 = User::factory()->create([
            'last_name' => 'Admin',
            'first_name' => 'Paulo',
            'middle_name' => NULL,
            'email' => 'paulo_admin@gmail.com',
            'password' => bcrypt('admin123'),
            'status' => 'Active'
        ]);

        $editorUser = User::factory()->create([
            'last_name' => 'Smith',
            'first_name' => 'Jane',
            'middle_name' => NULL,
            'email' => 'editor_user@gmail.com',
            'password' => bcrypt('editor123'),
            'status' => 'Active'
        ]);

        $viewerUser = User::factory()->create([
            'last_name' => 'Taylor',
            'first_name' => 'Bob',
            'middle_name' => NULL,
            'email' => 'viewer_user@gmail.com',
            'password' => bcrypt('viewer123'),
            'status' => 'Active'
        ]);

        // Assign roles to users using Spatie's assignRole method
        $superAdminUser->assignRole('superadmin');
        $adminUser->assignRole('admin');
        $adminUser2->assignRole('admin');
        $adminUser3->assignRole('admin');
        $editorUser->assignRole('editor');
        $viewerUser->assignRole('viewer');

        $company_data = [
            ['company_name' => 'Company ABC', 'company_code' => 'ABC'],
            ['company_name' => 'Company XYZ', 'company_code' => 'XYZ']
        ];

        foreach ($company_data as $company) {
            Company::create([
                'company_name' => $company['company_name'],
                'company_code' => $company['company_code'],
            ]);
        }

        // division fake data
        $divisions_data = [
            ['company_id' => 1, 'division_name' => 'Division ABC', 'division_code' => 'DIVABC'],
            ['company_id' => 2, 'division_name' => 'Division XYZ', 'division_code' => 'DIVXYZ'],
        ];

        foreach ($divisions_data as $division) {
            Division::create([
                'company_id' => $division['company_id'],
                'division_name' => $division['division_name'],
                'division_code' => $division['division_code'],
            ]);
        }
        //department fake data
        $dept_data = [
            ['division_id' => 1, 'department_name' => 'Department ABC', 'department_code' => 'DEPTABC'],
            ['division_id' => 2, 'department_name' => 'Department XYZ', 'department_code' => 'DEPTXYZ'],
        ];

        foreach ($dept_data as $department) {
            Department::create([
                'division_id' => $department['division_id'],
                'department_name' => $department['department_name'],
                'department_code' => $department['department_code'],
            ]);
        }

        $transaction_list = [
            'sales',
            'accounts payables',
            'payroll'
        ];

        foreach ($transaction_list as $transaction) {
            TransactionList::create([
                'transaction_name' => $transaction
            ]);
        }

        $transaction_permissions = [
            ['transaction_id' => 1, 'user_id' => 1],
            ['transaction_id' => 2, 'user_id' => 1],
            ['transaction_id' => 3, 'user_id' => 1],
            ['transaction_id' => 1, 'user_id' => 2],
            ['transaction_id' => 2, 'user_id' => 2],
            ['transaction_id' => 2, 'user_id' => 3],
            ['transaction_id' => 1, 'user_id' => 3],
            ['transaction_id' => 2, 'user_id' => 3],
            ['transaction_id' => 3, 'user_id' => 3],
            ['transaction_id' => 1, 'user_id' => 4],
            ['transaction_id' => 2, 'user_id' => 4],
            ['transaction_id' => 3, 'user_id' => 4],
            ['transaction_id' => 3, 'user_id' => 5],
        ];

        foreach ($transaction_permissions as $transaction_permission) {
            TransactionPermission::create($transaction_permission);
        }

        Tickets::factory()->count(50)->create();
    }
}
