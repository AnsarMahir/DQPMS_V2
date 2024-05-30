<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Mcq_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Sh_Answer;
use App\Models\Sh_Question;
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

        $answers = DB::table('mcq_answers')
            ->join('mcq_questions', 'question_id', '=', 'mcq_questions_id')
            ->select("mcq_answers.description")
            ->whereIn('mcq_answers.question_id', $finalids)
            ->get();




        //return $questions; // Return selected questions
        $request->session()->put('review_completed', true);
        return view('Review', compact('questions', 'answers', 'useranswers'));
    }

    public function sreview(Request $request)
    {
        //dd($request);
        $request->flash();
        $finalids = request('finalids');
        $questions = Sh_Question::whereIn('sh_questions_id', $finalids)
            ->get();
        $answer=Sh_Answer::whereIn('question_id',$finalids)
            ->get();

        //return $questions; // Return selected questions
        $request->session()->put('review_completed', true);
        return view('sreview', compact('questions','answer'));
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
            "prompt" => "{{$request}} explain briefly",
            "max_tokens" => 100,
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
}
