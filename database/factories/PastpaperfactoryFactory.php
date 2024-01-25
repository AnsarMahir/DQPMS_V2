<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pastpaper>
 */
class PastpaperfactoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $creatorState = ['Draft','Submitted','Approved'];
        $moderatorState = ['Draft','Published'];
        return [
            'name'=>fake()->word(),
            'year'=>fake()->year(),
            'language'=>fake()->word(),
            'CreatorState'=>fake()->randomElement($creatorState),
            'ModeratorState'=>fake()->randomElement($moderatorState),
        ];
    }
}
