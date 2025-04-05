<x-layout>
    <x-slot name="header">
        Tableau de Bord Administrateur
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Bouton pour Accéder à la Liste des Utilisateurs -->
            <div class="mb-6">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 text-black text-sm font-semibold rounded-lg shadow-md transition duration-200 ease-in-out">
                    <i class="fas fa-users mr-2"></i> <!-- Icône utilisateurs -->
                    Voir la Liste des Utilisateurs
                </a>
            </div>

            <!-- Messages de Confirmation ou d'Erreur -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md mb-6" role="alert">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mb-6" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Statistiques Globales -->
            <h2 class="text-2xl font-bold mb-6">Statistiques</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Carte : Tickets au Total -->
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-ticket-alt text-3xl text-blue-500"></i>
                    </div>
                    <div>
                        <p class="text-xl font-bold">{{ $totalTickets }}</p>
                        <p class="text-gray-600">Tickets au Total</p>
                    </div>
                </div>

                <!-- Carte : Tickets Ouverts -->
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-folder-open text-3xl text-yellow-500"></i>
                    </div>
                    <div>
                        <p class="text-xl font-bold">{{ $openTickets }}</p>
                        <p class="text-gray-600">Tickets Ouverts</p>
                    </div>
                </div>

                <!-- Carte : Tickets Résolus -->
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-3xl text-green-500"></i>
                    </div>
                    <div>
                        <p class="text-xl font-bold">{{ $resolvedTickets }}</p>
                        <p class="text-gray-600">Tickets Résolus</p>
                    </div>
                </div>
            </div>

            <!-- Temps Moyen de Résolution par Technicien -->
            <h3 class="text-2xl font-bold mb-4">Temps Moyen de Résolution par Technicien</h3>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-12">
                @if ($averageResolutionTimeByTechnician->isEmpty())
                    <p class="text-gray-500 flex items-center space-x-2">
                        <i class="fas fa-info-circle text-blue-500"></i>
                        Aucun ticket résolu pour le moment.
                    </p>
                @else
                    <ul class="space-y-4">
                        @foreach ($averageResolutionTimeByTechnician as $data)
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-user text-blue-500"></i>
                                <span>{{ optional($data->assignedTo)->name ?? 'Non Assigné' }} :</span>
                                <span class="font-bold">{{ number_format($data->avg_resolution_time, 2) }} heures</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Tickets Prioritaires (Critiques) -->
            <h3 class="text-2xl font-bold mb-4">Tickets Critiques</h3>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                @if ($criticalTickets->isEmpty())
                    <p class="text-gray-500 flex items-center space-x-2">
                        <i class="fas fa-exclamation-triangle text-red-500"></i>
                        Aucun ticket critique pour le moment.
                    </p>
                @else
                    <ul class="space-y-4">
                        @foreach ($criticalTickets as $ticket)
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                                <span>{{ $ticket->title }} - Priorité : {{ $ticket->priority->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-layout>