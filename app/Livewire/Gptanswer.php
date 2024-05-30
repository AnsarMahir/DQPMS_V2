<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\ReviewController;

class Gptanswer extends Component
{
    public $description;
    public $correctAnswer;

    public function mount($description)
    {
        $this->description = $description;
    }

    public function loadCorrectAnswer()
    {
        if (!$this->correctAnswer) {
            $this->correctAnswer = ReviewController::getCorrectAnswer($this->description);
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="loader">
            
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.gptanswer');
    }
}
