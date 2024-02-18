<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Mcq_Answer;
use App\Models\Mcq_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection\paginate;

class QuestionController extends Controller
{
    public function showit():View
    {

        //$questions = Mcq_Question::take(10)->pluck('description');
        $questions = Mcq_Question::paginate(1, '*', 'page');

        $questionId = $questions->first()->mcq_questions_id;

        $answers = DB::table('mcq_answers')
        ->join('mcq_questions','question_id','=','mcq_questions_id')
        ->select("mcq_answers.description")
        ->where('mcq_answers.question_id', $questionId)
        ->get();

        //  dd($answers);

        return view('Question', compact('questions','answers'));
        
    }
}
