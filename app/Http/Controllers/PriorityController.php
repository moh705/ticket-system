<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PriorityController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:priorities,name',
            'color' => 'nullable|string',
            'level' => 'required|integer|unique:priorities,level',
        ]);

        // Crée la priorité
        $priority = Priority::create($validatedData);

        // Journalise l'action
        Log::info("L'utilisateur ID #" . auth()->id() . " a créé une priorité (ID #" . $priority->id . ") nommée '" . $priority->name . "'");

        // Redirige vers la liste des priorités avec un message de succès
        return redirect()->route('priorities.index')->with('success', 'Priorité créée avec succès.');
    }

    public function update(Request $request, Priority $priority)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255|unique:priorities,name,' . $priority->id,
            'color' => 'nullable|string',
            'level' => 'nullable|integer|unique:priorities,level,' . $priority->id,
        ]);

        // Journalise l'action avant mise à jour
        Log::info("L'utilisateur ID #" . auth()->id() . " a mis à jour la priorité (ID #" . $priority->id . ")");

        // Met à jour la priorité
        $priority->update($validatedData);

        // Redirige vers la liste des priorités avec un message de succès
        return redirect()->route('priorities.index')->with('success', 'Priorité mise à jour avec succès.');
    }

    public function destroy(Priority $priority)
    {
        // Journalise l'action avant suppression
        Log::info("L'utilisateur ID #" . auth()->id() . " a supprimé la priorité (ID #" . $priority->id . ") nommée '" . $priority->name . "'");

        // Supprime la priorité
        $priority->delete();

        // Redirige vers la liste des priorités avec un message de succès
        return redirect()->route('priorities.index')->with('success', 'Priorité supprimée avec succès.');
    }
}