<?php

namespace App\Http\Controllers;

use App\Models\Pastpaper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mcq_Answer;
use App\Models\Mcq_Question;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Validator;

class PastpaperController extends Controller
{
    //
    public function show()
    {
        return view('QuestionCreation');
    }

    public function validateHomepageRequest(Request $request){
        $formFields = $request->validate([
            "examName"=>'required',
            "questionType"=>"required",
            "year"=>"required|integer|between:1990,2099",
            "language"=>"required",
            "numberOfQuestions"=>"required",

        ]);

        return view('QuestionCreation',[
            'pastpaper' => $formFields]);

    }

    public function validateAndStoreQuestions(Request $request){  
        //dd($request);
        $i=0;
        $no_of_questions = $request['pastpaperData'][4];
        $errors = [];
        //dd($request);
        $request->flash();
        
        while($i<(int)$no_of_questions){
            
            $validator = Validator::make($request->all(), [
                'question' . $i => 'required',
                'questionNature' . $i => 'required',
                $i . 'answer1' => 'required',
                $i . 'answer2' => 'required',
                $i . 'answer3' => 'required',
                $i . 'answer4' => 'required',
                $i . 'answerRadio'=> 'required'
            ],
            [
                $i.'answerRadio.required'=>'Please provide a correct answer.'

            ],
            [
                'question'.$i=>'Question',
                $i.'answer1'=>'Answer',
                $i.'answer2'=>'Answer',
                $i.'answer3'=>'Answer',
                $i.'answer4'=>'Answer',
                $i.'answerRadio'=>'Correct Answer'
            ]);
            
            if ($validator->fails()) {
                $errors = array_merge($errors, $validator->errors()->toArray());
            }
        $i++;
        };

        // dd($errors);


        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        $pastpaper = Pastpaper::create([
            'name' => $request['pastpaperData'][0],
            'question_type' => $request['pastpaperData'][1],
            'year' => $request['pastpaperData'][2],
            'language' => $request['pastpaperData'][3],
            'no_of_questions' => $request['pastpaperData'][4],
            'CreatorState'=>'Submitted',
            'ModeratorState'=>'Published',
            'CreatorID'=>1,
            'ModeratorID'=>1
        ]
        );

        $j=0;
        
       
        while($j<(int)$no_of_questions){

            $k=1;

            if($request['pastpaperData'][1]=='MCQ'){
                $question = Mcq_Question::create([
                    'description'=>$request['question' . $j],
                    'nature'=>$request['questionNature' . $j],
                    'correct_answer'=>$request[$j . 'answerRadio'],
                    'pastpaper_reference'=>$pastpaper->P_id,
                    'referenceid'=>1
                ]);

            while($k<=4){
            $answer = new Mcq_Answer;
            $answer->question_id = $question->mcq_questions_id;
            $answer->mcq_ans_id = $k;
            $answer->description = $request[$j.'answer'.$k];
            $answer->reference = 1;
            $answer->save();
            $k++;
            }

            }
            elseif($request['pastpaperData'][1]=='Short Answers'){

                dd($request);

            }else{
                dd($request);
            };

            $j++;
        
        }

        dd($request);

       
        
    }   
    
}
