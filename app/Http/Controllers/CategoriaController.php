<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Muestra una lista de categorías.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    /**
     * Almacena una nueva categoría.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            // Agrega más validaciones si tienes otros campos
        ]);

        $categoria = Categoria::create($request->all());
        return response()->json($categoria, 201); // 201 Created
    }

    /**
     * Muestra una categoría específica.
     */
    public function show(Categoria $categoria)
    {
        return response()->json($categoria);
    }

    /**
     * Actualiza una categoría existente.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            // Agrega más validaciones si tienes otros campos
        ]);

        $categoria->update($request->all());
        return response()->json($categoria);
    }

    /**
     * Elimina una categoría.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json(null, 204); // 204 No Content
    }
}