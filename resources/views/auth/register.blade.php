<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h1 class="text-2xl font-bold text-blue-700 text-center">📝 Crear una cuenta</h1>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="name" class="block font-semibold">Nombre</label>
                <input id="name" class="w-full border rounded px-3 py-2 mt-1" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label for="email" class="block font-semibold">Email</label>
                <input id="email" class="w-full border rounded px-3 py-2 mt-1" type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-semibold">Contraseña</label>
                <input id="password" class="w-full border rounded px-3 py-2 mt-1" type="password" name="password" required>
                @error('password') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-semibold">Confirmar Contraseña</label>
                <input id="password_confirmation" class="w-full border rounded px-3 py-2 mt-1" type="password" name="password_confirmation" required>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                    ¿Ya tenés cuenta? Iniciá sesión
                </a>

                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Registrarse
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

