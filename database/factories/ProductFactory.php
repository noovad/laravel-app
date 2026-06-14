<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
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
        $name = fake()->words(
            3,
            true
        );

        return [
            'name' => $name,
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(
                10000,
                1000000
            ),
            'stock' => fake()->numberBetween(
                0,
                100
            ),
            'is_active' => true,
            'image' => null,
        ];
    }
}
