<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\PastpaperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Models\Moderator; //add the model for the moderators
use App\Models\Paper_creator; //add the model for the paper creators
use Illuminate\Support\Facades\Validator; //add the validator
use App\Models\User; //add the model for the users

//use App\Http\Controllers\ModeratorsController; //add the controller for the moderators, alt method

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

//route to the user details page
Route::get('/userDetails', function () {
   $users=DB::table('users')->get();
   
   return view('userDetails', ['users'=>$users]);
});

//route to the admin homepage
Route::get('/adminHomepage', function () {
    return view('adminHomepage');
});

//route to the published papers
Route::get('/publishedPapers', function () {
    return view('publishedPapers');
});


//route to adding paper creators
Route::get('/addCreator', function () {
    return view('addCreator');
});

//route to editing profile
Route::get('/editProfile', function () {
    return view('editProfile');
});



//route to save data into the database (paper creators)
Route::post('datasend',function(){
    $validate_data = Validator::make(request()->all(), [
        'first_name' => 'required|string|max:20',
        'last_name' => 'required|string|max:20',
        'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
        'password' => 'required',
        'workplace' => 'required',
        'position' => 'required'
    ])->validated();

    Paper_creator::create([
        'first_name' => $validate_data['first_name'],
        'last_name' => $validate_data['last_name'],
        'email' => $validate_data['email'],
        'password' => $validate_data['password'],
        'workplace' => $validate_data['workplace'],
        'position' => $validate_data['position']
        
    ]);
    return redirect('/addCreator');
    
});



//route to adding moderators
Route::get('/addMod', function () {
    return view('addMod');
});



//route to validate and save data into the database (moderators--user)
Route::post('datasubmit',function(){
    $validate_data = Validator::make(request()->all(), [
        'name' => 'required|string|max:30',
        'phone' => 'required|numeric|digits:10',
        'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
        'password' => 'required',
        'workplace' => 'required',
        'position' => 'required',
        'type' => 'required'
        
    ])->validated();

    User::create([
        'name' => $validate_data['name'],
        'phone' => $validate_data['phone'],
        'email' => $validate_data['email'],
        'password' => $validate_data['password'],
        'workplace' => $validate_data['workplace'],
        'position' => $validate_data['position'],
        'type' => $validate_data['type']
    ]);
    return redirect('/addMod');
    
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




require __DIR__.'/auth.php';
