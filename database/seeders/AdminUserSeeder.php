<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::rCreate([
                'name' => 'Admin User',
                'email' => 'jeffcayabyab168@gmail.com',
                "role" => UserRole::Admin,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
