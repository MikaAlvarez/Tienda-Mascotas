<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create'); // Muestra el componente Livewire ClienteForm
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente')); // Muestra el componente Livewire ClienteForm con datos
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}

