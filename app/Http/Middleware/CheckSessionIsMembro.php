<?php

namespace App\Http\Middleware;

use App\Classes\VerificacaoGeral;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionIsMembro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!VerificacaoGeral::sessionCargoIsVisitante() and !VerificacaoGeral::sessionCargoIsCliente()) {
            session()->put('cargo', 'visitante');
        }
        return $next($request);
    }
}
