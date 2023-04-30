<?php

namespace App\Rules;

use App\Classes\TratamentoString;
use App\Models\ClienteCadastrado;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarCPF implements ValidationRule
{
    private function validarCPF(String $cpf): bool
    {
        // Extrai somente os números
        $cpf = TratamentoString::extrairNumero($cpf);

        // Verifica se foi informado onze dígitos e se foi informada uma sequência de dígitos repetidos. Ex: 111.111.111-11
        if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        $number_quantity_to_loop = [9, 10];

        foreach ($number_quantity_to_loop as $item) {

            $sum = 0;
            $number_to_multiplicate = $item + 1;

            for ($index = 0; $index < $item; $index++) {

                $sum += $cpf[$index] * ($number_to_multiplicate--);
            }

            $result = (($sum * 10) % 11);

            if ($cpf[$item] != $result) {
                return false;
            }
        }

        return true;
    }

    private function uniqueCPF(String $cpf): int
    {
        return ClienteCadastrado::where('cpf', TratamentoString::extrairNumero($cpf))->count();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->validarCPF($value)) {
            $fail('CPF inválido');
        }

        if ($this->uniqueCPF($value)) {
            $fail('CPF já cadastrado');
        }
    }
}
