<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-gray-900">
                    Iniciar sesión
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Panel administrativo - Salón de Belleza
                </p>
            </div>

            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-red-600">Ups, revisa estos campos:</div>
                    <ul class="mt-2 text-sm text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="email">
                        Correo electrónico
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="password">
                        Contraseña
                    </label>
                    <input id="password" type="password" name="password" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Recordarme --}}
                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800"
                           href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                {{-- Botón --}}
                <div class="mb-4">
                    <button type="submit"
                        class="w-full inline-flex justify-center px-4 py-2 bg-indigo-600 border border-transparent 
                               rounded-md font-semibold text-sm text-white uppercase tracking-widest 
                               hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                               focus:ring-indigo-500">
                        Entrar
                    </button>
                </div>

                {{-- Enlace a registro --}}
                @if (Route::has('register'))
                    <p class="text-center text-sm text-gray-600">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                            Regístrate aquí
                        </a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>
