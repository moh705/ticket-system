<x-layout>
    <x-slot name="header">
        Détails du Ticket
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Informations du Ticket -->
                    <h2 class="text-2xl font-bold mb-4">{{ $ticket->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $ticket->description }}</p>
                    <div class="mb-4">
                        <span class="font-medium">Catégorie :</span> {{ $ticket->category->name }}
                    </div>
                    <div class="mb-4">
                        <span class="font-medium">Priorité :</span> {{ $ticket->priority->name }}
                    </div>
                    <div class="mb-4">
                        <span class="font-medium">Statut Actuel :</span> {{ $ticket->status->name }}
                    </div>
                    <div class="mb-4">
                        <span class="font-medium">Créé par :</span> {{ $ticket->user->name }}
                    </div>
                    <div class="mb-4">
                        <span class="font-medium">Date de Création :</span> {{ $ticket->created_at->format('d/m/Y H:i') }}
                    </div>

                    <!-- Section pour Mettre à Jour le Statut -->
                    <div class="mt-6">
                        <h3 class="text-xl font-bold mb-4">Mettre à Jour le Statut</h3>
                        <form action="{{ route('tickets.update_status', $ticket) }}" method="POST" class="flex items-center space-x-4">
                            @csrf
                            @method('PATCH')

                            <!-- Sélection du Statut -->
                            <div>
                                <label for="status_id" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select id="status_id" name="status_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $ticket->status_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bouton de Soumission -->
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-black text-sm font-medium rounded-md shadow-sm">
                                Mettre à Jour
                            </button>
                        </form>
                    </div>

                    <!-- Liste des Commentaires -->
                    <div class="mt-6">
                        <h3 class="text-xl font-bold mb-4">Commentaires</h3>
                        @if($ticket->comments->isEmpty())
                            <p class="text-gray-500">Aucun commentaire pour ce ticket.</p>
                        @else
                            <ul class="space-y-4">
                                @foreach($ticket->comments as $comment)
                                    <li class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                        <p class="text-gray-800">{{ $comment->content }}</p>
                                        <div class="mt-2 flex justify-between items-center">
                                            <span class="text-sm text-gray-500">Par {{ $comment->user->name }}</span>
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Formulaire pour Ajouter un Commentaire -->
                    <div class="mt-6">
                        <h3 class="text-xl font-bold mb-4">Ajouter un Commentaire</h3>
                        <form action="{{ route('comments.store', $ticket) }}" method="POST">
                            @csrf
                            <textarea name="content" class="w-full border border-gray-300 rounded p-2" rows="3" placeholder="Écrivez votre commentaire ici..." required></textarea>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mt-2">
                                Ajouter un Commentaire
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>