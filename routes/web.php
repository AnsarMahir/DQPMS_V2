<?php
use App\Livewire\Gptanswer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RankController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PastpaperController;
use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\Console\Question\Question;
use App\Http\Controllers\ShareWidgetController;

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
});

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

Route::get('/PublishedPapers',[PastpaperController::class,'retrievePublished']);

Route::get('/PublishedPapers/{id}/{paperType}',[PastpaperController::class,'viewPublishedPaper']);

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
