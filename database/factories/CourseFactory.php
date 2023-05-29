<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "image" => $this->faker->image("public/storage/", 1280, 720, null, false),
            "duration" => $this->faker->numberBetween(1, 100),
            "difficulty" => $this->faker->numberBetween(1, 5),
            "content" => $this->faker->text(),
            "user_id" => \App\Models\User::orderByRaw("RAND()")->first()->id,
        ];
    }
}
