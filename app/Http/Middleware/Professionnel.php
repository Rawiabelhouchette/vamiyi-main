<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Professionnel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->hasRole('Professionnel') && !auth()->user()->hasRole('Administrateur')) {
            return back()->with('error', 'Vous n\'avez pas accès à cette page.');
        }
        return $next($request);
    }
}
