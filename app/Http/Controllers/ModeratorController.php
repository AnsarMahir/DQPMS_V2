<?php

namespace App\Http\Controllers;
use App\Models\Pastpaper;
use App\Models\Mcq_Question;
use App\Models\Sh_Question;
use App\Models\Mcq_Answer;
use App\Models\Reference;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;





use Illuminate\Support\Facades\Auth;
use App\Models\Mcq_Moderate;


use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function home()
    {
        return view('moderator.home');
    }

    /*public function paperveiw()
    {
        return view('moderator.papers');
    }*/

    public function getSubmittedPapers()
    {
        $moderatorId = Auth::id();

        $submittedPapers = Pastpaper::where('CreatorState', 'Submitted')
                                    ->where('ModeratorID',  $moderatorId)
                                    ->where('ModeratorState', '!=', 'Published')
                                    ->with('paperCreator') // Eager load the creator

                                    ->get();
       // dd($submittedPapers);


        return view('moderator.papers', compact('submittedPapers'));


    }
    public function getPublishedPapers()
{
    $moderatorId = Auth::id();

    $publishedPapers = Pastpaper::where('CreatorState', 'Approved')
                                ->where('ModeratorID',  $moderatorId)
                                ->where('ModeratorState', 'Published')
                                ->with('paperCreator') // Eager load the creator
                                ->get();
    // dd($publishedPapers);

    return view('moderator.published_papers', compact('publishedPapers'));
}




        public function viewPaper($id, $paperType)
        {
            //$pastpaperData = Pastpaper::find($id);

            // Retrieve the past paper data as an array
          $pastpaperData = Pastpaper::where('P_id', $id)->get()->toArray();


            if ($paperType === 'MCQ') {
                // Retrieve MCQ questions with answers and their references, and convert to array
                $paperData = Mcq_Question::with(['answers', 'answers.reference', 'reference'])
                                         ->where('pastpaper_reference', $id)
                                         ->get()
                                         ->toArray();
            } else {
                // Retrieve Short Answer questions with references, and convert to array
                $paperData = Sh_Question::where('pastpaper_reference', $id)
                                        ->get();
            }

            return view('moderator.wholepaper', [
                'pastpaper' => $pastpaperData,
                'paperData' => $paperData,
                'paperType' => $paperType

            ]);

        }
        public function storePastpaper(Request $request, $CreatorState, $ModeratorState, $ModeratorID){

            $pastpaper = Pastpaper::create([
                'name' => $request->pastpaperData[0],
                'question_type' => $request->pastpaperData[1],
                'year' => $request->pastpaperData[2],
                'language' => $request->pastpaperData[3],
                'no_of_questions' => $request->pastpaperData[4],
                'CreatorState'=>$CreatorState,
                'ModeratorState'=>$ModeratorState,
                'CreatorID'=>2,
                'ModeratorID'=>$ModeratorID
            ]
            );

            return $pastpaper;

        }
        public function savedraft(Request $request){

            // dd($request);

            $no_of_questions = $request['pastpaperData'][4];

            $CreatorState = 'Draft';
            $ModeratorState = "NULL";
            $ModeratorID = NULL;

            //dd($request);

            //Store Pastpaper Details
            $pastpaper = $this->storePastpaper($request, $CreatorState,$ModeratorState, $ModeratorID);


            //dd($request['pastpaperData']);

            $j=0;

           //Store Questions and Answers
            if($request['pastpaperData'][1]=='MCQ'){
                while($j<(int)$no_of_questions){

                    $this->storeMcqQuestion($request,$j,$pastpaper);

                    $j++;
            }
            }
            elseif($request['pastpaperData'][1]=='Short Answer'){
                while($j<(int)$no_of_questions){

                    $this->storeShQuestions($request,$j,$pastpaper);

                    $j++;
                }
            }else{

                dd($request);

            };

            return redirect('CreatorHomepage')->with('message','Paper saved as Draft');

        }


        public function changeState($pastpaper){

            $getPastpaper = Pastpaper::where('P_id',$pastpaper);
            $getPastpaper->update([
                'CreatorState'=>'Approved',
                'ModeratorState'=>'Published'


            ]);


        }
        public function storeQuestionReference($request,$j){

            $filename = time() . '-' . $j . 'QuestionReference.' . $request->file($j.'Q_Reference')->extension();
            $request->file($j.'Q_Reference')->move(public_path('References'), $filename);

            $questionReference = Reference::create([
                'reference_HTML'=>"/References/" . $filename

            ]);

            return $questionReference;

        }


        public function validateAndStoreQuestionsMod(Request $request){

           //dd($request);

            $i=0;
            $no_of_questions = $request['pastpaperData'][1];
            $errors = [];
            $request->flash();


            //Validate Questions and Answers
            if($request['pastpaperData'][2]=='MCQ'){

                while($i<(int)$no_of_questions){

                    $validator = Validator::make($request->all(), [
                        'question' . $i => 'required',
                        'questionNature' . $i => 'required',
                        $i . 'answer0' => 'required',
                        $i . 'answer1' => 'required',
                        $i . 'answer2' => 'required',
                        $i . 'answer3' => 'required',
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





            $j=0;

            if($request['pastpaperData'][2]=='MCQ'){
                while($j<(int)$no_of_questions){
                    if($request->hasFile($j.'Q_Reference')){

                        $questionReference = $this->storeQuestionReference($request,$j);

                        // dd($questionReference);


                    }else{
                        $questionReference = null;
                    }


                    $question = Mcq_Question::where('mcq_questions_id',$request['questionID'.$j]);

                    $question->update([
                        'description' => $request['question'.$j],
                        'nature' => $request['questionNature'.$j],
                        'correct_answer' => $request[$j . 'answerRadio']
                    ]);

                    if($questionReference){
                        $question->update([
                            'referenceid' => $questionReference->R_id
                        ]);
                    }

                    $questionID = (int)$request['questionID'.$j];

                    $answers = Mcq_Answer::where('question_id',$questionID)->get();

                    //dd($answers);
                    //dd($request);

                    $i = 0;
                    $a = 1;

                    foreach($answers as $answer){

                        //dd($answer);

                        if($request->hasFile($j.'A_Reference'.$a)){

                            $filename = time() . '-' . $j . 'Answer_Reference' . $a . '.' . $request->file($j.'A_Reference'.$a)->extension();
                            $request->file($j.'A_Reference'.$a)->move(public_path('References'), $filename);

                            $answerReference = Reference::create([
                                'reference_HTML'=>"/References/" . $filename
                            ]);

                        }else{

                            $answerReference = null;

                        }

                        $answer->update([
                            'description' => $request[$j . 'answer' . $i],
                        ]);

                        if($answerReference){
                            $answer->update([
                                'reference' => $answerReference->R_id
                            ]);
                        }

                        $a++;
                        $i++;
                    }


                    $j++;



                    $j++;
                }
            }
            elseif($request['pastpaperData'][1]=='Short Answer'){
                while($j<(int)$no_of_questions){


                    $j++;
                }
            }else{

                //dd($request);

            };


            $this->changeState($request["pastpaperData"][0]);


            return redirect(route('published.papers'));



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
                        'reference_HTML'=>"/References/" . $filename
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

        public function resavedraft(Request $request){

            //dd($request);

            $no_of_questions = $request['pastpaperData'][1];

            $j = 0;

                if($request['pastpaperData'][2]=='MCQ'){
                    while($j<(int)$no_of_questions){

                        if($request->hasFile($j.'Q_Reference')){

                            $questionReference = $this->storeQuestionReference($request,$j);

                            // dd($questionReference);


                        }else{
                            $questionReference = null;
                        }


                        $question = Mcq_Question::where('mcq_questions_id',$request['questionID'.$j]);

                        $question->update([
                            'description' => $request['question'.$j],
                            'nature' => $request['questionNature'.$j],
                            'correct_answer' => $request[$j . 'answerRadio']
                        ]);

                        if($questionReference){
                            $question->update([
                                'referenceid' => $questionReference->R_id
                            ]);
                        }

                        $questionID = (int)$request['questionID'.$j];

                        $answers = Mcq_Answer::where('question_id',$questionID)->get();

                        //dd($answers);
                        //dd($request);

                        $i = 0;
                        $a = 1;

                        foreach($answers as $answer){

                            //dd($answer);

                            if($request->hasFile($j.'A_Reference'.$a)){

                                $filename = time() . '-' . $j . 'Answer_Reference' . $a . '.' . $request->file($j.'A_Reference'.$a)->extension();
                                $request->file($j.'A_Reference'.$a)->move(public_path('References'), $filename);

                                $answerReference = Reference::create([
                                    'reference_HTML'=>"/References/" . $filename
                                ]);

                            }else{

                                $answerReference = null;

                            }

                            $answer->update([
                                'description' => $request[$j . 'answer' . $i],
                            ]);

                            if($answerReference){
                                $answer->update([
                                    'reference' => $answerReference->R_id
                                ]);
                            }

                            $a++;
                            $i++;
                        }


                        $j++;
                }
                }
                elseif($request['pastpaperData'][2]=='Short Answer'){
                    while($j<(int)$no_of_questions){

                        $question = Sh_Question::where('sh_questions_id',$request['sh_questions_id'.$j]);

                        $question->update([
                            'description' => $request['question'.$j],
                            'nature' => $request['questionNature'.$j],
                            'correct_answer' => $request[$j.'answer']
                        ]);


                        $j++;
                    }
                }else{

                    //dd($request);

                };

                return redirect('CreatorHomepage')->with('message','Paper saved as Draft');

            }

    }































