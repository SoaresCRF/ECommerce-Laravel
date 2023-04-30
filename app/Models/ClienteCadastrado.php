<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteCadastrado extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'clientes_cadastrados';
    protected $fillable = ['nome_cliente', 'cpf', 'email', 'celular', 'sexo', 'cep', 'estado', 'cidade', 'bairro', 'rua', 'numero_casa', 'senha', 'data_cadastro'];
}
