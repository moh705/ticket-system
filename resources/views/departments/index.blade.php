<!-- resources/views/departments/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Liste des Départements</h2>

    <a href="{{ route('departments.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Créer un Département</a>

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
            @foreach ($departments as $department)
                <tr class="border">
                    <td class="p-2">{{ $department->id }}</td>
                    <td class="p-2">{{ $department->name }}</td>
                    <td class="p-2">{{ $department->description ?? 'Aucune description' }}</td>
                    <td class="p-2">
                        <a href="{{ route('departments.show', $department->id) }}" class="text-blue-500 hover:underline">Voir</a>
                        <a href="{{ route('departments.edit', $department->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection