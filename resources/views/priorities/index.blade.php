<!-- resources/views/priorities/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Liste des Priorités</h2>

    <a href="{{ route('priorities.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Créer une Priorité</a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">ID</th>
                <th class="p-2">Nom</th>
                <th class="p-2">Couleur</th>
                <th class="p-2">Niveau</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($priorities as $priority)
                <tr class="border">
                    <td class="p-2">{{ $priority->id }}</td>
                    <td class="p-2">{{ $priority->name }}</td>
                    <td class="p-2" style="background-color: {{ $priority->color }};">{{ $priority->color }}</td>
                    <td class="p-2">{{ $priority->level }}</td>
                    <td class="p-2">
                        <a href="{{ route('priorities.show', $priority->id) }}" class="text-blue-500 hover:underline">Voir</a>
                        <a href="{{ route('priorities.edit', $priority->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection