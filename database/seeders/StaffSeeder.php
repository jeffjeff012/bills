<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            "name" => "Staff User",
            "email" => "staff@gmail.com",
            "role" => UserRole::SbStaff,
            "password" =>Hash::make("password")
        ]);
    }
}
