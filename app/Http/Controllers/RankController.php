<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use App\Models\Mcq_Attempt;
use App\Models\UserQuestion;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class RankController extends Controller
{

    public static function generateBadge(Request $request)
    {
        $userName = Auth::user()->name;

        //level logic
        $mcqcount = UserQuestion::where('user_id', Auth::user()->id)->count();
        $rightcount = UserQuestion::where('user_id', Auth::user()->id)
                                  ->where('final_answer_status', 1)
                                  ->count();
    
        $level = 1;
        $progress = 0;
        $questionsToNextLevel = 0;
    
        if ($rightcount >= 0 && $rightcount <= 40) {
            $image = ImageManager::gd()->read('level1.jpg');
            $progress = ($rightcount / 40) * 100;
            $questionsToNextLevel = 40 - $rightcount;
        } else if ($rightcount > 40 && $rightcount <= 80) {
            $image = ImageManager::gd()->read('level2.jpg');
            $level = 2;
            $progress = (($rightcount - 40) / 40) * 100;
            $questionsToNextLevel = 80 - $rightcount;
        } else if ($rightcount > 80) {
            $image = ImageManager::gd()->read('level3.jpg');
            $level = 3;
            $progress = 100;
            $questionsToNextLevel = 0; // No more levels
        }
    
        
    
        // Define text properties
        $fontPath = public_path('fonts/arial.ttf'); // Path to the font file
        $fontSize = 50; // Font size
        $fontColor = '#000000'; // Font color
    
        // Add text to the image
        $image->text($userName, 250, 450, function ($font) use ($fontPath, $fontSize, $fontColor) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color($fontColor);
            $font->align('center');
            $font->valign('top');
        });
    
        // Encode the image to a JPEG data string
        $imageContent = (string) $image->encode();
    
        // Save the image to a temporary location
        $temporaryImagePath = storage_path('app/' . uniqid() . '.jpg');
        file_put_contents($temporaryImagePath, $imageContent);
    
        

            $factory = (new Factory)
            ->withServiceAccount(storage_path('app/dqpms-102ee-firebase-adminsdk-gf7br-33ae3a8a65.json'))
            ->withDefaultStorageBucket('dqpms-102ee.appspot.com');

        $storage = $factory->createStorage();
        $bucket = $storage->getBucket();
    
        $firebaseStoragePath = 'badges/' . uniqid() . '.jpg';
        $file = fopen($temporaryImagePath, 'r');
        $bucket->upload($file, [
            'name' => $firebaseStoragePath
        ]);
    
        // Make the uploaded file publicly accessible
        $uploadedFile = $bucket->object($firebaseStoragePath);
        $uploadedFile->update([
            'acl' => [],
        ], [
            'predefinedAcl' => 'publicRead'
        ]);
    
        // Get the URL of the uploaded image
        $imageUrl = $uploadedFile->info()['mediaLink'];
    
        // Create a data URL for displaying in the view
        $base64Image = base64_encode($imageContent);
        $dataUrl = 'data:image/jpeg;base64,' . $base64Image;
    
        // Pass the image data URL and the Firebase image URL to the view
        return view('rank', ['image' => $dataUrl, 'firebaseImageUrl' => $imageUrl,'level' => $level,
        'progress' => $progress,
        'rightcount' => $rightcount,'userName' => $userName,'questionsToNextLevel' => $questionsToNextLevel]);
    }
}
