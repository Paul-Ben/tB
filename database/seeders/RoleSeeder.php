<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $roles = [
            'admin' => 'Administrator with full system access',
            'manager' => 'Manager with administrative privileges',
            'teacher' => 'Teacher with classroom management access',
            'guardian' => 'Parent/Guardian with limited access to student information'
        ];

        foreach ($roles as $roleName => $description) {
            Role::firstOrCreate(
                ['name' => $roleName],
                ['guard_name' => 'web']
            );
        }

        // Create basic permissions
        $permissions = [
            'view-admin-dashboard',
            'view-manager-dashboard', 
            'view-teacher-dashboard',
            'view-guardian-dashboard',
            'manage-users',
            'manage-roles',
            'manage-students',
            'view-students',
            'manage-classes',
            'view-reports'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }

        // Assign permissions to roles
        $adminRole = Role::findByName('admin');
        $adminRole->syncPermissions($permissions); // Admin gets all permissions

        $managerRole = Role::findByName('manager');
        $managerRole->syncPermissions([
            'view-manager-dashboard',
            'manage-students',
            'view-students',
            'manage-classes',
            'view-reports'
        ]);

        $teacherRole = Role::findByName('teacher');
        $teacherRole->syncPermissions([
            'view-teacher-dashboard',
            'view-students',
            'manage-classes'
        ]);

        $guardianRole = Role::findByName('guardian');
        $guardianRole->syncPermissions([
            'view-guardian-dashboard',
            'view-students'
        ]);
    }
}
