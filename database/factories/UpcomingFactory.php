<?php

namespace Database\Factories;

use App\Models\UpcomingExam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UpcomingExam>
 */
class UpcomingFactory extends Factory
{
    protected $model = UpcomingExam::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'examination_name' => fake()->word(),
            'closing_date' => fake()->date(),
            'exame_date' => fake()->date(),
        ];
    }
}
