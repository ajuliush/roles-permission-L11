<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission::factory()->count(50)->create();
        $permissions = [
            ['name' => 'Dashboard', 'slug' => 'Dashboard', 'groupby' => 0],

            ['name' => 'User', 'slug' => 'User', 'groupby' => 1],
            ['name' => 'Add User', 'slug' => 'Add User', 'groupby' => 1],
            ['name' => 'Edit User', 'slug' => 'Edit User', 'groupby' => 1],
            ['name' => 'Delete User', 'slug' => 'Delete User', 'groupby' => 1],

            ['name' => 'Role', 'slug' => 'Role', 'groupby' => 2],
            ['name' => 'Add Role', 'slug' => 'Add Role', 'groupby' => 2],
            ['name' => 'Edit Role', 'slug' => 'Edit Role', 'groupby' => 2],
            ['name' => 'Delete Role', 'slug' => 'Delete Role', 'groupby' => 2],

            ['name' => 'Category', 'slug' => 'Category', 'groupby' => 3],
            ['name' => 'Edit Category', 'slug' => 'Edit Category', 'groupby' => 3],
            ['name' => 'Add Category', 'slug' => 'Add Category', 'groupby' => 3],
            ['name' => 'Delete Category', 'slug' => 'Delete Category', 'groupby' => 3],

            ['name' => 'Setting', 'slug' => 'Setting', 'groupby' => 4],

            ['name' => 'Slider', 'slug' => 'Slider', 'groupby' => 5],
            ['name' => 'Add Slider', 'slug' => 'Add Slider', 'groupby' => 5],
            ['name' => 'Edit Slider', 'slug' => 'Edit Slider', 'groupby' => 5],
            ['name' => 'Delete Slider', 'slug' => 'Delete Slider', 'groupby' => 5],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
