<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>🐾 Tienda de Mascotas 🐾</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- 🔷 Navegación -->
        @include('layouts.navigation')

        <!-- 🔽 Encabezado -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- 🔽 Contenido principal -->
        <main class="flex-grow">
             @yield('content')
        </main>

        <!-- 🔻 Footer -->
        <footer class="bg-white text-center py-4 border-t text-sm text-gray-500">
            🐾 &copy; {{ date('Y') }} Tienda de Mascotas – Todos los derechos reservados 🐾
        </footer>
    </div>

    @livewireScripts
</body>
</html>

