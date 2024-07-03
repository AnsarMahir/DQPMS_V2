<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\User;
use App\Rules\TitleCase;
use App\Models\Pastpaper;
use App\Models\Reference;
use App\Models\Mcq_Answer;
use App\Models\CreatorRank;
use App\Models\Paper_Title;
use App\Models\Sh_Question;
use App\Models\Mcq_Question;
use Illuminate\Http\Request;
use Kreait\Firebase\Storage;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\error;
use vendor\jorenvanhocht\src\Share;
use App\Http\Controllers\Controller;
use App\Models\PaperTitleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Providers\FirebaseServiceProvider;
use Kreait\Laravel\Firebase\Facades\Firebase;

//use Illuminate\Validation\Validator;

class PastpaperController extends Controller
{
    //
    public function getCreatorHomepage(){
        $paperTitles = Paper_Title::distinct()->pluck('Paper_Title');

        return view('CreatorHomepage', compact('paperTitles'));
    }
    public function show()
    {
        return view('QuestionCreation');
    }

    public function getQuestionNature(Request $request)
{
    $exam = $request->input('exam');
    $language = $request->input('language');

    // Fetch data from the pastpaper table based on exam and language
    $questionid = DB::table('pastpaper')
                        ->where('name', $exam)
                        ->where('language', $language)
                        ->pluck('P_id');
    $questionNatures=DB::table('mcq_questions')
                        ->whereIn('pastpaper_reference',$questionid)
                        ->distinct()
                        ->pluck('nature');


    return response()->json($questionNatures);
}

    public function showForm()
{
    $examname = Pastpaper::select('name')->where('ModeratorState','Published')->distinct()->get()->pluck('name');
    $natures = Mcq_Question::select('nature')->distinct()->get()->pluck('nature');
    $languages = Pastpaper::select('language')->distinct()->get()->pluck('language');
    return view('StudentHomepage', compact('examname','natures','languages'));
}

public function showqnature(){
    
    return view('StudentHomepage', compact('natures'));
}

    public function validateHomepageRequest(Request $request){

        $currentYear = date('Y');

        $formFields = $request->validate([
            "examName"=>'required',
            "questionType"=>"required",
            "year"=>"required|integer|between:1990,$currentYear",
            "language"=>"required",
            "numberOfQuestions"=>"required",

        ]);

        $types = $this->getQuestionTypes($request['examName']);



        return view('QuestionCreation',[
            'pastpaper' => $formFields,
            'qNatures' => $types
        ]);

    }

    function getQuestionTypes($title){

        $paperTitle = Paper_Title::where('Paper_Title',$title)->with('types')->first();
        
        $types = $paperTitle->types->pluck('Question_types');

        return $types;

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

    public function getModeratorId(){
        
        $moderatorQuery = Pastpaper::select('moderatorid', DB::raw('COUNT(*) as pastpapers_count'))
                                    ->groupBy('moderatorid')
                                    ->orderBy('pastpapers_count', 'asc')
                                    ->first();

        if($moderatorQuery){

            $moderatorId = $moderatorQuery->moderatorid;

        }else{

            $moderatorId = User::where('type', 'MODERATOR')->pluck('id')->first();

        }

        return $moderatorId;
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
            'CreatorID'=>Auth::id(),
            'ModeratorID'=>$ModeratorID
        ]       
        );

        return $pastpaper;

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

