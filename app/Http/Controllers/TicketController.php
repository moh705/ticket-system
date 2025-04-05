<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\TicketCategory;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\User; // Ajout pour récupérer les techniciens
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Affiche la liste des tickets.
     */
    public function index(Request $request)
    {
        // Récupérer les filtres depuis la requête
        $statusFilter = $request->input('status');
        $priorityFilter = $request->input('priority');

        // Construire la requête pour récupérer les tickets
        $tickets = Ticket::query()
            ->with(['user', 'priority', 'status']) // Charge les relations nécessaires
            ->when($statusFilter, function ($query, $status) {
                return $query->where('status_id', $status);
            })
            ->when($priorityFilter, function ($query, $priority) {
                return $query->where('priority_id', $priority);
            })
            ->orderBy('created_at', 'desc') // Trier par date de création (le plus récent en premier)
            ->paginate(10); // Pagination : 10 tickets par page

        // Passer les tickets et les filtres à la vue
        return view('tickets.index', compact('tickets', 'statusFilter', 'priorityFilter'));
    }

    /**
     * Affiche le formulaire de création d'un ticket.
     */
    public function create()
    {
        // Récupère tous les départements, catégories, priorités et techniciens
        $departments = Department::all();
        $categories = TicketCategory::all();
        $priorities = Priority::all();
        $technicians = User::where('role', 'technician')->get(); // Seuls les utilisateurs avec le rôle "technician"

        return view('tickets.create', compact('departments', 'categories', 'priorities', 'technicians'));
    }

    /**
     * Enregistre un nouveau ticket dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'required|exists:ticket_categories,id',
            'priority_id' => 'required|exists:priorities,id',
            'department_id' => 'required|exists:departments,id',
            'assigned_to' => 'nullable|exists:users,id', // Optionnel, car un ticket peut ne pas être assigné immédiatement
            'attachments.*' => 'nullable|file|mimes:jpg,png,pdf|max:5120', // 5 Mo max par fichier
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'priority_id.exists' => 'La priorité sélectionnée n\'existe pas.',
            'department_id.exists' => 'Le département sélectionné n\'existe pas.',
            'assigned_to.exists' => 'Le technicien sélectionné n\'existe pas.',
            'attachments.*.mimes' => 'Les fichiers doivent être au format JPG, PNG ou PDF.',
        ]);

        // Ajoute l'utilisateur connecté comme créateur du ticket
        $validatedData['user_id'] = Auth::id();

        // Statut initial : "Open"
        $validatedData['status_id'] = 1; // Supposons que l'ID 1 correspond à "Open"

        // Crée le ticket
        $ticket = Ticket::create($validatedData);

        // Gestion des fichiers joints
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public'); // Stocke le fichier dans le disque 'public'
                $ticket->attachments()->create(['path' => $path]);
            }
        }

        // Redirection avec un message de succès
        return redirect()->route('tickets.index')->with('success', 'Le ticket a été créé avec succès.');
    }

    /**
     * Affiche les détails d'un ticket spécifique.
     */
    public function show(Ticket $ticket)
    {
        // Charge les relations nécessaires
        $ticket->load(['user', 'category', 'priority', 'status', 'comments.user']);

        // Récupère tous les statuts disponibles
        $statuses = \App\Models\TicketStatus::all();

        return view('tickets.show', compact('ticket', 'statuses'));
    }

    /**
     * Affiche le formulaire d'édition d'un ticket.
     */
    public function edit(Ticket $ticket)
    {
        // Récupère tous les départements, catégories, priorités et techniciens
        $departments = Department::all();
        $categories = TicketCategory::all();
        $priorities = Priority::all();
        $technicians = User::where('role', 'technician')->get(); // Seuls les utilisateurs avec le rôle "technician"

        return view('tickets.edit', compact('ticket', 'departments', 'categories', 'priorities', 'technicians'));
    }

    /**
     * Met à jour un ticket existant.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Validation des données
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'required|exists:ticket_categories,id',
            'priority_id' => 'required|exists:priorities,id',
            'department_id' => 'required|exists:departments,id',
            'assigned_to' => 'nullable|exists:users,id', // Optionnel, car un ticket peut ne pas être assigné immédiatement
        ]);

        // Met à jour le ticket
        $ticket->update($validatedData);

        // Redirection avec un message de succès
        return redirect()->route('tickets.index')->with('success', 'Le ticket a été mis à jour avec succès.');
    }

    /**
     * Supprime un ticket existant.
     */
    public function destroy(Ticket $ticket)
    {
        // Supprime le ticket
        $ticket->delete();

        // Redirection avec un message de succès
        return redirect()->route('tickets.index')->with('success', 'Le ticket a été supprimé avec succès.');
    }

    /**
     * Affiche la liste des tickets créés par l'employé connecté.
     */
    public function myTickets()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Récupère les tickets créés par cet utilisateur
        $tickets = Ticket::where('user_id', $user->id)
            ->with(['category', 'priority', 'status']) // Charge les relations nécessaires
            ->orderBy('created_at', 'desc') // Trie par date de création (le plus récent en premier)
            ->paginate(10); // Pagination : 10 tickets par page

        // Passe les tickets à la vue (dans le dossier "tickets")
        return view('tickets.my_tickets', compact('tickets'));
    }

    /**
     * Affiche la liste des tickets assignés au technicien connecté.
     */
    public function assignedTickets()
    {
        $user = Auth::user();

        // Récupère les tickets assignés au technicien connecté
        $tickets = Ticket::where('assigned_to', $user->id)
            ->with(['priority', 'status'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('technician.assigned_tickets', compact('tickets'));
    }

    /**
     * Met à jour le statut d'un ticket (Technicien).
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        // Validation des données
        $validatedData = $request->validate([
            'status_id' => 'required|exists:ticket_statuses,id',
        ]);

        // Met à jour le statut du ticket
        $ticket->update($validatedData);

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Le statut du ticket a été mis à jour avec succès.');
    }
}