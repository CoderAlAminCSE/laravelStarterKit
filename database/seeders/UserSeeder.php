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
        $admin = User::create([
            "name" => "Admin",
            "email" => "admin@mail.com",
            "address" => "Mohakhali, Dhaka",
            "password" => '$2y$10$2dXuJopzVDaHsxTTVl.CZexCjLpOG.Im5ncG8XV53ZAQoKlif69iS',
            "email_verified_at" => "2024-01-26 15:27:59",
        ]);
        $admin->syncRoles('admin');

        $customer =  User::create([
            "name" => "Customer",
            "email" => "customer@mail.com",
            "address" => "Mirpur, Dhaka",
            "password" => '$2y$10$2dXuJopzVDaHsxTTVl.CZexCjLpOG.Im5ncG8XV53ZAQoKlif69iS',
            "email_verified_at" => "2024-01-26 15:27:59",
        ]);
        $customer->syncRoles('customer');
    }
}
