<?php

namespace Database\Seeders;

use App\Models\PermissionRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PermissionRole::factory()->count(10)->create();
        $permissionRoles = [
            ['role_id' => 1, 'permission_id' => 1],  // Admin - Dashboard
            ['role_id' => 1, 'permission_id' => 2],  // Admin - Role
            ['role_id' => 1, 'permission_id' => 3],  // Admin - Add Role
            ['role_id' => 1, 'permission_id' => 4],  // Admin - Edit Role
            ['role_id' => 1, 'permission_id' => 5], // Admin - Delete Role
            ['role_id' => 1, 'permission_id' => 6], // User - User
            ['role_id' => 1, 'permission_id' => 7], // User - Add User
            ['role_id' => 1, 'permission_id' => 8], // User - Edit User
            ['role_id' => 1, 'permission_id' => 9], // User - Delete User
            ['role_id' => 1, 'permission_id' => 10], // Delivery Boy - Category
            ['role_id' => 1, 'permission_id' => 11], // Delivery Boy - Edit Category
            ['role_id' => 1, 'permission_id' => 12], // Delivery Boy - Add Category
            ['role_id' => 1, 'permission_id' => 13], // Delivery Boy - Delete Category
            ['role_id' => 1, 'permission_id' => 14], // Delivery Boy - Setting
            ['role_id' => 1, 'permission_id' => 15], // Delivery Boy - Slider
            ['role_id' => 1, 'permission_id' => 16], // Delivery Boy - Add Slider
            ['role_id' => 1, 'permission_id' => 17], // Delivery Boy - Edit Slider
            ['role_id' => 1, 'permission_id' => 18], // Delivery Boy - Delete Slider
        ];
        foreach ($permissionRoles as $permissionRole) {
            PermissionRole::create($permissionRole);
        }
    }
}
