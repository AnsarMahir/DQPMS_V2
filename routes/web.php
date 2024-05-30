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

Route::view('/CreatorHomepage', 'CreatorHomepage');

Route::get('/questioncheck',function(){
    return view('questioncheck');
});

Route::get('/QuestionCreation',[PastpaperController::class,'validateHomepageRequest']);

Route::post('/QuestionStore',[PastpaperController::class,'validateAndStoreQuestions']);

//Route::post('/QuestionCreation',[PastpaperController::class,'store']);

Route::get('/Student',[PastpaperController::class,'showForm']
)
->middleware(['auth','verified']);


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

Route::get('/myProfile',function(){
    return view('Profile');
});

Route::get('/share', [ShareWidgetController::class,'ShareWidget']);

Route::post('/process-form', [ProfileController::class, 'processForm']);
Route::post('/attempt-paper', [QuestionController::class, 'attemptPaper']);

Route::POST('/Review',[QuestionController::class, 'reviewque']);

Route::get('get-languages', [PastpaperController::class, 'getLanguages'])->name('get.languages');
Route::post('/get-correct-answer', [QuestionController::class, 'getCorrectAnswer'])->name('get-correct-answer');
require __DIR__.'/auth.php';
