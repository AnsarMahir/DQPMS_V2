<div wire:init="calculateSimilarity">

    <label for="similarity" class="form-label">Similarity:</label>
    @if (is_null($similarity))
        <p>Loading...</p>
    @else
        <p><b>{{ number_format($similarity, 2) }}%</b></p>
    @endif
</div>
