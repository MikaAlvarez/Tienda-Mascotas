<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>🐾 Tienda de Mascotas | Ingreso 🐾</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles + Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <!-- 🐶 Tarjeta del formulario (sin logo) -->
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-lg ring-1 ring-blue-100 rounded-lg">
            {{ $slot }}
        </div>

        <!-- 🐾 Footer simple -->
        <footer class="text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} Tienda de Mascotas 🐾 Todos los derechos reservados
        </footer>
    </div>
</body>
</html>


