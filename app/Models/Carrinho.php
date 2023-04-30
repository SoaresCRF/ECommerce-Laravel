<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'carrinho';
    protected $fillable = ['cpf', 'cod_produto', 'quantidade', 'total'];
}
