<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiForceAcceptHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener el valor actual de la cabecera 'Accept'
        $acceptHeader = $request->header(key: 'Accept');

        //Comprobar si la cabecera 'Accept' es igual a 'application/json'
        if($acceptHeader !== 'application/json')
        {
            //forzar la cabecera a 'aplication/json'
            $request->headers->set(key: 'Accept', values: 'application/json');
        }

        return $next($request);
    }
}