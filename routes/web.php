<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Exam;
use App\Http\Controllers\ModeratorController;



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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/exam/all', [Exam::class,'index'])->name('user');
Route::get('/exam/index', function() {
    return view('exam.index');
})->name('exam.index');

Route::post('/exam/store', [Exam::class, 'store'])->name('exam.store');





Route::get('/comment', [PostController::class, 'index'])->name('comment');

Route::get('/moderator/home', [ModeratorController::class, 'home'])->name('moderator.home');


