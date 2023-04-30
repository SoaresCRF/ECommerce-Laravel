<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleVenda extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'controle_venda';
    protected $fillable = ['cod_produto', 'nome_produto', 'fornecedor', 'valor_venda', 'qtd_comprada', 'total_venda', 'data_venda'];
}
