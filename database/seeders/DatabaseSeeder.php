<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        // Room::factory(4)->create();
        // Event::factory(6)->create();


        Event::create([
            'id' => 1,
            'title' => 'Patisserie Française',
            'description' => 'Lorem Ipsum blablablablablablbalblablandniknkdennjn knznd jdneznd nceznjc',
            'created_at' => 2023 - 04 - 03,
            'updated_at' => 2023 - 04 - 03,
            'room_id' => 1,
            'user_id' => 10,
        ]);

        Event::create([
            'id' => 2,
            'title' => 'Patisserie Française',
            'description' => 'Lorem Ipsum blablablablablablbalblablandniknkdennjn knznd jdneznd nceznjc',
            'created_at' => 2023 - 04 - 03,
            'updated_at' => 2023 - 04 - 03,
            'room_id' => 4,
            'user_id' => 3,
        ]);

        Event::create([
            'id' => 3,
            'title' => 'Patisserie Française',
            'description' => 'Lorem Ipsum blablablablablablbalblablandniknkdennjn knznd jdneznd nceznjc',
            'created_at' => 2023 - 04 - 03,
            'updated_at' => 2023 - 04 - 03,
            'room_id' => 2,
            'user_id' => 11,
        ]);

        Equipment::create([
            'id' => 1,
            'title' => 'Four',
            'brand' => 'Bosch',
            'description' => 'Lorem Ipsum blablablablablablbalblablandniknkdennjn knznd jdneznd nceznjc',
        ]);

        Equipment::create([
            'id' => 2,
            'title' => 'Four',
            'brand' => 'Bosch',
            'description' => 'Lorem Ipsum blablablablablablbalblablandniknkdennjn knznd jdneznd nceznjc',
        ]);

        Room::create([
            'id' => 1,
            'name' => 'Salle 1',
            'address' => 'Diderot, Paris',
            'image' => 'https://images.unsplash.com/photo-1611095772769-5b7b3e9b0b0b?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cGF0aXNzZXJ8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80',
        ]);

        Room::create([
            'id' => 2,
            'name' => 'Salle 2',
            'address' => 'Diderot, Paris',
            'image' => 'https://images.unsplash.com/photo-1611095772769-5b7b3e9b0b0b?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cGF0aXNzZXJ8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80',
        ]);

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
