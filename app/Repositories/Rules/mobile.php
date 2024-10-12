<?php

namespace App\Rules;

use Closure;
use App\Models\Inscription;
use Illuminate\Contracts\Validation\ValidationRule;

class mobile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Vérifier si le numéro de téléphone existe dans la table "inscription"
        return Inscription::where('phone', $value)->exists();
        

    }
}
