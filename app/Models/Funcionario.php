<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'funcionarios';
    protected $fillable = ['usuario', 'senha', 'cargo'];
}
