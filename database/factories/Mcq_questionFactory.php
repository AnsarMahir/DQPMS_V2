<?php

namespace Database\Factories;

use App\Models\Mcq_Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mcq_Question>
 */
class Mcq_QuestionFactory extends Factory
{
    protected $model= Mcq_Question::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $qnature=['IQ','GK','MATH','OTHER'];
        $reference = DB::table('reference')->pluck('R_id');
        $pp_reference = DB::table('pastpaper')->pluck('P_id');

        return [
            'description'=>fake()->paragraph(),
            'nature'=>fake()->randomElement($qnature),
            'referenceid'=>fake()->randomElement($reference),
            'correct_answer'=>fake()->numberBetween(1,4),
            'pastpaper_reference'=>fake()->randomElement($pp_reference)
        ];
    }
}
