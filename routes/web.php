<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\PastpaperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
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

Route::get('/CreatorHomepage',function(){
    return view('CreatorHomepage');
});

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

Route::get('/Draftpapers',function(){
    return view('DraftPaperPage');
});

Route::post('/problems',[PastpaperController::class,'draft'])->name('problems');






require __DIR__.'/auth.php';
