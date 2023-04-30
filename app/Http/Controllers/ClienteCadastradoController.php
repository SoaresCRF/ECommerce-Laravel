<?php

namespace App\Http\Controllers;

use App\Classes\TratamentoString;
use Illuminate\Http\Request;
use App\Classes\VerificacaoGeral;
use App\Http\Requests\CadastroClienteRequest;
use App\Models\Carrinho;
use App\Models\ClienteCadastrado;
use App\Models\PedidoConcluido;
use Illuminate\Support\Facades\Hash;

class ClienteCadastradoController extends Controller
{
    public function viewClienteEstado()
    {
        return view(
            'admin/clienteestado',
            [
                'clientes' => ClienteCadastrado::select(ClienteCadastrado::raw('estado, count(estado) as countEstado'))
                    ->groupBy('estado')
                    ->get()
            ]
        );
    }

    public function logout()
    {
        session()->forget(['nome_cliente', 'cpf', 'cargo']);
        return redirect()->back();
    }

    public function viewLogin()
    {
        if (VerificacaoGeral::sessionCargoIsCliente()) {
            return redirect()->back();
        }

        return view('client/login');
    }
    public function formLogin(Request $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPost($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clientelogin');
        }

        // Consulta no banco de dados o email informado
        $rowTableClienteCadastrado = ClienteCadastrado::where('email', $request->email)->first();

        // Verifica se o email não existe ou a senha está incorreta
        if (!$rowTableClienteCadastrado or !Hash::check($request->senha, $rowTableClienteCadastrado->senha)) {
            session()->flash('erroUsuario', 'Usuario ou senha incorretos');
            return redirect()->route('clientelogin');
        }

        // Cria a sessão cliente
        $primeiro_nome_cliente = explode(" ", $rowTableClienteCadastrado->nome_cliente)[0];

        session()->put([
            'nome_cliente' => $primeiro_nome_cliente,
            'cpf' => $rowTableClienteCadastrado->cpf,
            'cargo' => 'cliente',
        ]);

        return redirect()->route('clienteprodutos');
    }

    public function viewCadastro()
    {
        if (VerificacaoGeral::sessionCargoIsCliente()) {
            return redirect()->back();
        }
        return view('client/cadastro');
    }
    public function formCadastro(CadastroClienteRequest $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPost($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clientecadastro');
        }

        // Inserindo no bando de dados
        $data = $request->all();
        $data['nome_cliente'] = TratamentoString::removerEspacosDuplicados($request->nome_cliente);
        $data['cpf'] = TratamentoString::extrairNumero($request->cpf);
        $data['celular'] = TratamentoString::extrairNumero($request->celular);
        $data['cep'] = TratamentoString::extrairNumero($request->cep);
        $data['data_cadastro'] = now();
        $data['cargo'] = 'cliente';
        $data['senha'] = bcrypt($request->senha);
        ClienteCadastrado::create($data);

        // Cria a sessão cliente
        $primeiro_nome_cliente = explode(" ", $data['nome_cliente'])[0];
        session()->put([
            'nome_cliente' => $primeiro_nome_cliente,
            'cpf' => $data['cpf'],
            'cargo' => 'cliente',
        ]);

        return redirect()->route('clienteprodutos');
    }

    public function formCheckout(CadastroClienteRequest $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPut($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clienteprodutos');
        }

        // Pego cliente logado
        if (!$cliente = ClienteCadastrado::find($request->id)) {
            session()->flash('clienteNaoEncontrado', 'Cliente não encontrado');
            return redirect()->route('clientecheckout');
        }

        // Pegando dados do request
        $data = $request->all();
        $data['celular'] = TratamentoString::extrairNumero($request->celular);
        $data['cep'] = TratamentoString::extrairNumero($request->cep);
        $cliente->update($data);

        session()->flash('acaoSucesso', 'Dados atualizados com sucesso');

        return redirect()->route('clientecheckout');
    }

    public function viewPedidos()
    {
        $pedidos = PedidoConcluido::where('cpf', session('cpf'))->get();

        $totalComprado = PedidoConcluido::where('cpf', session('cpf'))->sum('total_comprado');

        $qtdComprada = PedidoConcluido::where('cpf', session('cpf'))->sum('qtd_comprada');

        return view('client/pedidos', [
            'pedidos' => $pedidos,
            'totalComprado' => $totalComprado,
            'qtdComprada' => $qtdComprada,
        ]);
    }

    public function formContaDeletar(Request $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodDelete($request)) {
            session()->forget(['nome_cliente', 'cpf', 'cargo']);
            return redirect()->route('clienteprodutos');
        }

        ClienteCadastrado::where('cpf', session('cpf'))->delete();
        Carrinho::where('cpf', session('cpf'))->delete();
        PedidoConcluido::where('cpf', session('cpf'))->delete();

        session()->forget(['nome_cliente', 'cpf', 'cargo']);

        session()->flash('contaDeletada', 'Conta deletada com sucesso!');

        return redirect()->route('clienteprodutos');
    }
}
