<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mcq_Question;
use App\Models\Sh_Question;
use App\Models\Pastpaper;
use Illuminate\Support\Facades\DB;



class ChartController extends Controller
{


    public function getModeratorData()
    {
        $moderatorId = Auth::id(); // Get the logged-in moderator ID

        // Get count of MCQ questions moderated by the logged-in moderator
        $mcqCount = Mcq_Question::join('pastpaper', 'mcq_questions.pastpaper_reference', '=', 'pastpaper.P_id')
            ->where('pastpaper.ModeratorID', $moderatorId)
            ->where('pastpaper.ModeratorState', 'Published')
            ->where('pastpaper.CreatorState', 'Approved')
            ->count();

        // Get count of short answer questions moderated by the logged-in moderator
        $shCount = Sh_Question::join('pastpaper', 'sh_questions.pastpaper_reference', '=', 'pastpaper.P_id')
            ->where('pastpaper.ModeratorID', $moderatorId)
            ->where('pastpaper.ModeratorState', 'Published')
            ->where('pastpaper.CreatorState', 'Approved')
            ->count();

            // Get distribution of MCQ question types



        return response()->json([
            'mcq' => $mcqCount,
            'short_answer' => $shCount

        ]);
    }


}




