<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TicketCategoryController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:ticket_categories,name',
            'description' => 'nullable|string',
        ]);

        // Crée la catégorie de ticket
        $category = TicketCategory::create($validatedData);

        // Journalise l'action
        Log::info("L'utilisateur ID #" . auth()->id() . " a créé une catégorie de ticket (ID #" . $category->id . ") nommée '" . $category->name . "'");

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('ticket-categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    public function update(Request $request, TicketCategory $category)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255|unique:ticket_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // Journalise l'action avant mise à jour
        Log::info("L'utilisateur ID #" . auth()->id() . " a mis à jour la catégorie de ticket (ID #" . $category->id . ")");

        // Met à jour la catégorie de ticket
        $category->update($validatedData);

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('ticket-categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(TicketCategory $category)
    {
        // Journalise l'action avant suppression
        Log::info("L'utilisateur ID #" . auth()->id() . " a supprimé la catégorie de ticket (ID #" . $category->id . ") nommée '" . $category->name . "'");

        // Supprime la catégorie de ticket
        $category->delete();

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('ticket-categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}