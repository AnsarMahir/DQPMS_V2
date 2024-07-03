<?php
use App\Livewire\Gptanswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RankController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PastpaperController;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Controllers\ShareWidgetController;
use Symfony\Component\Console\Question\Question;
use App\Models\User; //add the model for the users
use App\Models\Moderator; //add the model for the moderators
use Illuminate\Support\Facades\Validator; //add the validator
use App\Models\Paper_creator; //add the model for the paper creators

//use App\Http\Controllers\ModeratorsController; //add the controller for the moderators, alt method

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/attempt-question', [ReviewController::class, 'attemptQuestion'])->name('review.attemptQuestion');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

Route::get('/userDetails', function () {
    $users=DB::table('users')->get();
    
    return view('userDetails', ['users'=>$users]);
 });
 
 //route to the published papers
Route::get('/publishedPapers', function () {
    $pastpapers=DB::table('pastpaper')->get();
    return view('publishedPapers', ['pastpapers'=>$pastpapers]);
});

Route::get('/CreatorPublished',[PastpaperController::class,'retrievePublished']);

Route::get('/CreatorPublished/{id}/{paperType}',[PastpaperController::class,'viewPublishedPaper']);


 
 //route to the admin homepage
 Route::get('/adminHomepage', function () {
     return view('adminHomepage');
 });
 
 
 
 
 //route to adding paper creators
 Route::get('/addCreator', function () {
     return view('addCreator');
 });
 
 //route to editing profile
 Route::get('/editProfile', function () {
     return view('editProfile');
 });
 
 
 
 //route to save data into the database (paper creators)
 Route::post('datasend',function(){
     $validate_data = Validator::make(request()->all(), [
         'first_name' => 'required|string|max:20',
         'last_name' => 'required|string|max:20',
         'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
         'password' => 'required',
         'workplace' => 'required',
         'position' => 'required'
     ])->validated();
 
     Paper_creator::create([
         'first_name' => $validate_data['first_name'],
         'last_name' => $validate_data['last_name'],
         'email' => $validate_data['email'],
         'password' => $validate_data['password'],
         'workplace' => $validate_data['workplace'],
         'position' => $validate_data['position']
         
     ]);
     return redirect('/addCreator');
     
 });
 
 
 
 //route to adding moderators
 Route::get('/addMod', function () {
     return view('addMod');
 });
 
 
 
 //route to validate and save data into the database (moderators--user)
 Route::post('datasubmit',function(){
     $validate_data = Validator::make(request()->all(), [
         'name' => 'required|string|max:30',
         'phone' => 'required|numeric|digits:10',
         'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
         'password' => 'required',
         'workplace' => 'required',
         'position' => 'required',
         'type' => 'required'
         
     ])->validated();
 
     User::create([
         'name' => $validate_data['name'],
         'phone' => $validate_data['phone'],
         'email' => $validate_data['email'],
         'password' => $validate_data['password'],
         'workplace' => $validate_data['workplace'],
         'position' => $validate_data['position'],
         'type' => $validate_data['type'],
     ]);
     return redirect('/addMod');
     
 });
 
 
 
Route::get('/ai',[ReviewController::class,'getEmbedding']);

Route::get('/CreatorHomepage', [PastpaperController::class, 'getCreatorHomepage']);

Route::get('/Rank', [RankController::class,'generateBadge']);

Route::get('/questioncheck',function(){
    return view('questioncheck');
});

Route::get('/QuestionCreation',[PastpaperController::class,'validateHomepageRequest']);

Route::post('/QuestionStore',[PastpaperController::class,'validateAndStoreQuestions']);

//Route::post('/QuestionCreation',[PastpaperController::class,'store']);

Route::get('/Student',[PastpaperController::class,'showForm']
)
->middleware(['auth','verified','student'])
->name('student');

Route::POST('/Question',[QuestionController::class,'fetch'])
->middleware(['auth','verified']);

Route::get('/PaperDetails',function(){
     return view('PaperDetails');
})
 ->middleware(['auth','verified']);

Route::get('/Draftpapers',[PastpaperController::class,'retrieveDraft']);

Route::post('/savedraft',[PastpaperController::class,'savedraft'])->name('savedraft');

Route::post('/resavedraft',[PastpaperController::class,'resavedraft'])->name('resavedraft');

Route::get('/paper/{id}/{paperType}',[PastpaperController::class,'viewPaper']);

Route::get('/paper/{id}', [PastpaperController::class, 'deleteDraftPaper'])->name('deleteDraftPaper');

Route::get('/myProfile',function(){
    return view('Profile');
});

Route::get('/creatorRank', [ShareWidgetController::class,'getProfilePage']);

Route::get('/shareBadge/{appName}',[ShareWidgetController::class,'shareBadge']);

Route::view('/paperTitlePage','AddPaperTitle');

Route::post('/addPaperTitle',[PastpaperController::class,'addPaperTitle']);

Route::get('/getPaperTitle',[PastpaperController::class,'getPaperTitle'])->name('getPaperTitle');

Route::post('/deletePaperTitle/{id}',[PastpaperController::class,'deletePaperTitle'])->name('deletePaperTitle');


Route::post('/process-form', [ProfileController::class, 'processForm']);
Route::post('/attempt-paper', [QuestionController::class, 'attemptPaper']);

Route::POST('/Review',[ReviewController::class, 'reviewque']);
Route::POST('/sreview',[ReviewController::class, 'sreview']);
Route::POST('/shortanswer',[QuestionController::class,'fetch'])->name('shortanswer');

Route::get('get-languages', [PastpaperController::class, 'getLanguages'])->name('get.languages');
Route::get('/gptanswer', Gptanswer::class);
Route::get('/get-question-nature', [PastpaperController::class, 'getQuestionNature']);


Route::post('/get-correct-answer', 'ReviewController@getCorrectAnswer');
Route::get('/badge/{id}', [RankController::class, 'showBadge'])->name('badge.show');

Route::post('/generate-badge', [RankController::class, 'generateBadge'])->name('generatebadge');

Route::get('/ansak', function () {
    $image = Image::read('level1.jpg');
});

require __DIR__.'/auth.php';
