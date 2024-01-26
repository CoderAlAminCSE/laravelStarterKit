<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "admin",
            "email" => "admin@mail.com",
            "address" => "Mohakhali, Dhaka",
            "role" => "admin",
            "password" => '$2y$10$2dXuJopzVDaHsxTTVl.CZexCjLpOG.Im5ncG8XV53ZAQoKlif69iS',
            "email_verified_at" => "2024-01-26 15:27:59",
        ]);

        User::create([
            "name" => "User",
            "email" => "user@mail.com",
            "address" => "Mirpur, Dhaka",
            "role" => "user",
            "password" => '$2y$10$2dXuJopzVDaHsxTTVl.CZexCjLpOG.Im5ncG8XV53ZAQoKlif69iS',
            "email_verified_at" => "2024-01-26 15:27:59",
        ]);
    }
}
