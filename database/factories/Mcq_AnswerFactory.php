<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
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
        $q_id = DB::table('mcq_questions')->pluck('mcq_questions_id');
        $reference = DB::table('reference')->pluck('R_id');
        
        return [
            'question_id'=>fake()->unique()->randomElement($q_id),  
            'mcq_ans_id'=>fake()->numberBetween(1,4),
            'description'=>fake()->word(),
            'reference'=>fake()->randomElement($reference),

        ];
    }
}
