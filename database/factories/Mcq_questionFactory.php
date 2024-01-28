<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mcq_Question>
 */
class Mcq_questionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $qnature=['IQ','GK','MATH','OTHER'];
        return [
            'description'=>fake()->paragraph(),
            'nature'=>fake()->randomElement($qnature),
            'referenceid'=>fake()->randomNumber(),
            'correct_answer'=>fake()->numberBetween(0,5),
            'pastpaper_reference'=>fake()->randomDigitNotZero()
        ];
    }
}
