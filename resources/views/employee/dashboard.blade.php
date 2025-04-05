<x-layout>
    <x-slot name="header">
        Gestion des Tickets IT
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message de Bienvenue -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Bienvenue, {{ Auth::user()->name }} !</h2>
                    <p class="mt-2 text-gray-600">
                        Voici un résumé de vos tickets et des actions disponibles.
                    </p>
                </div>
            </div>

            <!-- Actions Disponibles -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Voir Tous les Tickets -->
                <a href="{{ route('tickets.index') }}"
                   class="block bg-blue-500 hover:bg-blue-600 py-4 px-6 rounded-lg text-center shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                    <span style="color: black; font-size: 1.25rem; font-weight: bold;">Voir Tous les Tickets</span>
                    <span class="block mt-2 text-sm text-gray-500 font-normal">Accéder à la liste complète des tickets.</span>
                </a>

                <!-- Créer un Nouveau Ticket -->
                <a href="{{ route('tickets.create') }}"
                   class="block bg-green-500 hover:bg-green-600 py-4 px-6 rounded-lg text-center shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                    <span style="color: black; font-size: 1.25rem; font-weight: bold;">Créer un Nouveau Ticket</span>
                    <span class="block mt-2 text-sm text-gray-500 font-normal">Soumettre une nouvelle demande ou signaler un problème.</span>
                </a>

                <!-- Mes Tickets -->
                <a href="{{ route('tickets.my_tickets') }}"
                   class="block bg-purple-500 hover:bg-purple-600 py-4 px-6 rounded-lg text-center shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                    <span style="color: black; font-size: 1.25rem; font-weight: bold;">Mes Tickets</span>
                    <span class="block mt-2 text-sm text-gray-500 font-normal">Consulter les tickets que vous avez créés.</span>
                </a>
            </div>

            <!-- Section : Tickets Assignés à Moi -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Tickets Assignés à Moi</h3>

                    @if($assignedTickets->isEmpty())
                        <p class="text-gray-500">Aucun ticket assigné pour le moment.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($assignedTickets as $ticket)
                                <li class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <h4 class="text-lg font-medium text-gray-800">{{ $ticket->title }}</h4>
                                    <p class="text-gray-600 mt-2">{{ Str::limit($ticket->description, 100) }}</p>
                                    <div class="mt-2 flex justify-between items-center">
                                        <span class="text-sm text-gray-500">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
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