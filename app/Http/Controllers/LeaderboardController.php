<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Fetch all moderators
        $moderators = User::whereHas('moderatedPapers', function ($query) {
            $query->where('ModeratorState', 'Published');
        })->get();

        // Calculate the total number of moderated questions for each moderator
        $moderators = $moderators->map(function ($moderator) {
            $mcqCount = 0;
            $shCount = 0;

            foreach ($moderator->moderatedPapers as $paper) {
                if ($paper->ModeratorState === 'Published') {
                    if ($paper->question_type === 'MCQ') {
                        $mcqCount += $paper->mcqQuestions()->count();
                    } elseif ($paper->question_type === 'Short Answer') {
                        $shCount += $paper->shQuestions()->count();
                    }
                }
            }

            $moderator->mcq_count = $mcqCount;
            $moderator->sh_count = $shCount;
            $moderator->total_count = $mcqCount + $shCount;

            return $moderator;
        });

        // Sort moderators by total_count in descending order
        $moderators = $moderators->sortByDesc('total_count');

        return view('moderator.leaderboard.index', compact('moderators'));
    }
}
