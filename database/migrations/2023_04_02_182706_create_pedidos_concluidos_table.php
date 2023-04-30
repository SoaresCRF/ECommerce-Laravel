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
        Schema::create('pedidos_concluidos', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11);
            $table->smallInteger('cod_produto')->unsigned();
            $table->string('nome_produto', 50);
            $table->string('fornecedor', 50);
            $table->smallInteger('qtd_comprada')->unsigned();
            $table->decimal('total_comprado')->unsigned();
            $table->date('data_compra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_concluidos');
    }
};
