<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cliente;

class ClienteForm extends Component
{
    public $clienteId;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;

    public $esEdicion = false;

    public function mount(Cliente $cliente = null)
    {
        if ($cliente && $cliente->exists) {
            $this->clienteId = $cliente->id;
            $this->nombre = $cliente->nombre;
            $this->email = $cliente->email;
            $this->telefono = $cliente->telefono;
            $this->esEdicion = true;
        }
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefono' => 'nullable|string|max:20',
        ];
    }

    public function guardar()
    {
        $this->validate();

        Cliente::updateOrCreate(
            ['id' => $this->clienteId],
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'telefono' => $this->telefono,
            ]
        );

        session()->flash('success', $this->esEdicion ? 'Cliente actualizado correctamente.' : 'Cliente creado correctamente.');

        return redirect()->route('clientes.index');
    }

    public function render()
    {
        return view('livewire.cliente-form');
    }
}
