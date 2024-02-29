<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\PastpaperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

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

Route::post('/QuestionStore',[PastpaperController::class,'storeQuestions']);

//Route::post('/QuestionCreation',[PastpaperController::class,'store']);

Route::get('/Student',[PastpaperController::class,'showForm']
)
->middleware(['auth','verified']);


Route::GET('/Question',[QuestionController::class,'fetch'])
->middleware(['auth','verified']);

Route::get('/PaperDetails',function(){
    return view('PaperDetails');
})
->middleware(['auth','verified']);

Route::post('/process-form', [ProfileController::class, 'processForm']);
Route::post('/attempt-paper', [QuestionController::class, 'attemptPaper']);

Route::get('/Review',[QuestionController::class, 'reviewque']);

Route::get('get-languages', [PastpaperController::class, 'getLanguages'])->name('get.languages');
require __DIR__.'/auth.php';
