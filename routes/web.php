<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQcontroller;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\VideoController;


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

// Admin FAQ Management Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('FAQ', FAQcontroller::class);
});

Route::get('/FAQ', [FAQcontroller::class, 'publicIndex'])->name('FAQ.public_index');




Route::get('/TutorHomepage',function(){
    return view('Tutor.TutorHomepage');
});

Route::get('/TutorQuestion',[TutorController::class,'TutorForm1']);

Route::get('/AddQuestion',[TutorController::class,'TutorAddQuestionPage']);

Route::get('/TutorForm2',function(){
    return view('Tutor.TutorForm2');
});

Route::get('/UploadFile',function(){
    return view('Tutor.UploadFile');
});

Route::get('/UploadVideo',function(){
    return view('Tutor.UploadVideo');
});



//route::get('/Tutor/TutorHomepage',[TutorController::class, 'TutorHomepage'])->name('Tutor.TutorHomepage');
//route::get('/Tutor/TutorForm1',[TutorController::class, 'TutorForm1'])->name('Tutor.TutorForm1');
//route::post('/Tutor/store',[TutorController::class,'store'])->name('Tutor.store');

Route::get('file-upload', [FileController::class, 'showUploadForm'])->name('file.upload');
Route::post('file-upload', [FileController::class, 'uploadFile'])->name('file.upload.post');
Route::get('file-download/{filename}', [FileController::class, 'downloadFile'])->name('file.download');


Route::get('video-upload', [VideoController::class, 'showUploadForm'])->name('video.upload');
Route::post('video-upload', [VideoController::class, 'uploadVideo'])->name('video.upload.post');
Route::get('video-download/{filename}', [VideoController::class, 'downloadVideo'])->name('video.download');
