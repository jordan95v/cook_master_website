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
            "name" => $this->faker->name(),
            "slug" => $this->faker->slug(),
            "image" => $this->faker->image("public/storage/", 1280, 720, null, false),
            "website" => $this->faker->url(),
            "contact_email" => $this->faker->email(),
            "description" => $this->faker->text(2000),
            "user_id" => \App\Models\User::orderByRaw("RAND()")->first()->id,
        ];
    }
}
