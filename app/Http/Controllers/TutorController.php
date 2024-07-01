<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TutorController;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function TutorHomepage(){
        return view('Tutor.TutorHomepage');
    }

    public function TutorForm1(){
        return view('Tutor.TutorForm1');
    }

    public function store(Request $request){
        $faq = new FAQ();
        $faq->Question = $request->Question;
        $faq->Answer = $request->Answer;
        $faq->save();
    }

    public function TutorAddQuestionPage(Request $request){
        $paperdata=$request['examName'];
        return view('Tutor.AddQuestion',['paperdata'=>$paperdata]);
    }
}
