<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Mcq_Answer;
use App\Models\Mcq_Question;
use App\Models\Pastpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Mcq_Attempt;
use Illuminate\Support\Collection\paginate;

class QuestionController extends Controller

{
    public function fetchQuestions(Request $request)
    {
        $selectedValues = $request->input('selectedValues');
        $examlang = $selectedValues['lang'];
        $examname = $selectedValues['examname'];
        $userId = $selectedValues['user_id'];
        $questionType = $selectedValues['questiontype'];
        $questionNature = $selectedValues['qnature'];
        $numberOfQuestions = $selectedValues['noofq'];



        if ($questionType === 'MCQ') {
            $getpids = $this->getpid($examname, $examlang);
            $mcqid = $this->getmcqid($getpids, $questionNature);
            $finalid = $this->mcqidattempt($mcqid, $userId, $numberOfQuestions);

            $questions = Mcq_Question::whereIn('mcq_questions_id', $finalid)
                ->paginate(1)->withQueryString();


            $answers = DB::table('mcq_answers')
                ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
                ->select("mcq_answers.description")
                ->whereIn('mcq_answers.question_id', $finalid)
                ->paginate(4, ['description']);
        }
        //return $questions; // Return selected questions

        return view('Question', compact('questions', 'answers', 'selectedValues'));
    }

    public function fetch(Request $request)
    {
        $selectedValues = $request->input('selectedValues');
        $examlang = $selectedValues['lang'];
        $examname = $selectedValues['examname'];
        $userId = $selectedValues['user_id'];
        $questionType = $selectedValues['questiontype'];
        $questionNature = $selectedValues['qnature'];
        $numberOfQuestions = $selectedValues['noofq'];



        if ($questionType === 'MCQ') {
            $getpids = $this->getpid($examname, $examlang);
            $mcqid = $this->getmcqid($getpids, $questionNature);
            $finalid = $this->mcqidattempt($mcqid, $userId, $numberOfQuestions);

            $questions = Mcq_Question::whereIn('mcq_questions_id', $finalid)
                ->get();


            $answers = DB::table('mcq_answers')
                ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
                ->select("mcq_answers.description")
                ->whereIn('mcq_answers.question_id', $finalid)
                ->get();

            // dd($answers);



        }


        return view('Question', compact('questions', 'answers', 'selectedValues', 'finalid'));
    }
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

        return view('Review', compact('questions', 'answers', 'useranswers'));
    }

    public function getpid($n, $n1)
    {
        $pid = Pastpaper::where('name', $n)
            ->where('language', $n1)
            ->pluck('P_id')
            ->toArray();

        return $pid;
    }

    public function getmcqid($n, $n1)
    {
        $mcqid = Mcq_Question::whereIn('pastpaper_reference', $n)
            ->where('nature', $n1)
            ->pluck('mcq_questions_id')
            ->toArray();

        return $mcqid;
    }

    public function mcqidattempt($n, $n1, $n2)
    {
        $attemptmcqid = Mcq_Attempt::whereIn('mcq_questions_id', $n)
            ->where('user_id', $n1)
            ->orderBy('no_of_attempts', 'asc')
            ->take($n2)
            ->pluck('mcq_questions_id')
            ->toArray();

        return $attemptmcqid;
    }
    public function showit(Request $request): View
    {

        //$questions = Mcq_Question::take(10)->pluck('description');
        $questions = Mcq_Question::paginate(1, '*', 'page');

        $questionId = $questions->first()->mcq_questions_id;

        $answers = DB::table('mcq_answers')
            ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
            ->select("mcq_answers.description")
            ->where('mcq_answers.question_id', $questionId)
            ->get();

        $selectedValues = $request->input('selectedValues');

        //  dd($answers);

        return view('Question', compact('questions', 'answers', 'selectedValues'));
    }
}
