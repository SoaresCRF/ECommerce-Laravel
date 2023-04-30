<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'produtos';
    protected $fillable = ['cod_produto', 'nome_produto', 'fornecedor', 'custo_produto', 'valor_venda', 'estoque', 'categoria', 'data_cadastro'];
}
