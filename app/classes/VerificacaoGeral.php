<?php

namespace App\Classes;

use Illuminate\Http\Request;

class VerificacaoGeral
{
    static public function sessionHasCargo()
    {
        return session()->has('cargo');
    }

    static public function sessionCargoIsDono()
    {
        return session()->get('cargo') == 'dono';
    }

    static public function sessionCargoIsGerente()
    {
        return session()->get('cargo') == 'gerente';
    }

    static public function sessionCargoIsCliente()
    {
        return session()->get('cargo') == 'cliente';
    }

    static public function sessionCargoIsVisitante()
    {
        return session()->get('cargo') == 'visitante';
    }

    static public function submissaoFormularioIsMethodPost(Request $request)
    {
        return $request->isMethod('post');
    }

    static public function submissaoFormularioIsMethodPut(Request $request)
    {
        return $request->isMethod('put');
    }

    static public function submissaoFormularioIsMethodDelete(Request $request)
    {
        return $request->isMethod('delete');
    }
}
