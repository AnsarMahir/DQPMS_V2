<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post; // Correct casing: 'App\Models\Post'


class PostController extends Controller
{
    public function index()
    {
        $post= Post::all();
        return view('comment', compact('post')); 
//comment is blade file name and the browser name
    }
}
