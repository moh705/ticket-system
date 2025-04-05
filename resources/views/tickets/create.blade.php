<x-layout>
    <x-slot name="header">
        Créer un Nouveau Ticket
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Messages d'Erreur -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h2 class="text-2xl font-bold mb-4">Créer un Nouveau Ticket</h2>

                    <!-- Formulaire de Création -->
                    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Titre -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-medium mb-2">Titre</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="w-full border border-gray-300 rounded p-2" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full border border-gray-300 rounded p-2" required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catégorie -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 font-medium mb-2">Catégorie</label>
                            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded p-2" required>
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priorité -->
                        <div class="mb-4">
                            <label for="priority_id" class="block text-gray-700 font-medium mb-2">Priorité</label>
                            <select name="priority_id" id="priority_id" class="w-full border border-gray-300 rounded p-2" required>
                                <option value="">Sélectionnez une priorité</option>
                                @foreach ($priorities as $priority)
                                    <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                        {{ $priority->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('priority_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Département -->
                        <div class="mb-4">
                            <label for="department_id" class="block text-gray-700 font-medium mb-2">Département</label>
                            <select name="department_id" id="department_id" class="w-full border border-gray-300 rounded p-2" required>
                                <option value="">Sélectionnez un département</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Assignation au Technicien -->
                        <div class="mb-4">
                            <label for="assigned_to" class="block text-gray-700 font-medium mb-2">Assigner à un Technicien (Optionnel)</label>
                            <select name="assigned_to" id="assigned_to" class="w-full border border-gray-300 rounded p-2">
                                <option value="">-- Optionnel : Sélectionnez un technicien --</option>
                                @foreach ($technicians as $technician)
                                    <option value="{{ $technician->id }}" {{ old('assigned_to') == $technician->id ? 'selected' : '' }}>
                                        {{ $technician->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fichiers Joints (Optionnel) -->
                        <div class="mb-4">
                            <label for="attachments" class="block text-gray-700 font-medium mb-2">Fichiers Joints (Optionnel)</label>
                            <input type="file" name="attachments[]" id="attachments" multiple class="w-full border border-gray-300 rounded p-2">
                        </div>

                        <!-- Bouton de Soumission -->
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition duration-300">
                            Créer le Ticket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>