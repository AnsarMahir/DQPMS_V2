<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use App\Models\Mcq_Attempt;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class RankController extends Controller
{

    public static function generateBadge(Request $request)
    {
        // Retrieve the authenticated user's name
        $userName = Auth::user()->name;

        //level logic
        $mcqcount = Mcq_Attempt::where('user_id',Auth::user()->id)
        ->count();
        $nonattempt=Mcq_Attempt::where('user_id',Auth::user()->id)
        ->whereNot('no_of_attempts',[0,NULL])
        ->count();

        $mcqattemptpercentage = ($nonattempt/$mcqcount)*100;


        if ($mcqattemptpercentage>=0 && $mcqattemptpercentage<=30 ){
            // Load the base image
        $image = ImageManager::gd()->read('level1.jpg');

        }
        else if($mcqattemptpercentage>30 && $mcqattemptpercentage<=75){
        // Load the base image
        $image = ImageManager::gd()->read('level2.jpg');
        }
        else if ($mcqattemptpercentage>75 && $mcqattemptpercentage<=100){
            // Load the base image
        $image = ImageManager::gd()->read('level3.jpg');

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
    
        // Initialize Firebase
        // $serviceAccount = ServiceAccount::fromJsonFile(storage_path('app/firebase-service-account.json'));
        // $firebase = (new Factory)
        //     ->withServiceAccount($serviceAccount)
        //     ->create();

            $factory = (new Factory)
            ->withServiceAccount(storage_path('app/dqpms-102ee-firebase-adminsdk-gf7br-33ae3a8a65.json'))
            ->withDefaultStorageBucket('dqpms-102ee.appspot.com');

            //->withDatabaseUri('https://my-project-default-rtdb.firebaseio.com');
    
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
        return view('rank', ['image' => $dataUrl, 'firebaseImageUrl' => $imageUrl]);
    }
}
