<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make('admin123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@bacsay.gov.ph'],
            [
                'name' => 'Staff User',
                'user_id' => 'ID0002',
                'email' => 'staff@bacsay.gov.ph',
                'status' => 'Active',
                'role_name' => 'Staff',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}

