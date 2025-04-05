<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Créer un Nouvel Utilisateur</h2>

    <form action="{{ route('users.store') }}" method="POST" class="max-w-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold">Nom</label>
            <input type="text" name="name" id="name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-bold">Rôle</label>
            <select name="role" id="role" class="w-full border p-2 rounded">
                <option value="employee">Employé</option>
                <option value="technician">Technicien</option>
                <option value="admin">Administrateur</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="department_id" class="block text-gray-700 font-bold">Département</label>
            <select name="department_id" id="department_id" class="w-full border p-2 rounded">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2">Créer l'Utilisateur</button>
    </form>
@endsection