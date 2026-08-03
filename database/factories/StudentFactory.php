<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "phone" => fake()->phoneNumber(),
            "email" => fake()->email(),
            "photo" => fake()->imageUrl(640, 480, 'student', true),
            "batch" => fake()->randomElement([
                "2020",
                "2021",
                "2022",
                "2023",
                "2024",
                "2025",
            ]),
            "status" => fake()->boolean(),
            "created_at"=> fake()->dateTime(),
            "updated_at"=> fake()->dateTime()
        ];
    }
}
