<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
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
            "image" => $this->faker->image("public/storage/", 1280, 720, null, false),
            "brand_id" => \App\Models\Brand::all()->random()->id,
            "user_id" => \App\Models\User::all()->random()->id,
            "is_available" => $this->faker->boolean(),
        ];
    }
}
