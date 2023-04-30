<?php

namespace App\Http\Middleware;

use App\Classes\VerificacaoGeral;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionIsCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!VerificacaoGeral::sessionCargoIsCliente()) {
            return redirect()->route('clienteprodutos');
        }
        return $next($request);
    }
}
