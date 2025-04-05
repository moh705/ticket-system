<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Priority;

class PriorityCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Récupère la priorité via l'ID dans l'URL
        $priority = Priority::findOrFail($request->route('priority'));

        // Vérifie si la priorité est critique
        if ($priority->level === 4) { // Niveau 4 = Critique
            abort(403, 'Cette priorité ne peut pas être modifiée ou supprimée.');
        }

        return $next($request);
    }
}