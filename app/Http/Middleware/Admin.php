<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 'admin') {
            # code...
            return $next($request);
        } else {
            # code...
            return redirect()->route(auth()->user()->role)->with('error', 'Wrong Credentials!');
        }
        
        
    }
}
