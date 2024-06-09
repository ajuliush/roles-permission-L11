<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make(12345678), // Use bcrypt to hash the password
                'role_id' => 1, // Assuming role_id 1 corresponds to 'Admin'
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make(12345678), // Use bcrypt to hash the password
                'role_id' => 2, // Assuming role_id 2 corresponds to 'User'
            ],
            [
                'name' => 'Delivery Boy',
                'email' => 'delivery@example.com',
                'password' => Hash::make(12345678), // Use bcrypt to hash the password
                'role_id' => 3, // Assuming role_id 3 corresponds to 'Delivery Boy'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
