<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
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
            "name" => fake()->randomElement([
                'Apple iPhone 16 Pro',
                'Samsung Galaxy S25',
                'Dell Inspiron 15',
                'HP Pavilion Laptop',
                'Sony WH-1000XM5',
                'Logitech MX Master 3S',
                'Asus ROG Strix',
                'Canon EOS R50',
                'Xiaomi Redmi Note 15',
                'Apple Watch Series 11',
            ]),
            "price" => fake()->numberBetween(20000, 150000),
            "qty" => fake()->numberBetween(10, 50),
            "photo" => fake()->imageUrl(640, 480, 'technics', true),
            "description" => fake()->paragraph(),
            "status" => fake()->boolean(),
            "created_at"=> fake()->dateTime(),
            "updated_at"=> fake()->dateTime()
        ];
    }
}
