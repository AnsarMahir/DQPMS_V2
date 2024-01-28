<?php

namespace Database\Factories;
use App\Models\Pastpaper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pastpaper>
 */
class PastpaperfactoryFactory extends Factory
{
    protected $model= Pastpaper::class;
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
