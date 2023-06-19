<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormationUser>
 */
class FormationUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::all()->random()->id,
            "formation_id" => Formation::all()->random()->id,
            "is_finished" => $this->faker->boolean,
        ];
    }
}
