@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4">Editar Artículo</h1>

    <form action="{{ route('articulos.update', $articulo) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nombre</label>
            <input type="text" name="nombre" class="w-full border rounded px-3 py-2" value="{{ old('nombre', $articulo->nombre) }}">
            @error('nombre') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block font-semibold">Descripción</label>
            <textarea name="descripcion" class="w-full border rounded px-3 py-2">{{ old('descripcion', $articulo->descripcion) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Precio</label>
            <input type="number" name="precio" step="0.01" class="w-full border rounded px-3 py-2" value="{{ old('precio', $articulo->precio) }}">
            @error('precio') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block font-semibold">Stock</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" value="{{ old('stock', $articulo->stock) }}">
            @error('stock') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label class="block font-semibold">Categoría</label>
            <select name="categoria_id" class="w-full border rounded px-3 py-2">
                <option value="">Seleccione</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $articulo->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
    </form>
</div>
@endsection
