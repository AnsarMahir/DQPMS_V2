<div wire:init="loadCorrectAnswer">
    @if($correctAnswer)
        <span class="text-bold">
            {{ $correctAnswer }}
        </span>
    @endif
</div>
