<?php

namespace App\Http\Requests;

use App\Rules\ValidarCPF;
use App\Rules\ValidarCelular;
use App\Rules\ValidarSenha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CadastroClienteRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->id ?? '';

        $rules = [
            'nome_cliente' => ['required', "regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", 'min:3', 'max:100'],
            'email' => ['required', 'email', Rule::unique('clientes_cadastrados', 'email')->ignore($id, 'id'), 'max:100'],
            'sexo' => ['required', 'min:1', 'max:2', "regex:/[(NI|M|F)]/"],
            'cpf' => ['required', new ValidarCPF, 'max:14', 'min:14'],
            'celular' => ['required', 'regex:/^\([1-9]{2}\)\s9\d{4}-\d{4}$/', new ValidarCelular, 'min:15', 'max:15'],
            'senha' => ['required', 'min:8', 'max:20', new ValidarSenha],
            'cep' => ['required', 'regex:/^\d{5}-\d{3}$/', 'min:9', 'max:9'],
            'estado' => ['required', 'min:2', 'max:2', 'regex:/(AC|AL|AP|AM|BA|CE|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO|DF)/'],
            'cidade' => ['required', "regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{1,}$/", 'min:1', 'max:100'],
            'bairro' => ['required', "regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{1,}$/", 'min:1', 'max:100'],
            'rua' => ['required', "regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{1,}$/", 'min:1', 'max:100'],
            'numero_casa' => ['required', 'numeric', 'min:0', 'max:999999999'],
        ];

        if ($this->method('PUT')) {
            $rules['nome_cliente'] = ['nullable'];
            $rules['sexo'] = ['nullable'];
            $rules['cpf'] = ['nullable'];
            $rules['senha'] = ['nullable'];
        }

        return $rules;
    }
}
