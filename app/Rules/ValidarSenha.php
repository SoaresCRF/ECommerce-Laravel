<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarSenha implements ValidationRule
{

    private function forcaSenha(String $senha): bool
    {
        $maiusculo     = preg_match('@[A-Z]@', $senha);
        $minusculo     = preg_match('@[a-z]@', $senha);
        $numero        = preg_match('@[0-9]@', $senha);
        $charsEspecial = preg_match('@[^\w]@', $senha);

        return $maiusculo and $minusculo and $numero and $charsEspecial;
    }

    private function senhasCorrespondem(String $senha)
    {
        return $senha == request()->get('confirma_senha');
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->forcaSenha($value)) {
            $fail('A senha deve incluir pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.');
        }

        if (!$this->senhasCorrespondem($value)) {
            $fail('Senhas não correspondem');
        }
    }
}
