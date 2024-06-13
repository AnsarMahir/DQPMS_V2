<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pastpaper;
use App\Models\CreatorRank;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class ShareWidgetController extends Controller
{
    //

    public function getProfilePage()
    {
        $rank = $this->getRank(10);
        $rankStat = $this->getRankDetails(10);

        $creatorName = User::find(10)->name;

        $mcqQuestionsCount = $this->getMcqQuestions(10);

        $shQuestionsCount= $this->getShQuestions(10);

        $gkQuestionsCount = $this->getQuestionTypeCount(10,'GK');

        $IqQuestionsCount = $this->getQuestionTypeCount(10,'IQ');

        $MathQuestionsCount = $this->getQuestionTypeCount(10,'MATH');

        $LogicQuestionsCount = $this->getQuestionTypeCount(10,'LOGIC');

        $OtherQuestionsCount = $this->getQuestionTypeCount(10,'OTHER');
        

        
        return view('Profile', compact('rank','creatorName','mcqQuestionsCount','shQuestionsCount','gkQuestionsCount','IqQuestionsCount','MathQuestionsCount','LogicQuestionsCount','OtherQuestionsCount','rankStat'));

        
    }

    public function getMcqQuestions($CreatorId){

        $pastPaper = Pastpaper::withCount('McqQuestions')->where([
            'CreatorID'=>$CreatorId,
            'CreatorState'=>'Approved',
            'question_type'=>'MCQ'])->get();

        $mcq_count = $this->countQuestions($pastPaper,'mcq_questions_count');

        
        return (int)$mcq_count;
    }

    public function countQuestions($pastPaper,$questionType){

        $question_count = 0;

        foreach($pastPaper as $pastpaper){
            $question_count += $pastpaper->$questionType;
        }

        return $question_count;
    }

    public function getShQuestions($CreatorId){

        $pastPaper = Pastpaper::withCount('ShQuestions')->where([
            'CreatorID'=>$CreatorId,
            'CreatorState'=>'Approved',
            'question_type'=>'Short Answer'])->get();        

        $sh_count = $this->countQuestions($pastPaper,'sh_questions_count');

        return (int)$sh_count;
    }

    public function getQuestionTypeCount($CreatorId,$questionNature){

        $pastPaper = Pastpaper::withCount([
            'ShQuestions' => function($query) use ($questionNature){
                $query->where('nature',$questionNature);
            },
            'McqQuestions' => function($query)use($questionNature){
                $query->where('nature',$questionNature);
            }
            ])->where(['CreatorID'=>$CreatorId,'CreatorState'=>'Approved'])->get();  
            
        $paperCount = 0;

        foreach($pastPaper as $paper){
            $paperCount += $paper->sh_questions_count + $paper->mcq_questions_count;
        }

        return (int)$paperCount;
    }

    public function shareBadge($appName){

        $rank = $this->getRank(10);

        $creatorName = User::find(10)->name;

        $public_path = public_path('Level/'.$rank.'.png');

        $edittedImagePath = $this->editImage($public_path,$creatorName);//Add Creators Name to Image

        $publicURL = $this->uploadImageAndGetUrl($edittedImagePath);//Get the Public URL

        //dd($edittedImagePath);

        if($appName == 'facebook'){

            return redirect()->to('https://www.facebook.com/sharer/sharer.php?u=' . urlencode($publicURL));
        }
        elseif($appName == 'linkedin'){

            return redirect()->to('https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($publicURL));
        }
        else
        {
            dd('Invalid URL');
        }

    }

    public function editImage($localimage,$creatorName){

        //dd($localimage);

        $fontPath = public_path('fonts/font2.ttf'); 
        $fontSize = 40; 
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


    public function uploadImageAndGetUrl($image){

        $factory = (new Factory)
                ->withServiceAccount(config('firebase.projects.app.credentials'))
                ->withDefaultStorageBucket(config('firebase.projects.app.storage.default_bucket'));
        
        
        $bucket = $factory->createStorage()->getBucket();

        $image_path = fopen($image, 'r');


        $imageObject = $bucket->upload($image_path);
        $imageObject->update(['acl' => []], ['predefinedAcl' => 'publicRead']);

        $publicUrl = "https://storage.googleapis.com/{$bucket->name()}/{$imageObject->name()}";

        return $publicUrl;      



    }

    public function getRank($CreatorId){

        $CreatorRankQuery = CreatorRank::where('creator_id',$CreatorId)->first();

        $CreatorRank = $CreatorRankQuery->no_of_questions/40;

        $CreatorRankQuery->rank = (int)$CreatorRank;

        $CreatorRankQuery->save();

        
        return (int)$CreatorRank;

    }

    public function getRankDetails($CreatorId){

        $CreatorRankQuery = CreatorRank::where('creator_id',$CreatorId)->first();

        $CreatorCurrentStat = $CreatorRankQuery->no_of_questions % 40;

        return $CreatorCurrentStat;
        
    }

    
}
