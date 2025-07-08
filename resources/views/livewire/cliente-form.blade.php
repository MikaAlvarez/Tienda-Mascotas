<div class="max-w-xl mx-auto py-6 px-4 bg-white rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4">
        {{ $esEdicion ? 'Editar Cliente' : 'Nuevo Cliente' }}
    </h2>

    <form wire:submit.prevent="guardar">
        <div class="mb-4">
            <label class="block text-sm font-medium">Nombre</label>
            <input type="text" wire:model.defer="nombre" class="w-full border rounded p-2">
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Email</label>
            <input type="email" wire:model.defer="email" class="w-full border rounded p-2">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Teléfono</label>
            <input type="text" wire:model.defer="telefono" class="w-full border rounded p-2">
            @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $esEdicion ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</div>
