<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view-dashboard',

            'view-students',
            'create-students',
            'edit-students',
            'delete-students',

            'view-teachers',
            'create-teachers',
            'edit-teachers',
            'delete-teachers',

            'view-courses',
            'create-courses',
            'edit-courses',
            'delete-courses',

            'view-subjects',
            'create-subjects',
            'edit-subjects',
            'delete-subjects',

            'view-results',
            'create-results',
            'edit-results',
            'delete-results',

            'view-profiles',
            'edit-profiles',

            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',

            'view-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }



        // Super Admin
        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $superAdmin->syncPermissions(
            Permission::all()
        );


        // Admin
        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions([
            'view-dashboard',

            'view-students',
            'create-students',
            'edit-students',
            'delete-students',

            'view-teachers',
            'create-teachers',
            'edit-teachers',
            'delete-teachers',

            'view-courses',
            'create-courses',
            'edit-courses',
            'delete-courses',

            'view-subjects',
            'create-subjects',
            'edit-subjects',
            'delete-subjects',

            'view-results',

            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',

            'view-reports',
        ]);


        // Teacher
        $teacher = Role::firstOrCreate([
            'name' => 'Teacher',
            'guard_name' => 'web',
        ]);

        $teacher->syncPermissions([
            'view-dashboard',

            'view-students',

            'view-courses',

            'view-subjects',

            'view-results',
            'create-results',
            'edit-results',

            'view-profiles',
            'edit-profiles',
        ]);


        // Student
        $student = Role::firstOrCreate([
            'name' => 'Student',
            'guard_name' => 'web',
        ]);

        $student->syncPermissions([
            'view-dashboard',

            'view-courses',
            'view-subjects',

            'view-results',

            'view-profiles',
            'edit-profiles',
        ]);


        // Manager
        $manager = Role::firstOrCreate([
            'name' => 'Manager',
            'guard_name' => 'web',
        ]);

        $manager->syncPermissions([
            'view-dashboard',

            'view-students',
            'view-teachers',
            'view-courses',
            'view-subjects',
            'view-results',

            'view-reports',
        ]);


        // Guest
        $guest = Role::firstOrCreate([
            'name' => 'Guest',
            'guard_name' => 'web',
        ]);

        $guest->syncPermissions([
            'view-courses',
            'view-subjects',
        ]);
    
    }
}