            dd($request);

        };

        return redirect('CreatorHomepage')->with('message','Paper saved as Draft');

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

    public function retrieveDraft(){
        $pastpaperID = Pastpaper::where('CreatorState', 'Draft')->where('CreatorID',Auth::id())->pluck('P_id');

        $pastpaperData = Pastpaper::whereIn('P_id', $pastpaperID)->get();

        return view('DraftPaperPage',
        ['PastpaperData' => $pastpaperData]
        );                                
    }

    public function retrievePublished(){
        $pastpaperID = Pastpaper::where('CreatorID', Auth::id())->where(function($query) {
                            $query->where('CreatorState', 'Submitted')
                                ->orWhere('CreatorState', 'Approved');
                        })
                        ->pluck('P_id');


        $pastpaperData = Pastpaper::whereIn('P_id', $pastpaperID)->get();

        return view('PublishedPapers',
        ['PastpaperData' => $pastpaperData]
        );

    }

    public function viewPaper($id,$paperType){

        $pastpaperData = Pastpaper::where('P_id',$id)->get()->toArray();


        if($paperType == 'MCQ'){
            $paperData = Mcq_Question::with(['answers','answers.reference','reference'])->where('pastpaper_reference',$id)->get()->toArray(); 
         
        }else{
            $paperData = Sh_Question::where('pastpaper_reference',$id)->get();   
        }

        //dd($pastpaperData);

        return view('ViewDraft',[
            'pastpaper' => $pastpaperData,
            'paperData' => $paperData
            // 'reference' => $reference
        ]);

    }

    public function viewPublishedPaper($id,$paperType){

        $pastpaperData = Pastpaper::where('P_id',$id)->get()->toArray();


        if($paperType == 'MCQ'){
            $paperData = Mcq_Question::with(['answers','answers.reference','reference'])->where('pastpaper_reference',$id)->get()->toArray(); 
         
        }else{
            $paperData = Sh_Question::where('pastpaper_reference',$id)->get();   
        }

        //dd($pastpaperData);

        return view('ViewPublished',[
            'pastpaper' => $pastpaperData,
            'paperData' => $paperData
            // 'reference' => $reference
        ]);


    }

    public function deleteDraftPaper($id){
        $paper = Pastpaper::find($id);

        if (!$paper) {
            return response()->json(['message' => 'Paper not found'], 404);
        }

        $paper->delete();

        session()->flash('message', 'Draft deleted successfully');

        return response()->json(['message' => 'Paper deleted successfully']);
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

        $CreatorState = 'Submitted';
        $ModeratorID = $this->getModeratorId();
        $ModeratorState = "Review";
        $CreatorId = Auth::id();
        


        //Store Pastpaper Details
        $pastpaper = $this->storePastpaper($request, $CreatorState,$ModeratorState, $ModeratorID);
              
       //Store Questions and Answers
        $j=0;
        
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

        $this->increaseRank($CreatorId,$no_of_questions);



        return redirect('CreatorHomepage')->with('message','Paper uploaded for review successfully');

       
        
    }

    public static function increaseRank($CreatorId,$no_of_questions){
        
        CreatorRank::where('creator_id',$CreatorId)->increment('no_of_questions',$no_of_questions);

        $questionsCreated = CreatorRank::where('creator_id',$CreatorId)->pluck('no_of_questions')->first();

        $rank = $questionsCreated/40;

        $creatorRank = CreatorRank::where('creator_id',$CreatorId)->first(); 

        $creatorRank->rank = $rank ? $rank: 1;

        $creatorRank->save();

        //
    }

    public function storeQuestionReference($request,$j){

        $rules = [
            $j.'Q_Reference' => 'image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=600'
        ];

        $messages = [
            $j.'Q_Reference.image' => 'The file must be an image.',
            $j.'Q_Reference.dimensions' => 'The image dimensions must be between 100x100 and 1000x600 pixels.'
        ];
    
        // Validate the request
        $request->validate($rules,$messages);

        $filename = time() . '-' . $j . 'QuestionReference.' . $request->file($j.'Q_Reference')->extension();
        $request->file($j.'Q_Reference')->move(public_path('References'), $filename);

        $questionReference = Reference::create([
            'reference_HTML'=>"/References/" . $filename 

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
    
    public function addPaperTitle(Request $request){

        $validatedData = $request->validate([
            'paperInput' => ['required', new TitleCase],
            'questionNatures' =>['required', 'array', 'min:1']
        ],
        [
            'paperInput.required' => 'Please enter a valid title',
            'questionNatures.required' => 'Please select at least one nature'
        ]);

        $paperTitle = Paper_Title::create([
            'Paper_Title' => $validatedData['paperInput'],
        ]);


        //$questionNatures = $validatedData['$questionNatures'];
        
        foreach ($validatedData['questionNatures'] as $nature) {

            $questionType = PaperTitleType::where('Question_types', $nature)->first();


            if ($questionType) {
                $paperTitle->types()->attach($questionType->id);
            }
        }
        

        return redirect()->back()->with('message','Paper Added Successfully');

    }

    public function getPaperTitle(){
        
        $papers = Paper_Title::with('types')->get();

        return response()->json($papers);
    }

    public function deletePaperTitle($id){
        $paper = Paper_Title::find($id);

        if (!$paper) {
            return response()->json(['message' => 'Paper not found'], 404);
        }

        $paper->delete();

        session()->flash('message', 'Paper Title deleted successfully');

        return response()->json(['message' => 'Paper deleted successfully']);

    }
    
    
}
