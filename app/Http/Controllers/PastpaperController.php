<?php

namespace App\Http\Controllers;

use App\Models\Pastpaper;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mcq_Answer;
use App\Models\Mcq_Question;
use App\Models\Reference;
use App\Models\Sh_Question;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

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

    public function storePastpaper(Request $request){

        $pastpaper = Pastpaper::create([
            'name' => $request['pastpaperData'][0],
            'question_type' => $request['pastpaperData'][1],
            'year' => $request['pastpaperData'][2],
            'language' => $request['pastpaperData'][3],
            'no_of_questions' => $request['pastpaperData'][4],
            'CreatorState'=>'Draft',
            'ModeratorState'=>'NULL',
            'CreatorID'=>1,
            'ModeratorID'=>1
        ]   
        );

        return $pastpaper;

    }


    public function savedraft(Request $request){

        $no_of_questions = $request['pastpaperData'][4];

        //Store Pastpaper Details

        $pastpaper = $this->storePastpaper($request);

        $j=0;        
       //Store Questions and Answers
       if($request['pastpaperData'][1]=='MCQ'){
            while($j<(int)$no_of_questions){

                $this->storeMcqQuestion($request,$j,$pastpaper);

                $j++;
        }
        }
        elseif($request['pastpaperData'][1]=='Short Answers'){
            while($j<(int)$no_of_questions){

                $this->storeShQuestions($request,$j,$pastpaper);

                $j++;
            }
        }else{

            dd($request);

        };

        return redirect('CreatorHomepage');       
        
    }

    public function retrieveDraft(){
        $pastpaperID = Pastpaper::where('CreatorState', 'Draft')->where('CreatorID',1)->pluck('P_id');

        $pastpaperData = Pastpaper::whereIn('P_id', $pastpaperID)->get();

        //dd($pastpaperData);

        return view('DraftPaperPage',
        ['PastpaperData' => $pastpaperData]
    );                                
    }


    public function validateAndStoreQuestions(Request $request){

        //dd($request);

        $i=0;
        $no_of_questions = $request['pastpaperData'][4];
        $errors = [];
        $request->flash();
        

        //Validate Questions and Answers
        if($request['pastpaperData'][1]=='MCQ'){
            
            while($i<(int)$no_of_questions){

                $validator = Validator::make($request->all(), [
                    'question' . $i => 'required',
                    'questionNature' . $i => 'required',
                    $i . 'answer1' => 'required',
                    $i . 'answer2' => 'required',
                    $i . 'answer3' => 'required',
                    $i . 'answer4' => 'required',
                    $i . 'answerRadio'=> 'required',
                ],
                [
                    $i.'answerRadio.required'=>'Please provide a correct answer.',
                    $i.'answer.required'=>'Please provide a correct answer'
    
                ],
                [
                    'question'.$i=>'Question',
                    $i.'answer1'=>'Answer',
                    $i.'answer2'=>'Answer',
                    $i.'answer3'=>'Answer',
                    $i.'answer4'=>'Answer',
                ]);

                if ($validator->fails()) {
                    $errors = array_merge($errors, $validator->errors()->toArray());
                }

                $i++;

            }
        }
        else{
            
            while($i<(int)$no_of_questions){

                $validator = Validator::make($request->all(), [
                    'question' . $i => 'required',
                    'questionNature' . $i => 'required',
                    $i.'answer'=>'required'
                ],
                [
                    $i.'answer.required'=>'Please provide a correct answer'
                ],
                [
                    'question'.$i=>'Question'
                ]
                
                );

                if ($validator->fails()) {
                    $errors = array_merge($errors, $validator->errors()->toArray());
                }

                $i++;
            }

        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }


        //Store Pastpaper Details
        $pastpaper = $this->storePastpaper($request);
              
       //Store Questions and Answers
        $j=0;
        
        if($request['pastpaperData'][1]=='MCQ'){
            while($j<(int)$no_of_questions){

                $this->storeMcqQuestion($request,$j,$pastpaper);

                $j++;
            }
        }
        elseif($request['pastpaperData'][1]=='Short Answers'){
            while($j<(int)$no_of_questions){

                $this->storeShQuestions($request,$j,$pastpaper);

                $j++;
            }
        }else{

            dd($request);

        };

        return redirect('CreatorHomepage');

       
        
    }

    public function storeQuestionReference($request,$j){

        $filename = time() . '-' . $j . 'QuestionReference.' . $request->file($j.'Q_Reference')->extension();
        $request->file($j.'Q_Reference')->move(public_path('References'), $filename);

        $questionReference = Reference::create([
            'reference_HTML'=>'<img src="' . $filename . "\"" . ' class="img-fluid">'

        ]);

        return $questionReference;

    }
    
    public function storeMcqQuestion(Request $request,$j,$pastpaper){

        //Store Reference if found
        if($request->hasFile($j.'Q_Reference')){
                    
            $questionReference = $this->storeQuestionReference($request,$j);

            // dd($questionReference);
            
        
        }else{
            $questionReference = null;
        }

        //Store Question
        $question = Mcq_Question::create([
            'description'=>$request['question' . $j],
            'nature'=>$request['questionNature' . $j],
            'correct_answer'=>$request[$j . 'answerRadio'],
            'pastpaper_reference'=>$pastpaper->P_id,
            'referenceid'=> $questionReference ? $questionReference->R_id : null
        ]);

        //Store Answers with Reference
        $a=1;
        while($a<=4){
        
            if($request->hasFile($j.'A_Reference'.$a)){
                
                $filename = time() . '-' . $j . 'Answer_Reference' . $a . '.' . $request->file($j.'A_Reference'.$a)->extension();
                $request->file($j.'A_Reference'.$a)->move(public_path('References'), $filename);

                $answerReference = Reference::create([
                    'reference_HTML'=>'<img src="' . $filename . '">'
                ]);

            }else{

                $answerReference = null;

            }

            $answer = new Mcq_Answer;
            $answer->question_id = $question->mcq_questions_id;
            $answer->mcq_ans_id = $a;
            $answer->description = $request[$j.'answer'.$a];
            $answer->reference = $answerReference ? $answerReference->R_id : null;
            $answer->save();
            
            
            $a++;

        }

    }

    public function storeShQuestions($request,$j,$pastpaper){

        if($request->hasFile($j.'Q_Reference')){
                    
            $questionReference = $this->storeQuestionReference($request,$j);
            // dd($questionReference);
            
        
        }else{
            $questionReference = null;
        }

        if($request->hasFile($j.'A_Reference')){
            
            $filename = time() . '-' . $j . 'AnswerReference.' . $request->file($j.'A_Reference')->extension();
            $request->file($j.'A_Reference')->move(public_path('References'), $filename);

            $answerReference = Reference::create([
                'reference_HTML'=>'<img src="' . $filename . "\"" . ' class="img-fluid">'

            ]);

            // dd($questionReference);
            
        
        }else{
            $answerReference = null;
        }

        Sh_Question::create([
            'description'=>$request['question' . $j],
            'nature'=>$request['questionNature' . $j],
            'pastpaper_reference'=>$pastpaper->P_id,
            'q_referenceid'=> $questionReference ? $questionReference->R_id : null,
            'a_referenceid'=> $answerReference ? $answerReference->R_id : null,
            'correct_answer'=>$request[$j.'answer']
        ]);

    }
    
    
    
}
