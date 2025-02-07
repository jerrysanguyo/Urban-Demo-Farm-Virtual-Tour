<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Hashing\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            "name"=> "Jerry Sanguyo Jr.",
            "email"=> "jsanguyo1624@gmail.com",
            "password"=> bcrypt("admin"),
            "email_verified_at"=> now(),
            "role"=> "superadmin",
            "remember_token"=> null,
        ]);
    }
}
