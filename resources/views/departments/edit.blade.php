<!-- resources/views/departments/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Modifier le Département #{{ $department->id }}</h2>

    <form action="{{ route('departments.update', $department->id) }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border p-2 rounded">{{ old('description', $department->description) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Enregistrer les Modifications</button>
    </form>
@endsection