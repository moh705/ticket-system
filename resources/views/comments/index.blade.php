<!-- resources/views/comments/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Commentaires pour le Ticket "{{ $ticket->title }}"</h2>

    <a href="{{ route('comments.create', $ticket->id) }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter un Commentaire</a>

    <ul>
        @foreach ($comments as $comment)
            <li class="mb-4 p-4 bg-gray-100 rounded">
                <p><strong>{{ $comment->user->name }}</strong> a dit :</p>
                <p>{{ $comment->content }}</p>
                <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
            </li>
        @endforeach
    </ul>
@endsection