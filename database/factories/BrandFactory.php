<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->company(),
            "slug" => fake()->slug(3),
            "description" => fake()->paragraph(5),
            "website" => fake()->url(),
            "contact_email" => fake()->companyEmail(),
        ];
    }
}
