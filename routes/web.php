<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Exam;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ModeratorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PieChartController;
use App\Http\Controllers\LeaderboardController;

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
Route::get('/admin/dashboard', [Exam::class, 'showDashboard'])->name('admin.dashboard');
Route::get('/exam/dashboard', [Exam::class, 'examDashboard'])->name('exam.dashboard');





//fullcalender
Route::get('/getevent', [App\Http\Controllers\Exam::class, 'getEvent'])->name('getevent');

Route::post('createevent', [Exam::class, 'createEvent'])->name('exam.createEvent');
//Route::get('/getevent', 'App\Http\Controllers\Exam@getEvent')->name('getevent');

//discussion
Route::get('/discussion/create', [PostController::class, 'create'])->name('discussion.create');
Route::post('/discussion/store', [PostController::class, 'store'])->name('discussion.store');

//Route::get('/comment', [PostController::class, 'index'])->name('comment');
Route::get('/forum', [PostController::class, 'index'])->name('forum');

//moderator role
Route::get('/moderator/home', [ModeratorController::class, 'home'])->name('moderator.home');
Route::get('moderator/moderatepapers',[ModeratorController::class, 'getSubmittedPapers'])->name('moderator.papers');

Route::get('/view-paper/{id}/{paperType}', [ModeratorController::class, 'viewpaper'])->name('moderator.wholepaper');
Route::get('/moderate/{id}/{type}', [ModeratorController::class, 'viewPaper'])->name('moderate.paper1');



Route::post('/resavedraft',[ModeratorController::class,'resavedraft'])->name('resavedraft');
//validate and store
Route::post('/QuestionStore',[ModeratorController::class,'validateAndStoreQuestions']);

//published papers
Route::get('/moderator/publishedpapers',[ModeratorController::class, 'getPublishedPapers'])->name('published.papers');



//for chart
Route::get('/moderator-data', [ChartController::class, 'getModeratorData']);
Route::get('/moddashboard', function () {
    return view('moderator.moderator_dashboard');
})->name('analysis');

//for pie chat
// Route to serve the pie chart dashboard view
//Route::get('/pie-chart', [PieChartController::class, 'index'])->middleware('auth')->name('pie-chart');

// Route to get MCQ data for the pie chart
Route::get('/moderator-mcq-data', [PieChartController::class, 'getModeratorMcqData'])->middleware('auth');

// Route to get Short Answer data for the pie chart
Route::get('/moderator-sh-data', [PieChartController::class, 'getModeratorShData'])->middleware('auth');

//seperate
Route::get('/mcq-chart', [PieChartController::class, 'mcqChart'])->name('mcq.chart');
Route::get('/short-answer-chart', [PieChartController::class, 'shortAnswerChart'])->name('short.answer.chart');


// routes/web.php
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
//final dashboard
Route::get('/moderator/dashboard', [PieChartController::class, 'dashboard'])->name('moderator.dashboard');
