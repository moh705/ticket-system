<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Vérifie si l'utilisateur est un admin.
     */
    private function isAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        // Vérifie si l'utilisateur est un admin
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Récupère tous les utilisateurs
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Affiche le formulaire d'ajout d'un utilisateur.
     */
    public function create()
    {
        // Vérifie si l'utilisateur est un admin
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        return view('admin.users.create');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        // Vérifie si l'utilisateur est un admin
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,technician,employee',
        ]);

        // Hash du mot de passe
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Création de l'utilisateur
        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        // Vérifie si l'utilisateur est un admin
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur existant.
     */
    public function update(Request $request, User $user)
    {
        // Vérifie si l'utilisateur est un admin
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,technician,employee',
        ]);

        // Hash du mot de passe s'il est fourni
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Ne met pas à jour le mot de passe si non fourni
        }

        // Mise à jour de l'utilisateur
        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy(User $user)
    {
        // Vérifie si l'utilisateur est un admin
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Suppression de l'utilisateur
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    /**
     * Affiche le tableau de bord de l'administrateur.
     */
    public function dashboard()
    {
        // Vérifie si l'utilisateur est un admin
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Statistiques globales
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status_id', 1)->count(); // Supposons que l'ID 1 correspond à "Open"
        $resolvedTickets = Ticket::where('status_id', 3)->count(); // Supposons que l'ID 3 correspond à "Résolu"

        // Temps moyen de résolution par technicien
        $averageResolutionTimeByTechnician = Ticket::whereNotNull('assigned_to')
            ->where('status_id', 3) // Tickets résolus
            ->selectRaw('assigned_to, AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_resolution_time')
            ->groupBy('assigned_to')
            ->get();

        // Tickets prioritaires (critiques)
        $criticalTickets = Ticket::where('priority_id', 1)->get(); // Supposons que l'ID 1 correspond à "Critique"

        return view('admin.dashboard', compact(
            'totalTickets',
            'openTickets',
            'resolvedTickets',
            'averageResolutionTimeByTechnician',
            'criticalTickets'
        ));
    }
}