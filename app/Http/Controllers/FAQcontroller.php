<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FAQcontroller;
use Illuminate\Http\Request;

class FAQcontroller extends Controller
{
    public function index(){
        return view('FAQ.index');
    }

    public function index2(){
        return view('FAQ.index2');
    }

    public function store(Request $request){
        $faq = new FAQ();
        $faq->Question = $request->Question;
        $faq->Answer = $request->Answer;
        $faq->save();
    }
}
