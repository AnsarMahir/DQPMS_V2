<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mcq_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function reviewque(Request $request)
    {
        $request->flash();
        
        $useranswers = request('answers');

        $finalids = request('finalids');
        $questions = Mcq_Question::whereIn('mcq_questions_id', $finalids)
            ->get();

        $answers = DB::table('mcq_answers')
            ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
            ->select("mcq_answers.description")
            ->whereIn('mcq_answers.question_id', $finalids)
            ->get();


            

        //return $questions; // Return selected questions
        $request->session()->put('review_completed', true);
        return view('Review', compact('questions', 'answers', 'useranswers'));
    }

    
}
