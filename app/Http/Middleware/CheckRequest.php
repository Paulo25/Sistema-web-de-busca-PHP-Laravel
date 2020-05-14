<?php

namespace App\Http\Middleware;

use Closure;
use http\Client\Response;
use Log;

class CheckRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //Log::debug('Requisão do tipo GET');
            return $next($request);
        }
        return Response("<h1 style='background:black;color:red;height:15em;display:flex;align-items:center;justify-content:center;'>ERROR: TIPO DE REQUISIÇÃO HTTP NÃO CORRESPONDENTE</h1>");
    }
}
