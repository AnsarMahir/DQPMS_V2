<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mcq_Question;
use App\Models\Pastpaper;
use Illuminate\Http\Request;

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

    public function storeQuestions(Request $request){
        dd($request['pastpaperData']);
    }   
}
