<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        Event::factory(6)->create();

        // Event::create([
        //     'id' => 1,
        //     'title' => 'Patisserie Française',
        //     'Author' => 'Quentin',
        //     'location' => 'Nation, Paris',
        //     'description' => 'Lorem Ipsum blablablablablablbalblablandniknkdennjn knznd jdneznd nceznjc',
        //     // 'created_at' => 2023 - 04 - 03,
        //     // 'updated_at' => 2023 - 04 - 03,
        // ]);

        // Event::create([
        //     'id' => 2,
        //     'title' => 'Plats Cuisinés',
        //     'Author' => 'Quentin',
        //     'location' => 'Diderot, Paris',
        //     'description' => 'Lorem Ipsum blablablablablablbalblablandniknkdennjn knznd jdneznd nceznjc',
        //     // 'created_at' => 2023 - 04 - 03,
        //     // 'updated_at' => 2023 - 04 - 03,
        // ]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Super admin
        \App\Models\User::factory()->create([
            'name' => 'ouss95v',
            'email' => 'ouss@gmail.com',
            'role' => 2,
            'password' => bcrypt('Test1234'),
        ]);

        // Admin
        \App\Models\User::factory()->create([
            'name' => 'jordan95v',
            'email' => 'jordan@gmail.com',
            'role' => 1,
            'password' => bcrypt('Test1234'),
        ]);

        // Basic user
        \App\Models\User::factory()->create([
            'name' => 'quentin95v',
            'email' => 'quentin@gmail.com',
            'role' => 0,
            'password' => bcrypt('Test1234'),
        ]);
    }
}
