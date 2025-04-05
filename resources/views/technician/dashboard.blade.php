<x-layout>
    <x-slot name="header">
        Tableau de Bord Technicien
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message de Bienvenue -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800">Bienvenue, {{ Auth::user()->name }} !</h2>
                    <p class="mt-2 text-gray-600">
                        Voici un résumé de vos tickets assignés et des actions disponibles.
                    </p>
                </div>
            </div>

            <!-- Statistiques Rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Tickets en Attente -->
                <div class="bg-blue-500 text-black p-4 rounded-lg shadow-md text-center">
                    <h3 class="text-xl font-bold">En Attente</h3>
                    <p class="text-3xl font-semibold">{{ $pendingTicketsCount ?? 0 }}</p>
                </div>

                <!-- Tickets en Cours -->
                <div class="bg-green-500 text-black p-4 rounded-lg shadow-md text-center">
                    <h3 class="text-xl font-bold">En Cours</h3>
                    <p class="text-3xl font-semibold">{{ $inProgressTicketsCount ?? 0 }}</p>
                </div>

                <!-- Tickets Terminés -->
                <div class="bg-purple-500 text-black p-4 rounded-lg shadow-md text-center">
                    <h3 class="text-xl font-bold">Terminés</h3>
                    <p class="text-3xl font-semibold">{{ $completedTicketsCount ?? 0 }}</p>
                </div>
            </div>

            <!-- Derniers Tickets Assignés -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Derniers Tickets Assignés</h3>

                    @if(isset($recentTickets) && $recentTickets->isEmpty())
                        <p class="text-gray-500">Aucun ticket assigné récemment.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($recentTickets as $ticket)
                                <li class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <h4 class="text-lg font-medium text-gray-800">{{ $ticket->title }}</h4>
                                    <p class="text-gray-600 mt-2">{{ Str::limit($ticket->description, 100) }}</p>
                                    <div class="mt-2 flex justify-between items-center">
                                        <div>
                                            <span class="text-sm text-gray-500">Priorité : {{ $ticket->priority->name ?? 'N/A' }}</span>
                                            <span class="ml-4 text-sm text-gray-500">Statut : {{ $ticket->status->name ?? 'N/A' }}</span>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>