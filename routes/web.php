<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQcontroller;
use App\Http\Controllers\TutorController;


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

Route::get('/QuestionCreation',function(){
    return view('QuestionCreation');
});

Route::get('/StudentHomepage',function(){
    return view('StudentHomepage');
});

Route::get('/Question',[QuestionController::class,'showit']);




require __DIR__.'/auth.php';

route::get('/FAQ/index',[FAQcontroller::class, 'index'])->name('FAQ.index');
route::get('/FAQ/index2',[FAQcontroller::class, 'index2'])->name('FAQ.index2');
route::post('/FAQ/store',[FAQcontroller::class,'store'])->name('FAQ.store');

Route::get('/TutorHomepage',function(){
    return view('Tutor.TutorHomepage');
});

Route::get('/TutorForm1',function(){
    return view('Tutor.TutorForm1');
});

route::get('/Tutor/TutorHomepage',[TutorController::class, 'TutorHomepage'])->name('Tutor.TutorHomepage');
route::get('/Tutor/TutorForm1',[TutorController::class, 'TutorForm1'])->name('Tutor.TutorForm1');
route::post('/Tutor/store',[TutorController::class,'store'])->name('Tutor.store');
