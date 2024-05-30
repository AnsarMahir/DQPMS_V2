<?php

namespace App\Http\Controllers;

use App\Models\User;
use Jorenvh\Share\Share;
use App\Models\CreatorRank;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Providers\FirebaseServiceProvider;

class ShareWidgetController extends Controller
{
    //

    public function getURL(){
        $factory = (new Factory)
                ->withServiceAccount(config('firebase.projects.app.credentials'))
                ->withDefaultStorageBucket(config('firebase.projects.app.storage.default_bucket'));
        
        
        $bucket = $factory->createStorage()->getBucket();
        
        $file = $bucket->object('Level1.png');

        
        $file->update([
            'acl' => [],
        ], [
            'predefinedAcl' => 'publicRead'
        ]);

        $url = $file->info();   
;

        dd($url);

    }

    public function uploadImageAndGetUrl($image){

        $factory = (new Factory)
                ->withServiceAccount(config('firebase.projects.app.credentials'))
                ->withDefaultStorageBucket(config('firebase.projects.app.storage.default_bucket'));
        
        
        $bucket = $factory->createStorage()->getBucket();

        $image_path = fopen($image, 'r');


        $bucket->upload($image_path);

        



    }

    public function ShareWidget()
    {
        $image = $this->getRankImage(10);

        $creatorName = User::find(10)->name;
        
        $edittedImage = $this->editImage($image,$creatorName);

        $this->uploadImage($edittedImage);
    
        $shareComponent = new Share();

        $shareComponent = $shareComponent->page('https://firebasestorage.googleapis.com/v0/b/dqpms-5abb0.appspot.com/o/Level1.png?alt=media&token=7d81cf15-49a1-4702-91c3-e5b2e9e08675', "My Text")->facebook()->linkedin()->getRawLinks();
            
        PastpaperController::increaseRank(10,40);  
        
        return view('Profile', compact('shareComponent','image','edittedImage'));

        
    }

    public function getRankImage($CreatorId){

        $rank = CreatorRank::where('creator_id',$CreatorId)->pluck('rank')->first();

        $path = public_path('Level/'.(int)$rank.'.png');

        //dd($path);
        
        return $path;

    }

    public function editImage($localimage,$creatorName){

        $fontPath = public_path('fonts/arial.ttf'); 
        $fontSize = 50; 
        $fontColor = '#000000'; 

        $image = ImageManager::gd()->read($localimage);   

        $image->text($creatorName, 250, 450, function ($font) use ($fontPath, $fontSize, $fontColor) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color($fontColor);
            $font->align('center');
            $font->valign('top');
        });

        $imageContent = (string) $image->encode();

        $temporaryImagePath = storage_path('app/' . uniqid() . '.jpg');
        file_put_contents($temporaryImagePath, $imageContent);

        return $temporaryImagePath;

    }
}
