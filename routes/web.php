<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PastpaperController;
use App\Http\Controllers\ShareWidgetController;
use Symfony\Component\Console\Question\Question;

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

Route::resource('chirps', ChirpController::class)
    ->only(['index','store'])
    ->middleware(['auth','verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/CreatorHomepage', [PastpaperController::class, 'getCreatorHomepage']);

Route::get('/QuestionCreation',[PastpaperController::class,'validateHomepageRequest']);

Route::post('/QuestionStore',[PastpaperController::class,'validateAndStoreQuestions']);

//Route::post('/QuestionCreation',[PastpaperController::class,'store']);

Route::get('/StudentHomepage',function(){
    return view('StudentHomepage');
});

Route::get('/Question',[QuestionController::class,'showit']);

Route::get('/PaperDetails',function(){
    return view('PaperDetails');
});

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






require __DIR__.'/auth.php';
