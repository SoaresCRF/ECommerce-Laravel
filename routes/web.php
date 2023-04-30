<?php

use App\Http\Controllers\CarrinhoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteCadastradoController;
use App\Http\Controllers\ControleVendaController;

// Index
Route::get('/', [FuncionarioController::class, 'viewIndex'])->name('index');
Route::post('formlogin', [FuncionarioController::class, 'formLogin'])->name('formlogin');

// Rotas admin
Route::middleware('checksessionisadmin')->group(function () {
    Route::group([
        'prefix' => 'admin', // prefix é prefixo do get ou seja admin/cadastrarfuncionario fica só cadastrarfuncionario
        'as' => 'admin' //as é pro prefixo de rotas nomeadas
    ], function () {
        Route::get('logout', [FuncionarioController::class, 'logout'])->name('logout');
        // Produto
        Route::get('visualizarprodutos', [ProdutoController::class, 'viewVisualizarProdutos'])->name('visualizarprodutos');
    });
});

// Rotas dono
Route::middleware('checksessionisdono')->group(function () {
    Route::group([
        'prefix' => 'admin', // prefix é prefixo do get ou seja admin/cadastrarfuncionario fica só cadastrarfuncionario
        'as' => 'admin' //as é pro prefixo de rotas nomeadas
    ], function () {
        // Funcionário
        Route::get('visualizarfuncionarios', [FuncionarioController::class, 'viewVisualizarFuncionarios'])->name('visualizarfuncionarios');
        Route::get('cadastrarfuncionario', [FuncionarioController::class, 'viewCadastrarFuncionario'])->name('cadastrarfuncionario');
        Route::post('cadastrarfuncionario', [FuncionarioController::class, 'formCadastrarFuncionario'])->name('formcadastrarfuncionario');

        // Status funcionário
        Route::put('statusfuncionario/{id}', [FuncionarioController::class, 'formStatusFuncionario'])->name('formstatusfuncionario');

        // Deletar funcionário
        Route::delete('deletarfuncionario/{id}', [FuncionarioController::class, 'formDeletarFuncionario'])->name('formdeletarfuncionario');

        // Produto
        Route::get('cadastrarproduto', [ProdutoController::class, 'viewCadastrarProduto'])->name('cadastrarproduto');
        Route::post('cadastrarproduto', [ProdutoController::class, 'formCadastrarProduto'])->name('formcadastrarproduto');

        // Editar produto
        Route::get('editarproduto/{id}', [ProdutoController::class, 'viewEditarProduto'])->name('editarproduto');
        Route::put('editarproduto/{id}', [ProdutoController::class, 'formEditarProduto'])->name('formeditarproduto');

        // Deletar produto
        Route::delete('deletarproduto/{id}', [ProdutoController::class, 'formDeletarProduto'])->name('formdeletarproduto');

        // Gerenciamento de clientes
        Route::get('clienteestado', [ClienteCadastradoController::class, 'viewClienteEstado'])->name('clienteestado');

        // Gráfico vendas
        Route::get('topdia', [ControleVendaController::class, 'viewTopDia'])->name('topdia');
        Route::get('topmes', [ControleVendaController::class, 'viewTopMes'])->name('topmes');
        Route::get('topgeral', [ControleVendaController::class, 'viewTopGeral'])->name('topgeral');

        // Relatório venda
        Route::get('relatoriodia', [ControleVendaController::class, 'viewRelatorioDia'])->name('relatoriodia');
        Route::get('relatoriomes', [ControleVendaController::class, 'viewRelatorioMes'])->name('relatoriomes');
        Route::get('relatoriogeral', [ControleVendaController::class, 'viewRelatorioGeral'])->name('relatoriogeral');
    });
});



// Rotas visitante
Route::middleware('checksessionismembro')->group(function () {
    Route::group([
        'prefix' => 'cliente', // prefix é prefixo do get ou seja admin/cadastrarfuncionario fica só cadastrarfuncionario
        'as' => 'cliente' //as é pro prefixo de rotas nomeadas
    ], function () {
        Route::get('cadastro', [ClienteCadastradoController::class, 'viewCadastro'])->name('cadastro');
        Route::post('cadastro', [ClienteCadastradoController::class, 'formCadastro'])->name('formcadastro');

        Route::get('login', [ClienteCadastradoController::class, 'viewLogin'])->name('login');
        Route::post('login', [ClienteCadastradoController::class, 'formlogin'])->name('formlogin');

        // Views produtos
        Route::get('produtos', [ProdutoController::class, 'viewProdutos'])->name('produtos');
        Route::get('alimentos', [ProdutoController::class, 'viewAlimento'])->name('alimento');
        Route::get('bebidas', [ProdutoController::class, 'viewBebida'])->name('bebida');
        Route::get('celulares', [ProdutoController::class, 'viewCelular'])->name('celular');
        Route::get('hardware', [ProdutoController::class, 'viewHardware'])->name('hardware');
        Route::get('jogos', [ProdutoController::class, 'viewJogo'])->name('jogo');
    });
});

// Rotas cliente
Route::middleware('checksessioniscliente')->group(function () {
    Route::group([
        'prefix' => 'cliente', // prefix é prefixo do get ou seja admin/cadastrarfuncionario fica só cadastrarfuncionario
        'as' => 'cliente' //as é pro prefixo de rotas nomeadas
    ], function () {
        Route::get('logout', [ClienteCadastradoController::class, 'logout'])->name('logout');

        // Carrinho
        Route::get('carrinho', [CarrinhoController::class, 'viewCarrinho'])->name('carrinho');
        Route::post('carrinho', [CarrinhoController::class, 'formAddCarrinho'])->name('addcarrinho');
        Route::put('carrinho', [CarrinhoController::class, 'formCarrinho'])->name('formcarrinho');
        Route::delete('carrinho', [CarrinhoController::class, 'formCarrinhoDeletar'])->name('formcarrinhodeletar');

        // Checkout
        Route::get('checkout', [CarrinhoController::class, 'viewCheckout'])->name('checkout');
        Route::put('checkout', [ClienteCadastradoController::class, 'formCheckout'])->name('formcheckout');
        Route::post('checkout', [CarrinhoController::class, 'formCheckoutConcluirCompra'])->name('formcheckoutconcluircompra');

        // Pedidos concluídos
        Route::get('pedidos', [ClienteCadastradoController::class, 'viewPedidos'])->name('pedidos');

        // Deletar conta
        Route::delete('conta', [ClienteCadastradoController::class, 'formContaDeletar'])->name('formcontadeletar');
    });
});
