<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string',
        ]);

        // Crée le département
        $department = Department::create($validatedData);

        // Journalise l'action
        Log::info("L'utilisateur ID #" . auth()->id() . " a créé un département (ID #" . $department->id . ") nommé '" . $department->name . "'");

        // Redirige vers la liste des départements avec un message de succès
        return redirect()->route('departments.index')->with('success', 'Département créé avec succès.');
    }

    public function update(Request $request, Department $department)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string',
        ]);

        // Journalise l'action avant mise à jour
        Log::info("L'utilisateur ID #" . auth()->id() . " a mis à jour le département (ID #" . $department->id . ")");

        // Met à jour le département
        $department->update($validatedData);

        // Redirige vers la liste des départements avec un message de succès
        return redirect()->route('departments.index')->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy(Department $department)
    {
        // Journalise l'action avant suppression
        Log::info("L'utilisateur ID #" . auth()->id() . " a supprimé le département (ID #" . $department->id . ") nommé '" . $department->name . "'");

        // Supprime le département
        $department->delete();

        // Redirige vers la liste des départements avec un message de succès
        return redirect()->route('departments.index')->with('success', 'Département supprimé avec succès.');
    }
}