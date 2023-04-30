<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes_cadastrados', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente', 100);
            $table->string('cpf', 11)->unique();
            $table->string('email', 100)->unique();
            $table->string('celular', 11);
            $table->string('sexo', 2);
            $table->string('cep', 8);
            $table->string('estado', 2);
            $table->string('cidade', 100);
            $table->string('bairro', 100);
            $table->string('rua', 100);
            $table->string('numero_casa', 9);
            $table->string('senha', 60);
            $table->date('data_cadastro');
            $table->string('cargo', 7)->default('cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes_cadastrados');
    }
};
