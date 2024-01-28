<?php

namespace Database\Factories;
use App\Models\Pastpaper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pastpaper>
 */
class PastpaperFactory extends Factory
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
        $language = ['English','Sinhala','Tamil'];
        $creatorId = DB::table('users')->pluck('id');
        $moderatorId = DB::table('users')->pluck('id');
        

        return [
            'name'=>fake()->name(),
            'year'=>fake()->year(),
            'language'=>fake()->randomElement($language),
            'CreatorState'=>fake()->randomElement($creatorState),
            'ModeratorState'=>fake()->randomElement($moderatorState),
            'CreatorID' => fake() ->randomElement($creatorId),
            'ModeratorID' => fake() ->randomElement($moderatorId)
        ];

        
    }
}