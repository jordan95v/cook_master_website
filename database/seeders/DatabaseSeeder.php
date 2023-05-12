<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Super admin
        User::create([
            'name' => 'ouss95v',
            'email' => 'ouss@gmail.com',
            'role' => 2,
            "email_verified_at" => "2021-03-25 00:00:00",
            'password' => bcrypt('Test1234'),
        ]);

        // Admin
        User::create([
            'name' => 'jordan95v',
            'email' => 'jordan@gmail.com',
            'role' => 1,
            "email_verified_at" => "2021-03-25 00:00:00",
            'password' => bcrypt('Test1234'),
        ]);

        // Basic user
        User::create([
            'name' => 'quentin95v',
            'email' => 'quentin@gmail.com',
            'role' => 0,
            "email_verified_at" => "2021-03-25 00:00:00",
            'password' => bcrypt('Test1234'),
        ]);

        // $this->call(BrandSeeder::class);
        // $this->call(ProductSeeder::class);
    }
}
