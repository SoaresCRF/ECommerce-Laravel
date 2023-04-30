<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoConcluido extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'pedidos_concluidos';
    protected $fillable = ['cpf', 'cod_produto', 'nome_produto', 'fornecedor', 'qtd_comprada', 'total_comprado', 'data_compra'];
}
