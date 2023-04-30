<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroFuncionarioRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'usuario' => ['required', 'regex:/^[a-z0-9]+[a-z_]+[_]?[a-z0-9]$/', 'unique:funcionarios', 'min:4', 'max:20'],
            'senha' => ['required', 'min:4', 'max:4'],
            'cargo' => ['required', 'max:7', 'regex:/(dono|gerente)/'],
        ];
    }
}
