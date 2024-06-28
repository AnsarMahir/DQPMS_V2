<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TitleCase implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        $words = explode(' ', $value);

        foreach ($words as $word) {
            
            $firstChar = substr($word, 0, 1);
            
            
            if (!ctype_upper($firstChar)) {
                $fail('Each word in the paper title must start with a capital letter.');
                return;
            }
        }
    }
}
