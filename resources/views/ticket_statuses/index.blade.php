<!-- resources/views/ticket_statuses/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Liste des Statuts de Tickets</h2>

    <a href="{{ route('ticket-statuses.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Créer un Statut</a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">ID</th>
                <th class="p-2">Nom</th>
                <th class="p-2">Description</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr class="border">
                    <td class="p-2">{{ $status->id }}</td>
                    <td class="p-2">{{ $status->name }}</td>
                    <td class="p-2">{{ $status->description ?? 'Aucune description' }}</td>
                    <td class="p-2">
                        <a href="{{ route('ticket-statuses.show', $status->id) }}" class="text-blue-500 hover:underline">Voir</a>
                        <a href="{{ route('ticket-statuses.edit', $status->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection