<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class TechnicianController extends Controller
{
    /**
     * Affiche le tableau de bord du technicien.
     */
    public function index()
    {
        $user = Auth::user();

        // Récupère les statistiques des tickets assignés
        $pendingTicketsCount = Ticket::where('assigned_to', $user->id)
            ->where('status_id', 1) // Supposons que 1 = "En Attente"
            ->count();

        $inProgressTicketsCount = Ticket::where('assigned_to', $user->id)
            ->where('status_id', 2) // Supposons que 2 = "En Cours"
            ->count();

        $completedTicketsCount = Ticket::where('assigned_to', $user->id)
            ->where('status_id', 3) // Supposons que 3 = "Terminé"
            ->count();

        // Récupère les derniers tickets assignés (5 derniers)
        $recentTickets = Ticket::where('assigned_to', $user->id)
            ->with(['priority', 'status'])
            ->orderBy('created_at', 'desc')
            ->take(5) // Limite à 5 tickets
            ->get();

        // Passe les données à la vue
        return view('technician.dashboard', compact(
            'pendingTicketsCount',
            'inProgressTicketsCount',
            'completedTicketsCount',
            'recentTickets'
        ));
    }
}