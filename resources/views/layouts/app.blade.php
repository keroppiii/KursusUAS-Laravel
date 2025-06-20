<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col justify-between fixed h-screen">
            <div>
                <div class="text-2xl font-bold px-6 py-6 border-b border-blue-700">
                    Kursus UAS
                </div>
                <nav class="mt-4 space-y-1 px-4">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('instruktur.index') }}" class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('instruktur.index') ? 'bg-blue-800' : '' }}">
                        Instruktur
                    </a>

                    <a href="{{ route('kursus.index') }}" class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('kursus.index') ? 'bg-blue-800' : '' }}">
                        Kursus
                    </a>
                    <a href="{{ route('peserta.index') }}" class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('peserta.index') ? 'bg-blue-800' : '' }}">
                        Peserta
                    </a>
                    <a href="{{ route('pendaftaran.index') }}" class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('pendaftaran.index') ? 'bg-blue-800' : '' }}">
                        Pendaftaran
                    </a>
                    <a href="{{ route('materi') }}" class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('materi') ? 'bg-blue-800' : '' }}">
                        Materi
                    </a>
                </nav>
            </div>

            <div class="px-6 py-4 border-t border-blue-700">
                <div class="text-sm mb-2">👤 {{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-300 hover:text-white">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Content -->
        <main class="ml-64 flex-1 p-6">
            @if (isset($header))
                <header class="mb-4">
                    <h1 class="text-2xl font-semibold text-gray-800">{{ $header }}</h1>
                </header>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>
</html>
