<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketOwnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Récupère le ticket via l'ID dans l'URL
        $ticket = Ticket::findOrFail($request->route('ticket'));

        // Vérifie si l'utilisateur est le créateur ou le technicien assigné
        if ($ticket->user_id !== auth()->id() && $ticket->assigned_to !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à accéder à ce ticket.');
        }

        return $next($request);
    }
}