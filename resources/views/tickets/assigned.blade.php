<x-layout>
    <x-slot name="header">
        Tickets Assignés
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message de Bienvenue -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Tickets Assignés</h2>
                    <p class="mt-2 text-gray-600">
                        Voici la liste des tickets qui vous ont été assignés.
                    </p>
                </div>
            </div>

            <!-- Liste des Tickets Assignés -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($tickets->isEmpty())
                        <p class="text-gray-500">Aucun ticket assigné pour le moment.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($tickets as $ticket)
                                <li class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <h4 class="text-lg font-medium text-gray-800">{{ $ticket->title }}</h4>
                                    <p class="text-gray-600 mt-2">{{ Str::limit($ticket->description, 100) }}</p>
                                    <div class="mt-2 flex justify-between items-center">
                                        <div>
                                            <span class="text-sm text-gray-500">Priorité : {{ $ticket->priority->name }}</span>
                                            <span class="ml-4 text-sm text-gray-500">Statut : {{ $ticket->status->name }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-500 hover:underline">
                                            Voir Détails
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $tickets->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>