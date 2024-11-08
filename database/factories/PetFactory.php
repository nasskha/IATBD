<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => fake()->randomElement(['dog', 'cat', 'fish', 'bird', 'hamster', 'insect', 'reptile', 'other']),
            'age' => fake()->numberBetween(0, 20),
            'user_id' => fake()->numberBetween(1, 5),
            'breed' => fake()->jobTitle(),
            'hourly_rate' => fake()->numberBetween(1, 20),
            'description' => fake()->sentence(),
            'city' => fake()->city(),
            'picture' => 'pets/wF68opdiDfRWC4iWj2aCSYpx5j45p58VgdXi91Gx.jpg',
            'advert_active' => fake()->boolean(),
        ];
    }
}
