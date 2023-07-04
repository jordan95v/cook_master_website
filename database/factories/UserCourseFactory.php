<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCourse>
 */
class UserCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "course_id" => Course::all()->random()->id,
            "user_id" => User::all()->random()->id,
            "is_finished" => $this->faker->boolean,
            "created_at" => $this->faker->dateTime,
        ];
    }
}
