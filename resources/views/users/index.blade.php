<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Liste des Utilisateurs</h2>

    <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Créer un Utilisateur</a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">ID</th>
                <th class="p-2">Nom</th>
                <th class="p-2">Email</th>
                <th class="p-2">Rôle</th>
                <th class="p-2">Département</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border">
                    <td class="p-2">{{ $user->id }}</td>
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ ucfirst($user->role) }}</td>
                    <td class="p-2">{{ $user->department?->name ?? 'Aucun' }}</td>
                    <td class="p-2">
                        <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:underline">Voir</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection