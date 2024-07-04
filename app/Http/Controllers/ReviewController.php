<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use App\Models\Sh_Answer;
use Illuminate\View\View;
use App\Models\Sh_Question;
use App\Models\Mcq_Question;
use App\Models\UserQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function reviewque(Request $request)
    {
        $request->flash();

        $useranswers = request('answers');

        $finalids = request('finalids');
        $questions = Mcq_Question::whereIn('mcq_questions_id', $finalids)
            ->get();

         //taking the reference ID's of mcq questions
         $qreferenceid=  Mcq_Question::whereIn('mcq_questions_id', $finalids)
         ->get('referenceid');

         //taking the reference for matching reference ID's
         $qreference= Reference::whereIn('R_id',$qreferenceid)
         ->get()->toArray();

         $referenceArray = [];

        $answers = DB::table('mcq_answers')
            ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
            ->select("mcq_answers.description","reference")
            ->whereIn('mcq_answers.question_id', $finalids)
            ->get();

         //getting answer reference ID's
         foreach ($answers as $answer) {
            $reference = $answer->reference;
            $referenceArray[] = $reference;
        }
        //querying answer reference objects as an array
        $answerreference= Reference::whereIn('R_id',$referenceArray)
        ->get()->toArray();

        //return $questions; // Return selected questions
        $request->session()->put('review_completed', true);
        return view('Review', compact('questions', 'answers', 'useranswers','qreference','answerreference'));
    }
    

    public function sreview(Request $request)
    {
        //dd($request);
        $request->flash();
        $finalids = request('finalids');
        $questions = Sh_Question::whereIn('sh_questions_id', $finalids)
            ->get();
        
            $qreferenceid= Sh_Question::whereIn('sh_questions_id', $finalids)
            ->get('q_referenceid');

            $qreference= Reference::whereIn('R_id',$qreferenceid)
            ->get()->toArray();
        //return $questions; // Return selected questions
        $request->session()->put('review_completed', true);
        return view('sreview', compact('questions','qreference'));
    }

    public function showit(Request $request): View
    {
        dd($request);

        //$questions = Mcq_Question::take(10)->pluck('description');
        $questions = Mcq_Question::paginate(1, '*', 'page');

        $questionId = $questions->first()->mcq_questions_id;

        $answers = DB::table('mcq_answers')
            ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
            ->select("mcq_answers.description")
            ->where('mcq_answers.question_id', $questionId)
            ->get();

        $selectedValues = $request->input('selectedValues');

        //  dd($answers);


        return view('Question', compact('questions', 'answers', 'selectedValues'));
    }

    public static function getCorrectAnswer($request)
    {
        $apiKey = config('services.my_service.api_key');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'api-key' => $apiKey, // Replace 'YOUR_API_KEY' with your actual API key
        ])->post('https://ansak.openai.azure.com/openai/deployments/gptt/completions?api-version=2023-09-15-preview', [
            "prompt" => "{$request} explain briefly in two lines",
            "max_tokens" => 150,
            "temperature" => 0.2,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            "top_p" => 0.5,
            "best_of" => 1,
            "stop" => null,
        ])->json();
        Log::info('API Response: ' . json_encode($response));
        $correctAnswer = $response['choices'][0]['text'] ?? 'No answer available';
        return $correctAnswer;
    }

    public function attemptQuestion(Request $request)
{
    try {
        $validatedData = $request->validate([
            'question_id' => 'required|integer',
            'is_correct' => 'required|boolean',
        ]);

        // Perform the update or create operation
        $userQuestion = UserQuestion::updateOrCreate(
            ['user_id' => auth()->id(), 'question_id' => $validatedData['question_id']],
            ['final_answer_status' => $validatedData['is_correct']]
        );

        return response()->json([
            'status' => 'success',
            'data' => $userQuestion
        ]);
    } catch (\Exception $e) {
        // Log the exception message
        Log::error('Attempt Question Error: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while attempting the question.'
        ], 500);
    }
}
public static function getEmbedding($parameter)
{
    // Replace these with your actual values
    
    
    $apiVersion = '2024-05-01-preview';  // Replace with the desired API version
    $apiKey = config('services.my_service.api_key');
    
    // Construct the endpoint URL
    $endpoint = "https://ansak.openai.azure.com/openai/deployments/embeding/embeddings?api-version={$apiVersion}";

    // Prepare headers
    $headers = [
        'Content-Type' => 'application/json',
        'api-key' => $apiKey,
    ];
    
    // Prepare payload
    $payload = [
        "input" => $parameter
    ];

    // Make the POST request
    $response = Http::withHeaders($headers)->post($endpoint, $payload)->json();

    // Log the response for debugging purposes
    Log::info('API Response: ' . json_encode($response));

    // Extract the embedding from the response
    if (isset($response['data'][0]['embedding'])) {
        $embedding = $response['data'][0]['embedding'];
    } else {
        $embedding = [];
    }
    
    return $embedding;
}

public static function getAnswerSimilarity($studentAnswer, $correctAnswer)
{
    // Get embeddings for both answers
    $studentEmbedding = self::getEmbedding($studentAnswer);
    $correctEmbedding = self::getEmbedding($correctAnswer);

    // Ensure embeddings are not empty
    if (empty($studentEmbedding) || empty($correctEmbedding)) {
        Log::error('One or both embeddings are empty.');
        return 0;
    }

    // Calculate similarity
    $similarity = self::calculateSimilarity($studentEmbedding, $correctEmbedding);

    return $similarity * 100; // Return similarity as a percentage
}

public static function calculateSimilarity($embedding1, $embedding2)
{
    $dotProduct = array_sum(array_map(function ($a, $b) {
        return $a * $b;
    }, $embedding1, $embedding2));

    $magnitude1 = sqrt(array_sum(array_map(function ($a) {
        return $a * $a;
    }, $embedding1)));

    $magnitude2 = sqrt(array_sum(array_map(function ($a) {
        return $a * $a;
    }, $embedding2)));

    if ($magnitude1 * $magnitude2 == 0) {
        return 0;
    } else {
        return $dotProduct / ($magnitude1 * $magnitude2);
    }


}
}