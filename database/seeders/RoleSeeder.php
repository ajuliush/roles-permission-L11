<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Role::factory()->count(3)->create();
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'User'],
            ['name' => 'Delivery Boy'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
