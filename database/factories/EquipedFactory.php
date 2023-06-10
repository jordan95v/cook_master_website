<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equiped>
 */
class EquipedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "room_id" => \App\Models\Room::orderByRaw("RAND()")->first()->id,
            "equipment_id" => \App\Models\Equipment::orderByRaw("RAND()")->first()->id,
        ];
    }
}
