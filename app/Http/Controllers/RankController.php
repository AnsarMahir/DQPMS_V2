<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class RankController extends Controller
{
    public function showBadgePage(Request $request)
    {
        // Normally, you'd retrieve the user's name from the authenticated user or session
        $userName = 'Hamaas'; // This is just an example. You'd replace this with actual logic.

        // Store the name in the session
        session(['userName' => $userName]);

        // Trigger the generation via a POST request to the same controller
        return view('badge'); // Create a Blade view named badge-page
    }

    public static function generateBadge(Request $request)
    {

        
        // Retrieve the user's name from the session
        $userName = Auth::user()->name;

        // Load the base image

        $image = ImageManager::gd()->read('level1.jpg');

        //Define text properties
        $fontPath = public_path('fonts/arial.ttf'); // Path to the font file
        $fontSize = 50; // Font size
        $fontColor = '#000000'; // Font color

        // Add text to the image
        $image->text($userName, 250,450, function($font) use ($fontPath, $fontSize, $fontColor) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color($fontColor);
            $font->align('center');
            $font->valign('top');
        });

        

        $imageContent =(string) $image->encode();
        $base64Image = base64_encode($imageContent);
        $dataUrl = 'data:image/jpeg;base64,' . $base64Image;

        // Return the image as a response
        // return response($imageContent, 200)
        //     ->header('Content-Type', 'image/jpeg');

        return view('rank', ['image' => $dataUrl]);
    }
}
