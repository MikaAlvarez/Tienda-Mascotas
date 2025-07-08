@extends('layouts.app')

@section('content')
<div class="py-6">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white shadow-md rounded-lg p-6 text-gray-700">

                <h3 class="text-lg font-bold mb-4">¡Bienvenido/a, {{ Auth::user()->name }}! 👋</h3>

            <p class="mb-4">Desde este panel podés acceder a las funcionalidades principales del sistema:</p>

            <ul class="list-disc list-inside space-y-2">
                <li>🔍 <strong>Ver</strong> y <strong>gestionar</strong> clientes registrados.</li>
                <li>📦 <strong>Administrar</strong> los artículos disponibles en la tienda.</li>
            </ul>

            <div class="mt-6">
                <a href="{{ route('clientes.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Ir a Clientes</a>
                <a href="{{ route('articulos.index') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 ml-2 transition">Ir a Artículos</a>
            </div>

        </div>
    </div>
</div>
@endsection


