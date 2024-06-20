<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Pastpaper;
use App\Models\Reference;
use App\Models\Mcq_Question;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShowFormTest extends TestCase
{
    use RefreshDatabase;

    public function testShowForm()
    {
        // Create a user for CreatorID and ModeratorID references
        $user = User::factory()->create();

        $reference1 = Reference::factory()->create([
            'reference_HTML' => '<p>Reference 1</p>'
        ]);

        $reference2 = Reference::factory()->create([
            'reference_HTML' => '<p>Reference 2</p>'
        ]);

        // Populate Pastpaper with test data
        Pastpaper::factory()->create([
            'name' => 'Exam A',
            'year' => 1993,
            'language' => 'English',
            'no_of_questions' => 6,
            'CreatorState' => 'Draft',
            'ModeratorState' => 'Published',
            'CreatorID' => $user->id,
            'ModeratorID' => $user->id,
        ]);

        Pastpaper::factory()->create([
            'name' => 'Exam B',
            'year' => 1995,
            'language' => 'English',
            'no_of_questions' => 8,
            'CreatorState' => 'Draft',
            'ModeratorState' => 'Published',
            'CreatorID' => $user->id,
            'ModeratorID' => $user->id,
        ]);

        // Populate Mcq_Question with test data
        Mcq_Question::factory()->create([
            'description' => 'Sample MCQ question 1',
            'nature' => 'GK',
            'referenceid' => $reference1->R_id,
            'correct_answer' => 2,
            'pastpaper_reference' => 1,
        ]);

        Mcq_Question::factory()->create([
            'description' => 'Sample MCQ question 2',
            'nature' => 'MATH',
            'referenceid' => $reference2->R_id,
            'correct_answer' => 1,
            'pastpaper_reference' => 1,
        ]);

        // Acting as an authenticated and verified user
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        // Simulate a GET request to the '/Student' route
        $response = $this->actingAs($user)
                         ->get(route('student'));

        // Assert the response status
        $response->assertStatus(200);

        // Assert that the view is returned
        $response->assertViewIs('StudentHomepage');

        $response->assertViewHasAll([
            'examname' => Pastpaper::select('name')->distinct()->pluck('name'),
            'natures' => Mcq_Question::select('nature')->distinct()->pluck('nature'),
            'languages' => Pastpaper::select('language')->distinct()->pluck('language'),
            ]);
    }
}
