<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $qtype=['MCQ','ShortAnswer'];
        $qnature=['IQ','GK','MATH','OTHER'];
        return [
            'description'=>fake()->paragraph(),
            'type'=>fake()->randomElement($qtype),
            'nature'=>fake()->randomElement($qnature),
            'referenceid'=>fake()->numberBetween(0,5),
            'correct_answer'=>fake()->numberBetween(0,5),
        ];
    }
}
