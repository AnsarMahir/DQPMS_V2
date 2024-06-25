<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function home()
    {
        return view('moderator.home');
    }
}
