<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mcq_Answer>
 */
class Mcq_AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_id'=>fake()->numberBetween(0,25),
            'mcq_ans_id'=>fake()->numberBetween(0,5),
            'description'=>fake()->word(),
            'reference'=>fake()->randomNumber(),

        ];
    }
}
