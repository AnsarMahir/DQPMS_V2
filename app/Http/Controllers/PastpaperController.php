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

    public function showForm()
{
    $examname = Pastpaper::select('name')->distinct()->get()->pluck('name');
    $natures = Mcq_Question::select('nature')->distinct()->get()->pluck('nature');
    $languages = Pastpaper::select('language')->distinct()->get()->pluck('language');
    return view('StudentHomepage', compact('examname','natures','languages'));
}

public function showqnature(){
    
    return view('StudentHomepage', compact('natures'));
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

    public function getLanguages(Request $request)
    {
        $exam = $request->input('exam');

        $languages = Pastpaper::where('name', $exam)
            ->select('language')
            ->distinct()
            ->get()
            ->pluck('language');

        return response()->json($languages);
    }

    public function draft(Request $request){
        dd($request);
    }

    public function validateAndStoreQuestions(Request $request){

        //dd($request);

        $i=0;
        $no_of_questions = $request['pastpaperData'][4];
        $errors = [];
        $request->flash();
        

        //Validate Questions and Answers

        while($i<(int)$no_of_questions){

            if($request['pastpaperData'][1]=='MCQ'){     

            $validator = Validator::make($request->all(), [
                'question' . $i => 'required',
                'questionNature' . $i => 'required',
                $i . 'answer1' => 'required',
                $i . 'answer2' => 'required',
                $i . 'answer3' => 'required',
                $i . 'answer4' => 'required',
                $i . 'answerRadio'=> 'required',
                //$i . 'answer'=>'required'
                //Validate Reference
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
            }


            //ShortAnswer Validator
            else{

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


            }

            if ($validator->fails()) {
                $errors = array_merge($errors, $validator->errors()->toArray());
            }
        $i++;
        };

        //dd($errors);

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        //  dd($request);


        //Store Pastpaper Details

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
       //Store Questions and Answers
        while($j<(int)$no_of_questions){  

            // Store Question and Answers 
            if($request['pastpaperData'][1]=='MCQ'){

                //Store Question_Reference if found        
                if($request->hasFile($j.'Q_Reference')){
                    
                    $filename = time() . '-' . $j . 'QuestionReference.' . $request->file($j.'Q_Reference')->extension();
                    $request->file($j.'Q_Reference')->move(public_path('References'), $filename);

                    $questionReference = Reference::create([
                        'reference_HTML'=>'<img src="' . $filename . "\"" . ' class="img-fluid">'

                    ]);

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
            
            elseif($request['pastpaperData'][1]=='Short Answers'){

                //dd($request);

                if($request->hasFile($j.'Q_Reference')){
                    
                    $filename = time() . '-' . $j . 'QuestionReference.' . $request->file($j.'Q_Reference')->extension();
                    $request->file($j.'Q_Reference')->move(public_path('References'), $filename);

                    $questionReference = Reference::create([
                        'reference_HTML'=>'<img src="' . $filename . "\"" . ' class="img-fluid">'

                    ]);

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

                $question = Sh_Question::create([
                    'description'=>$request['question' . $j],
                    'nature'=>$request['questionNature' . $j],
                    'pastpaper_reference'=>$pastpaper->P_id,
                    'q_referenceid'=> $questionReference ? $questionReference->R_id : null,
                    'a_referenceid'=> $answerReference ? $answerReference->R_id : null,
                    'correct_answer'=>$request[$j.'answer']
                ]);


            }else{
                dd($request);
            };

            $j++;
        
        }

        return redirect('CreatorHomepage');

       
        
    }
}
