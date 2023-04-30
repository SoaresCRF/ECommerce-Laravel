<?php

namespace App\Http\Controllers;

use App\Models\ControleVenda;
use Illuminate\Support\Facades\DB;

class ControleVendaController extends Controller
{
    // Views gráfico
    public function viewTopDia()
    {
        $produtoTopDia = DB::select('SELECT nome_produto, sum(qtd_comprada) as qtdComprada, fornecedor from controle_venda where data_venda = CURDATE() group by nome_produto, fornecedor order by qtd_comprada desc');

        return view('admin/fastTopDia', ['produtoTopDia' => $produtoTopDia]);
    }

    public function viewTopMes()
    {
        $produtoTopMes = DB::select('SELECT nome_produto, sum(qtd_comprada) as qtdComprada, fornecedor from controle_venda where month(data_venda) = month(now()) and year(data_venda) = year(now())group by nome_produto, fornecedor order by qtd_comprada desc');

        return view('admin/fastTopMes', ['produtoTopMes' => $produtoTopMes]);
    }

    public function viewTopGeral()
    {
        $produtoTopGeral = DB::select('SELECT nome_produto, sum(qtd_comprada) as qtdComprada, fornecedor from controle_venda group by nome_produto, fornecedor order by qtd_comprada desc');

        return view('admin/fastTopGeral', ['produtoTopGeral' => $produtoTopGeral]);
    }

    // Views relatório completo
    public function viewRelatorioDia()
    {
        $produtoTopDia = DB::select('SELECT nome_produto, fornecedor, sum(qtd_comprada) as qtdComprada, sum(total_venda) as totalVenda from controle_venda where data_venda = CURDATE() group by nome_produto, fornecedor order by qtd_comprada desc');

        return view('admin/fullTopDia', ['produtoTopDia' => $produtoTopDia]);
    }

    public function viewRelatorioMes()
    {
        $produtoTopMes = DB::select('SELECT nome_produto, fornecedor, sum(qtd_comprada) as qtdComprada, sum(total_venda) as totalVenda from controle_venda where month(data_venda) = month(now()) and year(data_venda) = year(now()) group by nome_produto, fornecedor order by qtd_comprada desc');

        return view('admin/fullTopMes', ['produtoTopMes' => $produtoTopMes]);
    }

    public function viewRelatorioGeral()
    {
        $produtoTopGeral = DB::select('SELECT nome_produto, fornecedor, sum(qtd_comprada) as qtdComprada, sum(total_venda) as totalVenda from controle_venda group by nome_produto, fornecedor order by qtd_comprada desc');

        return view('admin/fullTopGeral', ['produtoTopGeral' => $produtoTopGeral]);
    }
}
