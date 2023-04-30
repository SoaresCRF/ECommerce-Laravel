<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \App\Classes\VerificacaoGeral;

class CheckSessionIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!VerificacaoGeral::sessionHasCargo()) {
            return redirect()->route('index');
        }

        if (!VerificacaoGeral::sessionCargoIsDono() and !VerificacaoGeral::sessionCargoIsGerente()) {
            session()->forget('cargo');
            return redirect()->route('index');
        }

        return $next($request);
    }
}
