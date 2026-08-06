<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'user_id' => 'ID0001',
                'email' => 'admin@gmail.com',
                'status' => 'Active',
                'role_name' => 'Admin',
                'password' => \Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'user_id' => 'ID0002',
                'email' => 'test@example.com',
                'status' => 'Active',
                'role_name' => 'User',
                'password' => \Hash::make('password123'),
            ]
        );
    }
}
}
