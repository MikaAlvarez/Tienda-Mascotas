<div>
    <label for="categoria_id">Categoría</label>
    <select wire:model="categoria_id" id="categoria_id" class="form-control">
        <option value="">Seleccione</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
        @endforeach
        <option value="nueva">+ Agregar nueva categoría</option>
    </select>

    @if($agregando_nueva)
        <div class="mt-2">
            <input type="text" wire:model="nueva_categoria" placeholder="Nombre de nueva categoría" class="form-control">
            <button type="button" wire:click="guardarCategoria" class="btn btn-success mt-1">Guardar Categoría</button>
        </div>
    @endif
</div>
