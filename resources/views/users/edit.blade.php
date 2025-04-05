<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Modifier l'Utilisateur #{{ $user->id }}</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-bold">Rôle</label>
            <select name="role" id="role" class="w-full border p-2 rounded">
                <option value="employee" {{ $user->role === 'employee' ? 'selected' : '' }}>Employé</option>
                <option value="technician" {{ $user->role === 'technician' ? 'selected' : '' }}>Technicien</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="department_id" class="block text-gray-700 font-bold">Département</label>
            <select name="department_id" id="department_id" class="w-full border p-2 rounded">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Enregistrer les Modifications</button>
    </form>
@endsection