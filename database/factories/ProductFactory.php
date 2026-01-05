<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 1, 1000),
            'image' => 'default-product.jpg',
            'category' => fake()->randomElement(['Electronics', 'Books', 'Clothing', 'Home', 'Sports']),
            'stock' => fake()->numberBetween(0, 500),
        ];
    }
}