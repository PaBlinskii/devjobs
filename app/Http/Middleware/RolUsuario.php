<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->rol === 1) {
            // En caso que no sea el rol 2, redireccionar al usuario hacia Home
            // El Policy genera Error 403 y ya no redirecciona, en cambio el middleware si redirecciona
            return redirect()->route('home');
        };

        return $next($request);
    }
}
