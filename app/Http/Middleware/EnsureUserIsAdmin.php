<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->statut != 1) {
            // Si l'utilisateur n'est pas connecté ou si ce n'est pas un admin,
            // redirigez-le vers la page d'accueil ou la page de connexion par exemple.
            return redirect('home')->with('error', 'Vous navez pas les permissions pour accéder à cette ressource.');
        }

        return $next($request);
    }
}
