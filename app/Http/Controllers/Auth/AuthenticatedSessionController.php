<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Afficher la page de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gérer une requête d'authentification.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifier l'utilisateur
        $request->authenticate();

        // Régénérer la session pour éviter les attaques de fixation de session
        $request->session()->regenerate();

        // Rediriger en fonction du rôle de l'utilisateur
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } elseif ($user->isEmployee()) {
            return redirect()->intended(route('employee.dashboard', absolute: false));
        } elseif ($user->isTechnician()) {
            return redirect()->intended(route('technician.dashboard', absolute: false));
        }

        // Redirection par défaut si aucun rôle ne correspond
        return redirect()->intended('/');
    }

    /**
     * Détruire une session authentifiée (déconnexion).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Déconnecter l'utilisateur
        Auth::guard('web')->logout();

        // Invalider la session
        $request->session()->invalidate();

        // Régénérer le jeton CSRF
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil
        return redirect('/');
    }
}