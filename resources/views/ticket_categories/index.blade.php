<!-- resources/views/ticket_categories/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Liste des Catégories de Tickets</h2>

    <a href="{{ route('ticket-categories.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Créer une Catégorie</a>

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
            @foreach ($categories as $category)
                <tr class="border">
                    <td class="p-2">{{ $category->id }}</td>
                    <td class="p-2">{{ $category->name }}</td>
                    <td class="p-2">{{ $category->description ?? 'Aucune description' }}</td>
                    <td class="p-2">
                        <a href="{{ route('ticket-categories.show', $category->id) }}" class="text-blue-500 hover:underline">Voir</a>
                        <a href="{{ route('ticket-categories.edit', $category->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection