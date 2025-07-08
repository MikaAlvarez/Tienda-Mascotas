<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class CategoriaSelector extends Component
{
    public $categorias;
    public $categoria_id;
    public $nueva_categoria = '';
    public $agregando_nueva = false;

    public function mount()
    {
        $this->categorias = Categoria::all();
    }

    public function updatedCategoriaId($value)
    {
        if ($value === 'nueva') {
            $this->agregando_nueva = true;
        } else {
            $this->agregando_nueva = false;
        }
    }

    public function guardarCategoria()
    {
        $this->validate([
            'nueva_categoria' => 'required|string|max:255',
        ]);

        $categoria = Categoria::create(['nombre' => $this->nueva_categoria]);
        $this->categorias = Categoria::all();
        $this->categoria_id = $categoria->id;
        $this->nueva_categoria = '';
        $this->agregando_nueva = false;
    }

    public function render()
    {
        return view('livewire.categoria-selector');
    }
}
