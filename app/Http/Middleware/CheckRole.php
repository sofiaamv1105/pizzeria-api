<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y tiene el rol requerido
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Si no tiene el rol, devolver un error 403 (Forbidden)
            abort(403, 'Unauthorized access');
        }

        // Si tiene el rol, permitir acceso a la ruta
        return $next($request);
    }
}
