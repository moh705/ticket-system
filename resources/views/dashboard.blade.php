<x-layout>
    <h2 class="text-2xl font-bold mb-4">Tableau de Bord</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Statistiques Globales -->
        <div class="bg-white p-4 rounded shadow">
            <p class="text-lg font-bold">Total des Tickets</p>
            <p class="text-2xl">{{ $totalTickets }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-lg font-bold">Tickets Ouverts</p>
            <p class="text-2xl">{{ $openTickets }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-lg font-bold">Tickets Résolus</p>
            <p class="text-2xl">{{ $resolvedTickets }}</p>
        </div>
    </div>

    @if (auth()->user()->isAdmin())
        <h3 class="text-xl font-bold mt-6">Derniers Tickets</h3>
        <ul class="mt-2">
            @foreach ($recentTickets as $ticket)
                <li>{{ $ticket->title }} - {{ $ticket->status?->name ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @elseif (auth()->user()->isTechnician())
        <h3 class="text-xl font-bold mt-6">Tickets Assignés</h3>
        <ul class="mt-2">
            @foreach ($assignedTickets as $ticket)
                <li>{{ $ticket->title }} - {{ $ticket->priority?->name ?? 'N/A' }} - {{ $ticket->status?->name ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @elseif (auth()->user()->isEmployee())
        <h3 class="text-xl font-bold mt-6">Mes Tickets</h3>
        <ul class="mt-2">
            @foreach ($myTickets as $ticket)
                <li>{{ $ticket->title }} - {{ $ticket->priority?->name ?? 'N/A' }} - {{ $ticket->status?->name ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @endif
</x-layout>