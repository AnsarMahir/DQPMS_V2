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

Route::get('/CreatorHomepage',function(){
    return view('CreatorHomepage');
});

Route::get('/Rank', [RankController::class,'generateBadge']);

Route::get('/questioncheck',function(){
    return view('questioncheck');
});

Route::get('/QuestionCreation',[PastpaperController::class,'validateHomepageRequest']);

Route::post('/QuestionStore',[PastpaperController::class,'validateAndStoreQuestions']);

//Route::post('/QuestionCreation',[PastpaperController::class,'store']);

Route::get('/Student',[PastpaperController::class,'showForm']
)
->middleware(['auth','verified'])
->name('student');

Route::POST('/Question',[QuestionController::class,'fetch'])
->middleware(['auth','verified']);

Route::get('/PaperDetails',function(){
     return view('PaperDetails');
})
 ->middleware(['auth','verified']);

Route::get('/Draftpapers',function(){
    return view('DraftPaperPage');
});

Route::post('/problems',[PastpaperController::class,'draft'])->name('problems');



Route::post('/process-form', [ProfileController::class, 'processForm']);
Route::post('/attempt-paper', [QuestionController::class, 'attemptPaper']);

Route::POST('/Review',[ReviewController::class, 'reviewque']);
Route::POST('/sreview',[ReviewController::class, 'sreview']);
Route::POST('/shortanswer',[QuestionController::class,'fetch'])->name('shortanswer');

Route::get('get-languages', [PastpaperController::class, 'getLanguages'])->name('get.languages');
Route::get('/gptanswer', Gptanswer::class);

Route::get('/ai',function(){
    $apiKey = config('services.my_service.api_key');
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'api-key' => $apiKey, // Replace 'YOUR_API_KEY' with your actual API key
    ])->post('https://ansak.openai.azure.com/openai/deployments/gptt/completions?api-version=2023-09-15-preview', [
        "prompt" => "Who is the president of Sri Lanka?",
        "max_tokens" => 50,
        "temperature" => 0.2,
        "frequency_penalty" => 0,
        "presence_penalty" => 0,
        "top_p" => 0.5,
        "best_of" => 1,
        "stop" => null,
    ])->json();
    dd($response);
});
Route::post('/get-correct-answer', 'ReviewController@getCorrectAnswer');
Route::get('/badge/{id}', [RankController::class, 'showBadge'])->name('badge.show');

Route::post('/generate-badge', [RankController::class, 'generateBadge'])->name('generatebadge');

Route::get('/ansak', function () {
    $image = Image::read('level1.jpg');
});
require __DIR__.'/auth.php';
