<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->words(2, true),
            "is_course" => $this->faker->boolean(),
            "description" => $this->faker->text(3000),
            "capacity" => $this->faker->numberBetween(1, 100),
            "image" => $this->faker->image("public/storage/", 1280, 720, null, false),
            "date" => $this->faker->dateTimeBetween("+0 week", "+2 week")->format("Y-m-d"),
            "start_time" => $this->faker->time(),
            "end_time" => $this->faker->time(),
            "room_id" => \App\Models\Room::all()->random()->id,
            "user_id" => \App\Models\User::all()->random()->id,
            "created_by" => \App\Models\User::all()->random()->id,
        ];
    }
}
