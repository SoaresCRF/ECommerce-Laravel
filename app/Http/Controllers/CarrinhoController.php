<?php

namespace App\Http\Controllers;

use App\Classes\VerificacaoGeral;
use App\Models\Carrinho;
use App\Models\ClienteCadastrado;
use App\Models\ControleVenda;
use App\Models\PedidoConcluido;
use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function viewCheckout()
    {
        return view('client/checkout', [
            'cliente' => ClienteCadastrado::where('cpf', session('cpf'))->first()
        ]);
    }

    public function viewCarrinho()
    {
        return view('client/carrinho');
    }

    public function formCarrinho(Request $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPut($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clienteprodutos');
        }

        if (!$produtoCarrinho = Carrinho::find($request->id)) {
            session()->flash('produtoNaoEncontrado', 'Produto não encontrado');
            return redirect()->route('clientecarrinho');
        }

        $produto = Produto::find($produtoCarrinho->cod_produto);

        if ($request->diminuir == 'diminuir') {
            if ($produtoCarrinho->quantidade - 1 < 1) {
                return redirect()->route('clientecarrinho');
            }
            $produtoCarrinho->quantidade -= 1;
            $produtoCarrinho->total -= $produto->valor_venda;
        } else {
            if ($produtoCarrinho->quantidade + 1 > $produto->estoque) {
                return redirect()->route('clientecarrinho');
            }
            $produtoCarrinho->quantidade += 1;
            $produtoCarrinho->total += $produto->valor_venda;
        }

        $produtoCarrinho->update();

        return redirect()->route('clientecarrinho');
    }

    public function formCarrinhoDeletar(Request $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodDelete($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clienteprodutos');
        }

        if ($request->deletar == 'deletarTudo') {
            Carrinho::where('cpf', session('cpf'))->delete();
        } else {
            if (!$produtoCarrinho = Carrinho::find($request->id)) {
                session()->flash('produtoNaoEncontrado', 'Produto não encontrado');
                return redirect()->route('clientecarrinho');
            }
            $produtoCarrinho->delete();
        }

        return redirect()->route('clientecarrinho');
    }

    public function formAddCarrinho(Request $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPost($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clienteprodutos');
        }

        if (!$produto = Produto::find($request->cod_produto)) {
            session()->flash('produtoNaoEncontrado', 'Produto não encontrado');
            return redirect()->back();
        }

        if ($produtoCarrinho = Carrinho::where('cpf', session('cpf'))->where('cod_produto', $request->cod_produto)->first()) {
            if ($produtoCarrinho->quantidade + 1 > $produto->estoque) {
                session()->flash('estoqueAtingido');
                return redirect()->back();
            }
            $produtoCarrinho->quantidade += 1;
            $produtoCarrinho->total += $produto->valor_venda;
            $produtoCarrinho->update();
        } else {
            $data = [
                'cpf' => session('cpf'),
                'cod_produto' => $request->cod_produto,
                'quantidade' => 1,
                'total' => $produto->valor_venda
            ];
            Carrinho::create($data);
        }

        session()->flash('produtoAddCarrinho');

        return redirect()->back();
    }

    public function formCheckoutConcluirCompra(Request $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPost($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clienteprodutos');
        }

        $index = 0;
        foreach ($request->produtosIds as $id) {
            $produto = Produto::find($id);

            // Altera no controle de venda
            if ($compraRealizadaHoje = ControleVenda::whereDate('data_venda', date('Ymd'))->where('cod_produto', $id)->where('cpf', session('cpf'))->first()) {
                $compraRealizadaHoje->qtd_comprada +=  $request->qtd[$index];
                $compraRealizadaHoje->total_venda += ($produto->valor_venda * $request->qtd[$index]);
                $compraRealizadaHoje->update();
            } else {
                $dataControleVenda = [
                    'cod_produto' => $produto->id,
                    'cpf' => session('cpf'),
                    'nome_produto' => $produto->nome_produto,
                    'fornecedor' => $produto->fornecedor,
                    'valor_venda' => $produto->valor_venda,
                    'qtd_comprada' => $request->qtd[$index],
                    'total_venda' => $request->qtd[$index] * $produto->valor_venda,
                    'data_venda' => NOW()
                ];
                ControleVenda::create($dataControleVenda);
            }

            // Verifica se o cliente já realizou a compra deste produto
            if ($compraExiste = PedidoConcluido::where('cpf', session('cpf'))->where('cod_produto', $id)->first()) {
                $compraExiste->qtd_comprada += $request->qtd[$index];
                $compraExiste->total_comprado += ($request->qtd[$index] * $produto->valor_venda);
                $compraExiste->data_compra = NOW();
                $compraExiste->update();
            } else {
                $dataPedidoConcluido = [
                    'cpf' => session('cpf'),
                    'cod_produto' => $produto->id,
                    'nome_produto' => $produto->nome_produto,
                    'fornecedor' => $produto->fornecedor,
                    'qtd_comprada' => $request->qtd[$index],
                    'total_comprado' => $request->qtd[$index] * $produto->valor_venda,
                    'data_compra' => NOW(),
                ];
                PedidoConcluido::create($dataPedidoConcluido);
            }

            // Atualiza estoque do produto
            $produto->estoque -= $request->qtd[$index];
            $produto->update();

            // Deleta o item do carrinho
            Carrinho::where('cpf', session('cpf'))->where('cod_produto', $produto->id)->delete();

            $index++;
        }

        session()->flash('compraRealizada');

        return redirect()->route('clientecheckout');
    }
}
