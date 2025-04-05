<!-- resources/views/comments/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Modifier le Commentaire #{{ $comment->id }}</h2>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold">Contenu</label>
            <textarea name="content" id="content" rows="4" class="w-full border p-2 rounded" required>{{ old('content', $comment->content) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Enregistrer les Modifications</button>
    </form>
@endsection