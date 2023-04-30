<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Classes\VerificacaoGeral;
use App\Http\Requests\CadastroFuncionarioRequest;

class FuncionarioController extends Controller
{
    public function viewIndex()
    {
        // Verifica se já existe sessão
        if (session('cargo') == 'dono' or session('cargo') == 'gerente') {
            return redirect()->route('adminvisualizarprodutos');
        } elseif (session('cargo') == 'cliente') {
            return redirect()->back();
        }

        return view('index');
    }
    public function formLogin(Request $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPost($request)) {
            $this->logout();
        }

        // Pega o usuário informado
        $usuario = $request->usuario;

        // Consulta no banco de dados o usuário informado
        $rowTableFuncionario = Funcionario::where('usuario', $usuario)->first();

        // Verifica se o não usuario existe ou a senha está incorreta
        if (!$rowTableFuncionario or $request->senha != $rowTableFuncionario->senha) {
            session()->flash('erroUsuario', 'Usuario ou senha incorretos');
            return redirect()->route('index');
        }

        // Verifica se o usuario está desativado
        if (!$rowTableFuncionario->ativo) {
            session()->flash('erroUsuario', 'Usuario está desativado');
            return redirect()->route('index');
        }

        // Cria a sessão para dono ou gerente
        if ($rowTableFuncionario->cargo == 'dono') {
            session()->put('cargo', 'dono');
        } else {
            session()->put('cargo', 'gerente');
        }
        return redirect()->route('adminvisualizarprodutos');
    }

    public function logout()
    {
        session()->forget('cargo');
        return redirect()->route('index');
    }

    public function viewVisualizarFuncionarios()
    {
        return view('admin/visualizarfuncionarios', ['funcionarios' => Funcionario::all()]);
    }

    public function viewCadastrarFuncionario()
    {
        return view('admin/cadastrarfuncionario');
    }
    public function formCadastrarFuncionario(CadastroFuncionarioRequest $request)
    {
        // Verifica se houve submissão de formulário
        if (!VerificacaoGeral::submissaoFormularioIsMethodPost($request)) {
            $this->logout();
        }

        // Inserindo no banco de dados
        Funcionario::create($request->all());

        session()->flash('funcionarioCadastrado', 'Funcionário cadastrado com sucesso');

        return redirect()->route('admincadastrarfuncionario');
    }

    public function formStatusFuncionario($id)
    {
        if (!$funcionario = Funcionario::find($id)) {
            session()->flash('funcionarioNaoEncontrado', 'Funcionário não encontrado');
            return redirect()->route('adminvisualizarfuncionarios');
        }

        if ($funcionario->ativo) {
            $funcionario->ativo = 0;
            session()->flash('acaoSucesso', 'Funcionário desativado');
        } else {
            $funcionario->ativo = 1;
            session()->flash('acaoSucesso', 'Funcionário ativado');
        }

        $funcionario->update();
        return redirect()->route('adminvisualizarfuncionarios');
    }

    public function formDeletarFuncionario($id)
    {
        if (!$funcionario = Funcionario::find($id)) {
            session()->flash('funcionarioNaoEncontrado', 'Funcionário não encontrado');
            return redirect()->route('adminvisualizarfuncionarios');
        }

        $funcionario->delete();

        session()->flash('acaoSucesso', 'Funcionário apagado com sucesso');
        return redirect()->route('adminvisualizarfuncionarios');
    }
}
