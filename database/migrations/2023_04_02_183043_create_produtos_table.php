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
        //Schema::dropIfExists('produtos');

        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('cod_produto')->unsigned()->unique();
            $table->string('nome_produto', 50);
            $table->string('fornecedor', 50);
            $table->decimal('custo_produto')->unsigned();
            $table->decimal('valor_venda')->unsigned();
            $table->smallInteger('estoque')->unsigned();
            $table->date('data_cadastro');
            $table->string('categoria', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
