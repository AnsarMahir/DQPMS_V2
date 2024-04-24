<?php

namespace App\Http\Controllers;
use Closure;
use App\Models\User;
use App\Models\Pastpaper;
use App\Models\Reference;
use Illuminate\View\View;
use App\Models\Mcq_Answer;
use App\Models\Mcq_Attempt;
use App\Models\Mcq_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection\paginate;

class QuestionController extends Controller

{
    // public function fetchQuestions(Request $request)
    // {
    //     //This is the function that created in the beginning of the project which
    //     //shows question with pagination, but due to lack of knowledge in ajax, I had
    //     //to move on to the below one ('fetch'). This one is not in use now
    //     $selectedValues = $request->input('selectedValues');
    //     $examlang = $selectedValues['lang'];
    //     $examname = $selectedValues['examname'];
    //     $userId = $selectedValues['user_id'];
    //     $questionType = $selectedValues['questiontype'];
    //     $questionNature = $selectedValues['qnature'];
    //     $numberOfQuestions = $selectedValues['noofq'];



    //     if ($questionType === 'MCQ') {
    //         $getpids = $this->getpid($examname, $examlang);
    //         $mcqid = $this->getmcqid($getpids, $questionNature);
    //         //$finalid = $this->mcqidattempt($mcqid, $userId, $numberOfQuestions);

    //        // $questions = Mcq_Question::whereIn('mcq_questions_id', $finalid)
    //           //  ->paginate(1)->withQueryString();


    //         $answers = DB::table('mcq_answers')
    //             ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
    //             ->select("mcq_answers.description")
    //           //  ->whereIn('mcq_answers.question_id', $finalid)
    //             ->paginate(4, ['description']);
    //     }
    //     //return $questions; 

    //     return view('Question', compact('questions', 'answers', 'selectedValues'));
    // }

    public function fetch(Request $request)
{   
    if ($request)
    if ($request->session()->has('review_completed')) {
        $request->session()->forget('review_completed');
        return redirect('/dashboard');
    }
    else{
    
        $selectedValues = $request->input('selectedValues');
        $examlang = $selectedValues['language'];
        $examname = $selectedValues['exam'];
        $userId = $selectedValues['user_id'];
        $questionType = $selectedValues['questiontype'];
        $questionNature = $selectedValues['qnature'];
        $numberOfQuestions = $selectedValues['noofq'];

        if ($questionType === 'MCQ') {
            $time=1;
            if ($questionNature=='GK'){
                $time=1*$numberOfQuestions;
            }
            elseif($questionNature=='IQ'){
                $time=1.5*$numberOfQuestions;
            }
            elseif($questionNature=='MATH'){
                $time=2.5*$numberOfQuestions;
            }
            else{
                $time=1.2*$numberOfQuestions;
            }
            //getpid function gets the pastpaper id's which match the 
            //user selected pastpaper name and language
            $getpids = $this->getpid($examname, $examlang); 
            if ($questionNature==='All'){
                $mcqid = $this->allmcqid($getpids);
            }else{
                $mcqid = $this->getmcqid($getpids, $questionNature);
            }
            $num=$this->hamaslogic($mcqid, $userId);

            $finalid = $this->mcqidattempt($mcqid, $userId, $numberOfQuestions,$num);
            
            $questions = Mcq_Question::whereIn('mcq_questions_id', $finalid)
            ->get();

            $qreferenceid=  Mcq_Question::whereIn('mcq_questions_id', $finalid)
            ->get('referenceid');

            $qreference= Reference::whereIn('R_id',$qreferenceid)
            ->get()->toArray();

            $referenceArray = [];
            $answers = DB::table('mcq_answers')
                ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
                ->select("mcq_answers.description","reference")
                ->whereIn('mcq_answers.question_id', $finalid)
                ->get();

                foreach ($answers as $answer) {
                    $reference = $answer->reference;
                    $referenceArray[] = $reference;
                }

                $areference= Reference::whereIn('R_id',$referenceArray)
                ->get()->toArray();

                // Attempt increasing code (Refreshing must be disabled)
                Mcq_Attempt::whereIn('mcq_questions_id',$finalid)
                ->where('user_id',$userId)
                ->increment('no_of_attempts');

                return view('Question', compact('questions', 'answers', 'selectedValues', 'finalid','time','qreference','areference'));
        }else{
            
        }

        
    }
}
    

    public function getpid($n, $n1)
    {
        //selecting the pastpapers that matches the name and language
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

    public function allmcqid($n)
    {
        $mcqid = Mcq_Question::whereIn('pastpaper_reference', $n)
            ->pluck('mcq_questions_id')
            ->toArray();

        return $mcqid;
    }

    public function hamaslogic($n, $n1)
    {
        $attempt = Mcq_Attempt::whereIn('mcq_questions_id', $n)
            ->where('user_id', $n1)
            ->sum('no_of_attempts');

        return $attempt;
    }

    public function mcqidattempt($n, $n1, $n2,$n3)
    {
        if ($n3==0){
            $attemptmcqid = Mcq_Attempt::whereIn('mcq_questions_id', $n)
            ->where('user_id', $n1)
            ->orderBy('no_of_attempts', 'asc')
            ->inRandomOrder()
            ->take($n2)
            ->pluck('mcq_questions_id')
            ->toArray();
        }
        else{
            $attemptmcqid = Mcq_Attempt::whereIn('mcq_questions_id', $n)
            ->where('user_id', $n1)
            ->orderBy('no_of_attempts', 'asc')
            ->take($n2)
            ->pluck('mcq_questions_id')
            ->toArray();

        }
        

        return $attemptmcqid;
    }
    public function showit(Request $request): View
    {
        dd($request);

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

    public function getCorrectAnswer(Request $request)
    {
        // Get the JSON data from the request
        $requestData = $request->json()->all();

        // Make the request to the GPT-3 API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.gpt3.api_key'),
        ])->post(config('services.gpt3.endpoint').'/v1/completions', $requestData);

        $correctAnswer = $response->json()['choices'][0]['text'] ?? 'No answer available';

        return response()->json(['answer' => $correctAnswer]);
    }
}
