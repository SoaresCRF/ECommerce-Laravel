<?php

namespace App\Http\Requests;

use App\Rules\ProdutoNomeFornecedor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CadastroProdutoRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->id ?? '';

        $rules = [
            'cod_produto' => ['required', 'numeric', Rule::unique('produtos', 'cod_produto')->ignore($id, 'id'), 'min:0', 'max:65535'],
            'nome_produto' => ['required', 'max:50', new ProdutoNomeFornecedor],
            'fornecedor' => ['required', 'max:50'],
            'custo_produto' => ['required', 'decimal:0,2', 'min:0.1'],
            'estoque' => ['required', 'numeric', 'min:0', 'max:65535'],
            'categoria' => ['required', 'regex:/(alimento|bebida|celular|hardware|jogo)/'],
        ];

        if ($this->method('PUT')) {
            $rules['nome_produto'] = ['nullable'];
            $rules['fornecedor'] = ['nullable'];
            $rules['estoque'] = ['nullable'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'custo_produto.decimal' => 'O campo custo produto deve ter de 0 a 2 casas decimais.',
        ];
    }
}
