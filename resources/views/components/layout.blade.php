<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Gestion des Tickets IT') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">Gestion des Tickets IT</a>
                            @elseif(Auth::user()->role === 'employee')
                                <a href="{{ route('employee.dashboard') }}" class="text-xl font-bold text-gray-800">Gestion des Tickets IT</a>
                            @elseif(Auth::user()->role === 'technician')
                                <a href="{{ route('technician.dashboard') }}" class="text-xl font-bold text-gray-800">Gestion des Tickets IT</a>
                            @endif
                        @else
                            <a href="/" class="text-xl font-bold text-gray-800">Gestion des Tickets IT</a>
                        @endauth
                    </div>
                </div>

                <!-- Auth Links -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                        <!-- Dropdown Menu -->
                        <div class="ml-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profil') }}
                                    </x-dropdown-link>

                                    <!-- Déconnexion -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Déconnexion') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <!-- Liens Connexion / Inscription -->
                        <div>
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Connexion</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Inscription</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>