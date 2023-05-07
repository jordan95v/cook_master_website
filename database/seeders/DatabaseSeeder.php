<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\Room;
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
        // Room::factory(4)->create();
        // Event::factory(6)->create();


        Event::create([
            'id' => 1,
            'title' => 'Atelier de cuisine française',
            'description' => 'Apprenez à préparer des plats français classiques lors de cet atelier de cuisine guidé par un chef expert en cuisine française.',
            'created_at' => '2023-05-01 10:00:00',
            'updated_at' => '2023-05-01 10:00:00',
            'date' => '15/05/2023',
            'start_time' => '10:00',
            'end_time' => '12:00',
            'room_id' => 1,
            'user_id' => 1,
            'image' => 'images/event_image/atelier.jpg'
        ]);

        Event::create([
            'id' => 2,
            'title' => 'Dîner gastronomique',
            'description' => 'Savourez un dîner gastronomique inoubliable préparé par notre chef étoilé dans notre restaurant élégant et raffiné.',
            'created_at' => '2023-05-10 19:00:00',
            'updated_at' => '2023-05-10 19:00:00',
            'date' => '10/05/2023',
            'start_time' => '14:00',
            'end_time' => '16:00',
            'room_id' => 2,
            'user_id' => 2,
            'image' => 'images/event_image/cuisine_gastro.jpeg'
        ]);

        Event::create([
            'id' => 3,
            'title' => 'Cours de pâtisserie pour enfants',
            'description' => 'Initiez vos enfants à l\'art de la pâtisserie lors de ce cours ludique et éducatif animé par notre pâtissier professionnel.',
            'created_at' => '2023-06-05 14:00:00',
            'updated_at' => '2023-06-05 14:00:00',
            'date' => '22/06/2023',
            'start_time' => '11:00',
            'end_time' => '13:00',
            'room_id' => 3,
            'user_id' => 3,
            'image' => 'images/event_image/patisserie.jpeg'
        ]);

        Equipment::create([
            'id' => 1,
            'title' => 'Robot culinaire',
            'brand' => 'KitchenAid',
            'description' => 'Un robot culinaire polyvalent et performant, idéal pour préparer toutes sortes de recettes, du hachage de légumes à la préparation de pâtes à pain.',
            'image' => 'images/equipment_image/robot.jpg'
        ]);

        Equipment::create([
            'id' => 2,
            'title' => 'Plancha',
            'brand' => 'Krampouz',
            'description' => 'Une plancha de qualité professionnelle pour une cuisine saine et savoureuse, permettant de cuire viandes, poissons, légumes et autres aliments à la perfection.',
            'image' => 'images/equipment_image/plancha.jpg'
        ]);

        Equipment::create([
            'id' => 3,
            'title' => 'Machine à expresso',
            'brand' => 'DeLonghi',
            'description' => 'Une machine à expresso haut de gamme, pour des cafés savoureux et riches en arômes, avec une mousse de lait onctueuse et crémeuse.',
            'image' => 'images/equipment_image/expresso.jpg'
        ]);


        Room::create([
            'id' => 1,
            'name' => 'Salle de démonstration',
            'address' => '10 rue de la Paix, Paris',
            'image' => 'images/room_image/salle_demonstration.jpeg',
        ]);

        Room::create([
            'id' => 2,
            'name' => 'Salle de dégustation',
            'address' => '5 rue des Abbesses, Paris',
            'image' => 'images/room_image/salle_degustation.jpg',
        ]);

        Room::create([
            'id' => 3,
            'name' => 'Salle de formation',
            'address' => '20 avenue des Ternes, Paris',
            'image' => 'images/room_image/salle_formation.jpg',
        ]);


        // Super admin
        User::create([
            'name' => 'ouss95v',
            'email' => 'ouss@gmail.com',
            'role' => 2,
            'password' => bcrypt('Test1234'),
        ]);

        // Admin
        User::create([
            'name' => 'jordan95v',
            'email' => 'jordan@gmail.com',
            'role' => 1,
            'password' => bcrypt('Test1234'),
        ]);

        // Basic user
        User::create([
            'name' => 'quentin95v',
            'email' => 'quentin@gmail.com',
            'role' => 0,
            'password' => bcrypt('Test1234'),
        ]);

        Equiped::create([
            'id' => 1,
            'room_id' => 1,
            'equipment_id' => 1,
        ]);

        Equiped::create([
            'id' => 2,
            'room_id' => 1,
            'equipment_id' => 2,
        ]);

        Equiped::create([
            'id' => 3,
            'room_id' => 2,
            'equipment_id' => 3,
        ]);

        Equiped::create([
            'id' => 4,
            'room_id' => 2,
            'equipment_id' => 2,
        ]);

        Equiped::create([
            'id' => 5,
            'room_id' => 3,
            'equipment_id' => 1,
        ]);
    }
}
