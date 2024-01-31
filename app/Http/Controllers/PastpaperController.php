<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pastpaper;
use Illuminate\Http\Request;

class PastpaperController extends Controller
{
    //
    public function show(Pastpaper $pastpaper)
    {
        // $pastpaper =[
        //     'name' => 'Sri Lanka Accounting Examination',
        //     'year' => '2018',
        //     'language' => 'English',
        //     'paperType' => 'MCQ',
        //     'no_of_questions' => '10',
        //     'time' => '30'
        // ];
        return view('QuestionCreation',[
            'pastpaper' => $pastpaper
        ]);
    }
}
