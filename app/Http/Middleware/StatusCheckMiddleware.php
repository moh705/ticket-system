<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TicketStatus;

class StatusCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Récupère le statut via l'ID dans l'URL
        $status = TicketStatus::findOrFail($request->route('status'));

        // Vérifie si le statut est critique
        if (in_array($status->name, ['Open', 'Closed'])) {
            abort(403, 'Ce statut ne peut pas être modifié ou supprimé.');
        }

        return $next($request);
    }
}