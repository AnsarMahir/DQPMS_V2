<?php

namespace Database\Factories;

use App\Models\CreatorRank;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreatorRank>
 */
class CreatorRankFactory extends Factory
{
    protected $model= CreatorRank::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $creatorId = DB::table('users')->where('type','CREATOR')->pluck('id');
        

        
        return [
            'creator_id' => fake() ->randomElement($creatorId),
            'rank'=> fake()-> numberBetween(1,3),
            'no_of_questions'=> fake()->numberBetween(0,50)
            
        ];
    }
}
