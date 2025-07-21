<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'yaafo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    {{-- BREEZE NAVBAR --}}
    @include('layouts.navigation')

    {{-- MAIN LAYOUT AVEC SIDEBAR --}}
    <div class="flex min-h-screen">
        {{-- Sidebar visible seulement pour admin --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
            <aside class="w-64 bg-white shadow-md border-r border-gray-200 hidden md:block">
    @include('admin.partials.sidebar')
</aside>

        @endif

        {{-- Contenu principal --}}
        <div class="flex-1 p-6">
            @if (isset($header))
                <header class="bg-white shadow mb-4">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

        <main class="mt-100 bg-gray-100 min-h-screen">
    {{ $slot }}
</main>


        </div>
    </div>

</body>
</html>
