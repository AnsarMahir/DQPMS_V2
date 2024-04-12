<?php

namespace Database\Factories;

use App\Models\Sh_Answer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sh_Answer>
 */
// class Sh_AnswerFactory extends Factory
// {
//     protected $model= Sh_Answer::class;
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         $q_id = DB::table('mcq_questions')->pluck('mcq_questions_id');
//         $reference = DB::table('reference')->pluck('R_id');
        
//         return [
//             'question_id'=>fake()->unique()->numberBetween(1,20),
//             'sh_ans_id'=>fake()->numberBetween(1,4),
//             'description'=>fake()->word(),
//             'reference'=>fake()->randomElement($reference),
            
//         ];
//     }
// }
