<?php

namespace App\Providers;

use App\Models\Carrinho;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['client.layouts.main', 'client.carrinho', 'client.checkout', 'client.alimento', 'client.bebida', 'client.celular', 'client.hardware', 'client.jogo', 'client.produtos', 'client.pedidos'], function ($view) {

            $qtdItemCarrinho = Carrinho::where('cpf', session('cpf'))->count('cpf');

            $view->with([
                'qtdItemCarrinho' => $qtdItemCarrinho,
            ]);
        });

        view()->composer(['client.layouts.main', 'client.alimento', 'client.bebida', 'client.celular', 'client.hardware', 'client.jogo', 'client.produtos'], function ($view) {

            $produtosMaisComprados = DB::select('SELECT cod_produto, nome_produto, fornecedor, SUM(qtd_comprada) FROM controle_venda GROUP BY nome_produto, cod_produto, fornecedor ORDER BY SUM(qtd_comprada) DESC LIMIT 5');

            $produtos = [];
            foreach ($produtosMaisComprados as $produto) {
                array_push($produtos, Produto::where('cod_produto', $produto->cod_produto)->first());
            }

            $categorias = DB::select('SELECT categoria, COUNT(categoria) AS qtdCategoria FROM produtos
            GROUP BY categoria');

            $view->with([
                'produtosMaisComprados' => $produtosMaisComprados,
                'categorias' => $categorias,
                'produtos' => $produtos,
            ]);
        });

        view()->composer(['client.carrinho', 'client.checkout'], function ($view) {
            // Pega os itens do carrinho do usuário logado
            $procutosCarrinho = Carrinho::where('cpf', session('cpf'))->get();

            // Pega os produtos, quantidade e id da linha do carrinho que veio do carrinho
            $produtos = [];
            $qtd = [];
            $id = [];

            foreach ($procutosCarrinho as $produto) {
                array_push($produtos, Produto::find($produto->cod_produto));
                array_push($qtd, $produto->quantidade);
                array_push($id, $produto->id);
            }

            $view->with([
                'produtos' => $produtos,
                'qtd' => $qtd,
                'id' => $id,
                'totalCarrinho' => Carrinho::where('cpf', session('cpf'))->sum('total'),
            ]);
        });
    }
}
