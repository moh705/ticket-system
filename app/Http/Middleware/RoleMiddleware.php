<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Vérifie si l'utilisateur est connecté et a le rôle spécifié
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirige vers la page d'accueil avec un message d'erreur
        return redirect('/')->withErrors(['error' => 'Accès non autorisé.']);
    }
}