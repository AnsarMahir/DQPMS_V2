<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sh_Answer>
 */
class Sh_AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sh_ans_id'=>fake()->numberBetween(0,5),
            'description'=>fake()->words(),
            'reference'=>fake()->randomNumber(),
            
        ];
    }
}
