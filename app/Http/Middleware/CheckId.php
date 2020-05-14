<?php

namespace App\Http\Middleware;
use \App\Lingua_progs;
use Closure;

class CheckId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $system)
    {
        if(is_numeric($request->id) && $system){
            return $next($request);
        }
        return Response("<h1 style='background:black;color:red;height:15em;display:flex;align-items:center;justify-content:center;'>Error: 500</h1>");
    }
}
