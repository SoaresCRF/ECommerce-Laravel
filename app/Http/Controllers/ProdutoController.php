<?php

namespace App\Http\Controllers;

use App\Classes\TratamentoString;
use App\Classes\VerificacaoGeral;
use App\Http\Requests\CadastroProdutoRequest;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function viewVisualizarProdutos()
    {
        return view('admin/visualizarprodutos', ['produtos' => Produto::all()]);
    }

    public function viewCadastrarProduto()
    {
        return view('admin/cadastrarproduto');
    }
    public function formCadastrarProduto(CadastroProdutoRequest $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPost($request)) {
            session()->forget('cargo');
            return redirect()->route('index');
        }

        // Inserindo no bando de dados
        $data = $request->all();
        $data['nome_produto'] = TratamentoString::removerEspacosDuplicados($request->nome_produto);
        $data['fornecedor'] = TratamentoString::removerEspacosDuplicados($request->fornecedor);
        $data['valor_venda'] = $request->custo_produto * 2;
        $data['data_cadastro'] = now();
        Produto::create($data);

        session()->flash('acaoSucesso', 'Produto cadastrado com sucesso');

        return redirect()->route('admincadastrarproduto');
    }

    public function viewEditarProduto(Request $request)
    {
        if (!$produto = Produto::find($request->id)) {
            session()->flash('produtoNaoEncontrado', 'Produto não encontrado');
            return redirect()->route('adminvisualizarprodutos');
        }

        return view('admin/editarProduto', ['produto' => $produto]);
    }
    public function formEditarProduto(CadastroProdutoRequest $request)
    {
        if (!VerificacaoGeral::submissaoFormularioIsMethodPut($request)) {
            $this->logout();
        }

        if (!$produto = Produto::find($request->id)) {
            session()->flash('produtoNaoEncontrado', 'Produto não encontrado');
            return redirect()->route('adminvisualizarprodutos');
        }

        if ($produto->estoque + $request->estoque > 65535) {
            session()->flash('estoqueMaximoUltrapassado', 'Estoque máximo de 65535 itens ultrapassado');
            return redirect()->route('admineditarproduto', $request->id);
        }

        $data = $request->all();
        $data['valor_venda'] = $request->custo_produto * 2;
        $data['estoque'] = $produto->estoque + $request->estoque;
        $produto->update($data);

        session()->flash('acaoSucesso', 'Produto editado com sucesso');
        return redirect()->route('adminvisualizarprodutos');
    }

    public function formDeletarProduto($id)
    {
        if (!$produto = Produto::find($id)) {
            session()->flash('produtoNaoEncontrado', 'Produto não encontrado');
            return redirect()->route('adminvisualizarprodutos');
        }

        $produto->delete();

        session()->flash('acaoSucesso', 'Produto apagado com sucesso');
        return redirect()->route('adminvisualizarprodutos');
    }

    // Views produtos
    public function viewProdutos()
    {
        return view('client/produtos', [
            'allProdutos' => DB::select("SELECT * FROM produtos ORDER BY nome_produto, fornecedor")
        ]);
    }
    public function viewAlimento()
    {
        return view('client/alimento', [
            'produtosAlimentos' => DB::select("SELECT * FROM produtos WHERE categoria = 'alimento' ORDER BY nome_produto, fornecedor")
        ]);
    }
    public function viewBebida()
    {
        return view('client/bebida', [
            'produtosBebidas' => DB::select("SELECT * FROM produtos WHERE categoria = 'bebida' ORDER BY nome_produto, fornecedor")
        ]);
    }
    public function viewCelular()
    {
        return view('client/celular', [
            'produtosCelulares' => DB::select("SELECT * FROM produtos WHERE categoria = 'celular' ORDER BY nome_produto, fornecedor")
        ]);
    }
    public function viewHardware()
    {
        return view('client/hardware', [
            'produtosHardwares' => DB::select("SELECT * FROM produtos WHERE categoria = 'hardware' ORDER BY nome_produto, fornecedor")
        ]);
    }
    public function viewJogo()
    {
        return view('client/jogo', [
            'produtosJogos' => DB::select("SELECT * FROM produtos WHERE categoria = 'jogo' ORDER BY nome_produto, fornecedor")
        ]);
    }
}
