<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mcq_Question;
use App\Models\Sh_Question;
use Illuminate\Support\Facades\DB;

class PieChartController extends Controller
{
    // Method to display the MCQ Chart view
    public function mcqChart()
    {
        return view('moderator.mcq_chart');
    }

    // Method to display the Short Answer Chart view
    public function shortAnswerChart()
    {
        return view('moderator.short_answer_chart');
    }

    // Method to fetch and process MCQ data for the chart
    public function getModeratorMcqData()
    {
        $moderatorId = Auth::id();

        // Fetch MCQ data
        $mcqData = Mcq_Question::join('pastpaper', 'mcq_questions.pastpaper_reference', '=', 'pastpaper.P_id')
            ->where('pastpaper.ModeratorID', $moderatorId)
            ->where('pastpaper.ModeratorState', 'Published')
            ->where('pastpaper.CreatorState', 'Approved')
            ->select('nature', DB::raw('count(*) as count'))
            ->groupBy('nature')
            ->get();

        // Define all possible categories
        $allCategories = ['IQ', 'Math', 'Politics', 'Economics', 'Demographic', 'Other'];

        // Convert the data to an associative array
        $mcqData = $mcqData->pluck('count', 'nature')->toArray();

        // Ensure all categories are included
        foreach ($allCategories as $category) {
            if (!array_key_exists($category, $mcqData)) {
                $mcqData[$category] = 0;
            }
        }

        // Convert back to array of objects
        $mcqData = collect($mcqData)->map(function ($count, $nature) {
            return ['nature' => $nature, 'count' => $count];
        })->values();

        return response()->json($mcqData);
    }

    // Method to fetch and process Short Answer data for the chart
    public function getModeratorShData()
    {
        $moderatorId = Auth::id();

        // Fetch Short Answer data
        $shData = Sh_Question::join('pastpaper', 'sh_questions.pastpaper_reference', '=', 'pastpaper.P_id')
            ->where('pastpaper.ModeratorID', $moderatorId)
            ->where('pastpaper.ModeratorState', 'Published')
            ->where('pastpaper.CreatorState', 'Approved')
            ->select('nature', DB::raw('count(*) as count'))
            ->groupBy('nature')
            ->get();

        // Define all possible categories
        $allCategories = ['IQ', 'Math', 'Politics', 'Economics', 'Demographic', 'Other'];

        // Convert the data to an associative array
        $shData = $shData->pluck('count', 'nature')->toArray();

        // Ensure all categories are included
        foreach ($allCategories as $category) {
            if (!array_key_exists($category, $shData)) {
                $shData[$category] = 0;
            }
        }

        // Convert back to array of objects
        $shData = collect($shData)->map(function ($count, $nature) {
            return ['nature' => $nature, 'count' => $count];
        })->values();

        return response()->json($shData);
    }

    // Method to display the main dashboard view
    public function dashboard()
    {
        return view('moderator.dashboard');
    }
}
