<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sh_Question>
 */
class Sh_QuestionFactory extends Factory
{
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
            'correct_answer'=>fake()->numberBetween(0,5),
            'pastpaper_reference'=>fake()->randomElement($pp_reference)
        ];
    }
}
