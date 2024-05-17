<?php

namespace App\Http\Controllers;
use Closure;
use App\Models\User;
use App\Models\Pastpaper;
use App\Models\Reference;
use App\Models\Sh_Answer;
use Illuminate\View\View;
use App\Models\Mcq_Answer;
use App\Models\Sh_Attempt;
use App\Models\Mcq_Attempt;
use App\Models\Sh_Question;
use App\Models\Mcq_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;
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
    
    // if ($request->session()->has('review_completed')) {
    //     $request->session()->forget('review_completed');
    //     return redirect('/dashboard');
    // }
    // else{
    
        $selectedValues = $request->input('selectedValues');
        $examlang = $selectedValues['language'];
        $examname = $selectedValues['exam'];
        $userId = $selectedValues['user_id'];
        $questionType = $selectedValues['questiontype'];
        $questionNature = $selectedValues['qnature'];
        $numberOfQuestions = $selectedValues['noofq'];

        //getpid function gets the pastpaper id's which match the 
        //user selected pastpaper name and language
        try{
            $getpids = $this->getpid($examname, $examlang);
            
        }catch(QueryException $e){
            return response()->json(['error' => 'Database error occurred'], 500);
        }
        
        //Creating time based logic if user request a specific category of question
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
            elseif($questionNature=='OTHER'){
                $time=2.5*$numberOfQuestions;
            }


        if ($questionType === 'MCQ') {
            //getting the mcq questions in accordance with category or anytype of question
            if ($questionNature==='All'){
                $mcqid = $this->allmcqid($getpids);
            }else{
                $mcqid = $this->getmcqid($getpids, $questionNature);
            }

            //function to check if the user is new or not using the attempt count
            $numberofattempt=$this->isnewuser($mcqid, $userId,$questionType);

            //function to get the least attempted question ID's or randomized(if new user)
            $finalizedmcqid = $this->mcqidattempt($mcqid, $userId, $numberOfQuestions,$numberofattempt);
            
            //taking the mcq question as objects
            $questions = Mcq_Question::whereIn('mcq_questions_id', $finalizedmcqid)
            ->get();

            $questionsCount = $questions->count();

            // if ($questionsCount < $numberOfQuestions){
            //     return redirect()->route('student')->with('message','please choose another question');
            // }

            //taking the reference ID's of mcq questions
            $qreferenceid=  Mcq_Question::whereIn('mcq_questions_id', $finalizedmcqid)
            ->get('referenceid');

            //taking the reference for matching reference ID's
            $qreference= Reference::whereIn('R_id',$qreferenceid)
            ->get()->toArray();

            $referenceArray = [];

            //querying the answers for the set of questions 
            $answers = DB::table('mcq_answers')
                ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
                ->select("mcq_answers.description","reference")
                ->whereIn('mcq_answers.question_id', $finalizedmcqid)
                ->get();

                //getting answer reference ID's
                foreach ($answers as $answer) {
                    $reference = $answer->reference;
                    $referenceArray[] = $reference;
                }
                //querying answer reference objects as an array
                $answerreference= Reference::whereIn('R_id',$referenceArray)
                ->get()->toArray();

                // Attempt increasing code (Refreshing must be disabled)
                //Refreshing disabled using HTTP headers & paragmatic headers
                Mcq_Attempt::whereIn('mcq_questions_id',$finalizedmcqid)
                ->where('user_id',$userId)
                ->increment('no_of_attempts');

                //time logic if 'all' category questions are requested
                if ($questionNature=='All'){
                    $time=0;
                    foreach ($questions as $question){
                        if ($question->nature=='GK'){
                            $time+=1;
                        }
                        elseif($question->nature=='IQ'){
                            $time+=1.5;
                        }
                        elseif($question->nature=='MATH'){
                            $time+=2.5;
                        }
                        elseif($question->nature=='OTHER'){
                            $time+=2.5;
                        }
                    }
                }

                return view('Question', compact('questions', 'answers', 'selectedValues', 'finalizedmcqid','time','qreference','answerreference'));
        }
        else
        {
            if ($questionNature==='All'){
                $shortid = $this->allshortid($getpids);
            }else{
                $shortid = $this->getshortid($getpids, $questionNature);
            }

            $num=$this->isnewuser($shortid, $userId,$questionType);
            $finalid = $this->shortattempt($shortid, $userId, $numberOfQuestions,$num);

            $questions = Sh_Question::whereIn('sh_questions_id', $finalid)
            ->get();

            $questionsCount = $questions->count();

            // if ($questionsCount < $numberOfQuestions){
            //     return redirect()->route('student')->with('message','please choose another question');
            // }

            $qreferenceid= Sh_Question::whereIn('sh_questions_id', $finalid)
            ->get('referenceid');

            $qreference= Reference::whereIn('R_id',$qreferenceid)
            ->get()->toArray();

            //time for all kind of question requested
            if ($questionNature=='All'){
                $time=0;
                foreach ($questions as $question){
                    if ($question->nature=='GK'){
                        $time+=1;
                    }
                    elseif($question->nature=='IQ'){
                        $time+=1.5;
                    }
                    elseif($question->nature=='MATH'){
                        $time+=2.5;
                    }
                    elseif($question->nature=='OTHER'){
                        $time+=2.5;
                    }
                }
            }

            return view('shortanswer', compact('questions', 'selectedValues', 'finalid','qreference','time'));   
        }

        
    //}
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

    public function getshortid($n, $n1)
    {
        $shortid = Sh_Question::whereIn('pastpaper_reference', $n)
            ->where('nature', $n1)
            ->pluck('sh_questions_id')
            ->toArray();

        return $shortid;
    }

    public function allmcqid($n)
    {
        //getting the mcq questions ID's for all type of question
        $mcqid = Mcq_Question::whereIn('pastpaper_reference', $n)
            ->pluck('mcq_questions_id')
            ->toArray();

        return $mcqid;
    }

    public function allshortid($n)
    {
        $shortid = Sh_Question::whereIn('pastpaper_reference', $n)
            ->pluck('sh_questions_id')
            ->toArray();
            
        return $shortid;
    }


    public function isnewuser($questionid, $userid,$questionType)
    {
        //function to check if the user is new or not using the attempt count
        if ($questionType === 'MCQ'){
            $attempt = Mcq_Attempt::whereIn('mcq_questions_id', $questionid)
            ->where('user_id', $userid)
            ->sum('no_of_attempts');
        }
        else
        {
            $attempt = Sh_Attempt::whereIn('sh_questions_id', $questionid)
            ->where('user_id', $userid)
            ->sum('no_of_attempts');
        }
        return $attempt;
    }

    public function mcqidattempt($mcqid, $userId, $numberOfQuestions,$numberofattempt)
    {
        //function to get the least attempted question ID's or randomized(if new user)
        if ($numberofattempt==0){
            $attemptmcqid = Mcq_Attempt::whereIn('mcq_questions_id', $mcqid)
            ->where('user_id', $userId)
            ->orderBy('no_of_attempts', 'asc')
            ->inRandomOrder()
            ->take($numberOfQuestions)
            ->pluck('mcq_questions_id')
            ->toArray();
        }
        else{
            $attemptmcqid = Mcq_Attempt::whereIn('mcq_questions_id', $mcqid)
            ->where('user_id', $userId)
            ->orderBy('no_of_attempts', 'asc')
            ->take($numberOfQuestions)
            ->pluck('mcq_questions_id')
            ->toArray();

        }
        

        return $attemptmcqid;
    }

    public function shortattempt($n, $n1, $n2,$n3)
    {
        if ($n3==0){
            $attemptmcqid = Sh_Attempt::whereIn('sh_questions_id', $n)
            ->where('user_id', $n1)
            ->orderBy('no_of_attempts', 'asc')
            ->inRandomOrder()
            ->take($n2)
            ->pluck('sh_questions_id')
            ->toArray();
        }
        else
        {
            $attemptmcqid = Sh_Attempt::whereIn('sh_questions_id', $n)
            ->where('user_id', $n1)
            ->orderBy('no_of_attempts', 'asc')
            ->take($n2)
            ->pluck('sh_questions_id')
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

    // public static function getCorrectAnswer($request)
    // {

    //     $response= Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'api-key' => 'dd21562cc7054bd0a0e5ce89196b16b7', // Replace 'YOUR_API_KEY' with your actual API key
    //     ])->post('https://mslearn.openai.azure.com/openai/deployments/gptt/completions?api-version=2023-09-15-preview', [
    //         "prompt" => "what is the current president of sri lanka?",
    //         "max_tokens" => 50,
    //         "temperature" => 0.2,
    //         "frequency_penalty" => 0,
    //         "presence_penalty" => 0,
    //         "top_p" => 0.5,
    //         "best_of" =>1,
    //         "stop" => null,
    //     ])->json();

    //     $correctAnswer = $response['choices'][0]['text'] ?? 'No answer available';
            
    //     return $correctAnswer;
    // }
}
