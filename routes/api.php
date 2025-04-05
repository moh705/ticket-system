<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Mise à jour du namespace
use App\Http\Controllers\TicketController; // Mise à jour du namespace
use App\Http\Controllers\CommentController; // Mise à jour du namespace
use App\Http\Controllers\DepartmentController; // Mise à jour du namespace
use App\Http\Controllers\PriorityController; // Mise à jour du namespace
use App\Http\Controllers\TicketCategoryController; // Mise à jour du namespace

/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
| 
| Ce fichier définit les routes de l'API pour la gestion des tickets.
| Toutes les routes ici sont préfixées par `/api`.
|
*/

// Routes protégées par middleware d’authentification (si nécessaire)
Route::middleware('auth:sanctum')->group(function () {

    // Routes pour la gestion des utilisateurs
    Route::apiResource('users', UserController::class);

    // Routes pour la gestion des tickets
    Route::apiResource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/assign', [TicketController::class, 'assign']);
    Route::post('tickets/{ticket}/status', [TicketController::class, 'updateStatus']);

    // Routes pour les commentaires liés aux tickets
    Route::get('tickets/{ticket}/comments', [CommentController::class, 'index']);
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store']);

    // Routes pour la gestion des départements
    Route::apiResource('departments', DepartmentController::class);

    // Routes pour la gestion des niveaux de priorité
    Route::apiResource('priorities', PriorityController::class);

    // Routes pour la gestion des catégories de tickets
    Route::apiResource('ticket-categories', TicketCategoryController::class);
});

// Route publique pour tester l'API
Route::get('/test', function () {
    return response()->json(['message' => 'API en ligne 🚀'], 200);
});
