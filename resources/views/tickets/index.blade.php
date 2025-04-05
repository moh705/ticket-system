<x-layout>
    <x-slot name="header">
        Liste des Tickets
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Liste des Tickets</h2>

                    <!-- Bouton Créer un Ticket -->
                    <a href="{{ route('tickets.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Créer un Ticket</a>

                    <!-- Formulaire de Filtrage -->
                    <form action="{{ route('tickets.index') }}" method="GET" class="mb-6">
                        <div class="flex gap-4">
                            <!-- Filtre par Statut -->
                            <select name="status" id="status" class="border border-gray-300 rounded p-2">
                                <option value="">Tous les Statuts</option>
                                @foreach (\App\Models\TicketStatus::all() as $status)
                                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Filtre par Priorité -->
                            <select name="priority" id="priority" class="border border-gray-300 rounded p-2">
                                <option value="">Toutes les Priorités</option>
                                @foreach (\App\Models\Priority::all() as $priority)
                                    <option value="{{ $priority->id }}" {{ request('priority') == $priority->id ? 'selected' : '' }}>
                                        {{ $priority->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Bouton de Soumission -->
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                Filtrer
                            </button>
                        </div>
                    </form>

                    <!-- Tableau des Tickets -->
                    <table class="w-full border-collapse mt-4">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2">ID</th>
                                <th class="p-2">Titre</th>
                                <th class="p-2">Statut</th>
                                <th class="p-2">Priorité</th>
                                <th class="p-2">Créé le</th>
                                <th class="p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tickets->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center p-4">Aucun ticket trouvé.</td>
                                </tr>
                            @else
                                @foreach ($tickets as $ticket)
                                    <tr class="border {{ $ticket->status?->name === 'Open' ? 'bg-green-100' : ($ticket->status?->name === 'Resolved' ? 'bg-blue-100' : '') }}">
                                        <td class="p-2">{{ $ticket->id }}</td>
                                        <td class="p-2">{{ $ticket->title }}</td>
                                        <td class="p-2">{{ $ticket->status?->name ?? 'N/A' }}</td>
                                        <td class="p-2">{{ $ticket->priority?->name ?? 'N/A' }}</td>
                                        <td class="p-2">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="p-2">
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline">Voir</a>
                                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>