<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FAQ;
use App\Models\Mcq_Answer;
use App\Models\Mcq_Question;
use App\Models\Pastpaper;
use App\Models\Reference;
use App\Models\Sh_Answer;
use App\Models\Sh_Question;
use App\Models\UpcomingExam;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        FAQ::factory(5)->create();
        UpcomingExam::factory(5)->create();
        Pastpaper::factory(10)->create();
        Mcq_Question::factory(20)->create();
        Mcq_Answer::factory(20)->create();
        Sh_Question::factory(20)->create();
        Sh_Answer::factory(20)->create();
        Reference::factory(5)->create();




        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
