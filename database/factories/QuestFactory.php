<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quest>
 */
class QuestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quest' => fake()->sentence(), 
            'point' => fake()->numberBetween(5, 50),
        ];
    }
}
