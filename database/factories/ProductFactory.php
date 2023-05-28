<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            "price" => $this->faker->numberBetween(1, 100),
            "description" => $this->faker->text(2000),
            "brand_id" => \App\Models\Brand::orderByRaw("RAND()")->first()->id,
            "user_id" => \App\Models\User::orderByRaw("RAND()")->first()->id,
        ];
    }
}
