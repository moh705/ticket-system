<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord.
     */
    public function index()
    {
        $user = Auth::user();

        // Données communes pour tous les rôles
        $data = [
            'totalTickets' => Ticket::count(),
            'openTickets' => Ticket::where('status_id', 1)->count(), // Statut "Open"
            'resolvedTickets' => Ticket::whereNotNull('resolved_at')->count(),
        ];

        // Données spécifiques au rôle
        if ($user->isAdmin()) {
            // Administrateur : Vue globale
            $data['recentUsers'] = User::latest()->take(5)->get(); // 5 derniers utilisateurs créés
            $data['recentTickets'] = Ticket::latest()->take(5)->get(); // 5 derniers tickets créés
        } elseif ($user->isTechnician()) {
            // Technicien : Tickets assignés à lui
            $data['assignedTickets'] = Ticket::where('assigned_to', $user->id)
                ->with(['user', 'priority', 'status'])
                ->get();
        } elseif ($user->isEmployee()) {
            // Employé : Tickets créés par lui
            $data['myTickets'] = Ticket::where('user_id', $user->id)
                ->with(['priority', 'status'])
                ->get();
        }

        return view('dashboard', $data);
    }
}