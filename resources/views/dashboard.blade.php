<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">¡Bienvenido, {{ Auth::user()->name }}!</h3>

                    @if(Auth::user()->isAdmin() || Auth::user()->isEmpleado())
                        <!-- Dashboard para Admin/Empleado -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="block p-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg text-white hover:from-blue-600 hover:to-blue-700 transition">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-blue-100 text-sm">Panel Administrativo</p>
                                        <p class="text-2xl font-bold mt-2">Dashboard</p>
                                    </div>
                                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                </div>
                            </a>

                            <a href="{{ route('admin.citas.index') }}" 
                               class="block p-6 bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg text-white hover:from-green-600 hover:to-green-700 transition">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-green-100 text-sm">Gestión de</p>
                                        <p class="text-2xl font-bold mt-2">Citas</p>
                                    </div>
                                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </a>

                            <a href="{{ route('admin.usuarios.index') }}" 
                               class="block p-6 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg text-white hover:from-purple-600 hover:to-purple-700 transition">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-purple-100 text-sm">Gestión de</p>
                                        <p class="text-2xl font-bold mt-2">Usuarios</p>
                                    </div>
                                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    @endif

                    <!-- Opciones comunes para todos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a href="{{ route('citas.create') }}" 
                           class="block p-6 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg shadow-lg text-white hover:from-indigo-600 hover:to-indigo-700 transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-indigo-100 text-sm">Reservar</p>
                                    <p class="text-2xl font-bold mt-2">Nueva Cita</p>
                                </div>
                                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </a>

                        <a href="{{ route('citas.index') }}" 
                           class="block p-6 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg text-white hover:from-orange-600 hover:to-orange-700 transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-orange-100 text-sm">Ver</p>
                                    <p class="text-2xl font-bold mt-2">Mis Citas</p>
                                </div>
                                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </a>

                        <a href="{{ route('servicios.index') }}" 
                           class="block p-6 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-lg text-white hover:from-pink-600 hover:to-pink-700 transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-pink-100 text-sm">Explorar</p>
                                    <p class="text-2xl font-bold mt-2">Servicios</p>
                                </div>
                                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}" 
                           class="block p-6 bg-gradient-to-br from-gray-500 to-gray-600 rounded-lg shadow-lg text-white hover:from-gray-600 hover:to-gray-700 transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-100 text-sm">Editar</p>
                                    <p class="text-2xl font-bold mt-2">Mi Perfil</p>
                                </div>
                                <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>