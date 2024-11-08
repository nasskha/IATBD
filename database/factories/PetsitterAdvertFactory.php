<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetsitterAdvert>
 */
class PetsitterAdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 5),
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'city' => fake()->city(),
            'advert_active' => fake()->boolean(),
        ];
    }
}
