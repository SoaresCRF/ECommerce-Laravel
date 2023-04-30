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
        Schema::create('controle_venda', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('cod_produto')->unsigned();
            $table->string('cpf', 11);
            $table->string('nome_produto', 50);
            $table->string('fornecedor', 50);
            $table->decimal('valor_venda')->unsigned();
            $table->smallInteger('qtd_comprada')->unsigned();
            $table->decimal('total_venda')->unsigned();
            $table->date('data_venda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controle_venda');
    }
};
