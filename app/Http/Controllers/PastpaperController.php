<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pastpaper;
use Illuminate\Http\Request;

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

    public function storeQuestions(Request $request){
        dd($request['pastpaperData']);
    }   
}
