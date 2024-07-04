<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SimilarityCalculator extends Component
{
    public $studentAnswer;
    public $correctAnswer;
    public $similarity;

    public function mount($studentAnswer, $correctAnswer)
    {
        $this->studentAnswer = $studentAnswer;
        $this->correctAnswer = $correctAnswer;
        $this->similarity = null; // Initialize similarity to null
    }

    public function calculateSimilarity()
    {
        $studentEmbedding = $this->getEmbedding($this->studentAnswer);
        $correctEmbedding = $this->getEmbedding($this->correctAnswer);

        if (empty($studentEmbedding) || empty($correctEmbedding)) {
            Log::error('One or both embeddings are empty.');
            $this->similarity = 0;
            return;
        }

        $this->similarity = $this->calculateCosineSimilarity($studentEmbedding, $correctEmbedding) * 100;
    }
    private function getEmbedding($parameter)
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

    private function calculateCosineSimilarity($embedding1, $embedding2)
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
    public function render()
    {
        return view('livewire.similarity-calculator');
    }
}
