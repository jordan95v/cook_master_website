<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Courses::factory(30)->create();
    }
}
