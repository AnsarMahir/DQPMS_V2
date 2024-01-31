<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Mcq_Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function showit():View
    {

        $questions = Mcq_Question::take(10)->pluck('description');

        return view('Question', compact('questions'));
    }
}
