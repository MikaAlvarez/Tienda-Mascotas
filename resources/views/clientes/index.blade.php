@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">🐶 Listado de Clientes</h1>

    <a href="{{ route('clientes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">➕ Nuevo Cliente</a>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow-sm text-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nombre</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Teléfono</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $cliente->id }}</td>
                        <td class="border px-4 py-2">{{ $cliente->nombre }}</td>
                        <td class="border px-4 py-2">{{ $cliente->email }}</td>
                        <td class="border px-4 py-2">{{ $cliente->telefono }}</td>
                        <td class="border px-4 py-2 space-x-2 text-center">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">✏️ Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('¿Estás seguro de eliminar este cliente?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">No hay clientes registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
