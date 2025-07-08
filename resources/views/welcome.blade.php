<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h1 class="text-2xl font-bold text-blue-700 text-center">🐾 Ingresá a tu cuenta</h1>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block font-semibold">Email</label>
                <input id="email" class="w-full border rounded px-3 py-2 mt-1" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-semibold">Contraseña</label>
                <input id="password" class="w-full border rounded px-3 py-2 mt-1" type="password" name="password" required>
                @error('password') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-300">
                    <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('register') }}">
                    ¿No tenés cuenta? Registrate 📝
                </a>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Ingresar
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
