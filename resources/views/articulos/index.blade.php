@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4">Listado de Artículos</h1>

    <a href="{{ route('articulos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Nuevo Artículo</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-6 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Precio</th>
                <th class="border px-4 py-2">Stock</th>
                <th class="border px-4 py-2">Categoría</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulos as $articulo)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $articulo->id }}</td>
                    <td class="border px-4 py-2">{{ $articulo->nombre }}</td>
                    <td class="border px-4 py-2">${{ $articulo->precio }}</td>
                    <td class="border px-4 py-2">{{ $articulo->stock }}</td>
                    <td class="border px-4 py-2">{{ $articulo->categoria->nombre }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('articulos.edit', $articulo) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Editar</a>
                        <form action="{{ route('articulos.destroy', $articulo) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Estás seguro?')" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
