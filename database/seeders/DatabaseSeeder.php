<?php

namespace Database\Seeders;

use App\Models\Role;
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
        // User::factory(10)->create();
        Role::factory()->create([
            "role_name" => "admin",
        ]);
        Role::factory()->create([
            "role_name" => "student",
        ]);
        Role::factory()->create([
            "role_name" => "school",
        ]);
        User::factory()->create([
            'name' => 'Сергей',
            'lastname' => "Прокопчук",
            'email' => 'admin@example.com',
            "phone" => "89001257339",
            "role_id" => 1,
            "password" => "admin12345"
        ]);
    }
}
