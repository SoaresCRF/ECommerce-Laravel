<?php

namespace App\Rules;

use App\Models\Produto;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProdutoNomeFornecedor implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Produto::where('nome_produto', $value)->where('fornecedor', request()->get('fornecedor'))->count()) {
            $fail('Produto com este fornecedor já cadastrado');
        }
    }
}
