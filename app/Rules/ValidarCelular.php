<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarCelular implements ValidationRule
{
    private function validarDDD(String $celular): bool
    {
        $ddds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 31, 32, 33, 34, 35, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48, 49, 51, 53, 54, 55, 61, 62, 64, 65, 66, 67, 68, 69, 71, 73, 74, 75, 77, 79, 81, 86, 87, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99];

        $ddd =  $celular[1] . $celular[2];
        return in_array($ddd, $ddds);
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->validarDDD($value)) {
            $fail('DDD inválido');
        }
    }
}
