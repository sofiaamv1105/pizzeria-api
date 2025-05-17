<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // <- Esta línea es clave
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}