<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importation de la classe Auth

class CommentController extends Controller
{
    /**
     * Ajoute un commentaire à un ticket.
     */
    public function store(Request $request, Ticket $ticket)
    {
        // Validation des données
        $validatedData = $request->validate([
            'content' => 'required|string|min:2',
        ]);

        // Ajoute le commentaire au ticket
        $comment = new Comment($validatedData);
        $comment->user_id = Auth::id(); // L'utilisateur connecté est l'auteur du commentaire
        $ticket->comments()->save($comment);

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Le commentaire a été ajouté avec succès.');
    }

    /**
     * Supprime un commentaire.
     */
    public function destroy(Ticket $ticket, Comment $comment)
    {
        // Autorisation : Seul l'auteur ou un administrateur peut supprimer un commentaire
        if (Auth::id() !== $comment->user_id && !Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce commentaire.');
        }

        // Supprime le commentaire
        $comment->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Le commentaire a été supprimé avec succès.');
    }
}