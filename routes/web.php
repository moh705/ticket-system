<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AdminController;



// Route pour le tableau de bord de l'administrateur
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Routes pour la gestion des utilisateurs
Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index'); // Liste des utilisateurs
Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create'); // Formulaire d'ajout
Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store'); // Enregistrement d'un utilisateur
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit'); // Formulaire d'édition
Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update'); // Mise à jour d'un utilisateur
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy'); // Suppression d'un utilisateur
/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification (connexion, inscription)
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Routes Protégées par Authentification
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Profil utilisateur
    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Tickets
    Route::resource('tickets', App\Http\Controllers\TicketController::class);

    // Commentaires sur les tickets
    Route::prefix('tickets/{ticket}/comments')->group(function () {
        Route::get('/', [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
        Route::post('/', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    });
    Route::delete('/tickets/{ticket}/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])
        ->name('comments.destroy');

    // Déconnexion
    Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Routes Spécifiques aux Rôles (Sans Middleware)
|--------------------------------------------------------------------------
*/



// Gestion des départements (Administrateur)
Route::resource('admin/departments', App\Http\Controllers\DepartmentController::class);

// Gestion des catégories de tickets (Administrateur)
Route::resource('admin/categories', App\Http\Controllers\TicketCategoryController::class);

// Gestion des priorités (Administrateur)
Route::resource('admin/priorities', App\Http\Controllers\PriorityController::class);

// Gestion des statuts de tickets (Administrateur)
Route::resource('admin/statuses', App\Http\Controllers\TicketStatusController::class);

// Tableau de bord employé
Route::get('/employee/dashboard', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.dashboard');

// Tickets créés par l'employé
Route::get('/employee/my-tickets', [App\Http\Controllers\TicketController::class, 'myTickets'])->name('tickets.my_tickets');

// Tableau de bord technicien
Route::get('/technician/dashboard', [App\Http\Controllers\TechnicianController::class, 'index'])->name('technician.dashboard');

// Tickets assignés au technicien
Route::get('/technician/assigned-tickets', [App\Http\Controllers\TicketController::class, 'assignedTickets'])->name('tickets.assigned_tickets');

// Mettre à jour le statut d'un ticket (Technicien)
Route::patch('/technician/tickets/{ticket}/update-status', [App\Http\Controllers\TicketController::class, 'updateStatus'])->name('tickets.update_status');