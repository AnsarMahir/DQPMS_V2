<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FAQ;
use App\Models\User;
use App\Models\Pastpaper;
use App\Models\Reference;
use App\Models\Sh_Answer;
use App\Models\Mcq_Answer;
use App\Models\McqAttempt;
use App\Models\Sh_Question;
use App\Models\Mcq_Question;
use App\Models\UpcomingExam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        FAQ::factory(5)->create();
        UpcomingExam::factory(5)->create();
        Pastpaper::factory(10)->create();
        Reference::factory(5)->create();
        Mcq_Question::factory(20)->create();
        Mcq_Answer::factory(20)->create();
        Sh_Question::factory(22)->create();
        //Sh_Answer::factory(20)->create();

        //Factory to populate many to many MCQ Attempt
        foreach (User::all() as $user) {
            $mcq_questions = Mcq_Question::all();

            foreach ($mcq_questions as $item) {
                $user->mcqAttempt()->attach(
                    $item,
                    [
                        'no_of_attempts' => rand(0, 10)
                    ]
                );
            }
        }

        foreach (User::all() as $user) {
            $sh_questions = Sh_Question::all();

            foreach ($sh_questions as $item) {
                $user->shAttempt()->attach(
                    $item,
                    [
                        'no_of_attempts' => rand(0, 10)
                    ]
                );
            }
        }





        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
