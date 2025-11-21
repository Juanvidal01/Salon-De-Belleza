<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('citas.store') }}" id="formCita">
                        @csrf

                        <!-- Paso 1: Seleccionar Servicios -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Paso 1: Selecciona los servicios</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($servicios as $servicio)
                                    <label class="relative flex items-start p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition servicio-card">
                                        <input type="checkbox" 
                                               name="servicios[]" 
                                               value="{{ $servicio->id }}"
                                               class="servicio-checkbox mt-1"
                                               data-precio="{{ $servicio->precio }}"
                                               data-duracion="{{ $servicio->duracion_minutos }}">
                                        
                                        <div class="ml-3 flex-1">
                                            <span class="block font-semibold text-gray-900">{{ $servicio->nombre }}</span>
                                            <span class="block text-sm text-gray-600 mt-1">{{ $servicio->descripcion }}</span>
                                            <div class="mt-2 flex items-center justify-between">
                                                <span class="text-lg font-bold text-indigo-600">${{ number_format($servicio->precio, 2) }}</span>
                                                <span class="text-sm text-gray-500">{{ $servicio->duracion_minutos }} min</span>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            @error('servicios')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <!-- Resumen de selección -->
                            <div class="mt-6 p-4 bg-indigo-50 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-semibold">Servicios seleccionados: </span>
                                        <span id="serviciosCount">0</span>
                                    </div>
                                    <div>
                                        <span class="font-semibold">Total: </span>
                                        <span class="text-2xl font-bold text-indigo-600" id="totalPrecio">$0.00</span>
                                    </div>
                                    <div>
                                        <span class="font-semibold">Duración estimada: </span>
                                        <span id="duracionTotal">0 min</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 2: Seleccionar Fecha -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Paso 2: Selecciona la fecha</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de la cita</label>
                                    <input type="date" 
                                           name="fecha" 
                                           id="fecha" 
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           min="{{ date('Y-m-d') }}"
                                           required>
                                    @error('fecha')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Hora de la cita</label>
                                    <select name="hora" 
                                            id="hora" 
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            required
                                            disabled>
                                        <option value="">Selecciona primero una fecha</option>
                                    </select>
                                    @error('hora')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    
                                    <div id="loadingHorarios" class="hidden mt-2 text-sm text-gray-500">
                                        <svg class="animate-spin h-4 w-4 inline mr-2" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Cargando horarios disponibles...
                                    </div>
                                </div>
                            </div>

                            <!-- Información de horarios -->
                            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <h4 class="font-semibold text-blue-900 mb-2">📅 Horarios de atención:</h4>
                                <div class="text-sm text-blue-800 space-y-1">
                                    @foreach($horarios as $horario)
                                        <div>
                                            <strong>{{ ucfirst($horario->dia_semana) }}:</strong> 
                                            {{ date('g:i A', strtotime($horario->hora_inicio)) }} - {{ date('g:i A', strtotime($horario->hora_fin)) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Paso 3: Notas adicionales (opcional) -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Paso 3: Notas adicionales (opcional)</h3>
                            
                            <textarea name="notas" 
                                      id="notas" 
                                      rows="3" 
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="¿Alguna preferencia o comentario especial?">{{ old('notas') }}</textarea>
                            @error('notas')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('dashboard') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg">
                                Cancelar
                            </a>
                            
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition disabled:opacity-50"
                                    id="btnSubmit"
                                    disabled>
                                Reservar Cita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        console.log('Script cargado correctamente');
        
        // TODO envuelto en DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM completamente cargado');
            
            // Variables globales
            let totalPrecio = 0;
            let totalDuracion = 0;
            let serviciosSeleccionados = 0;

            // Actualizar resumen de servicios
            function actualizarResumen() {
                document.getElementById('serviciosCount').textContent = serviciosSeleccionados;
                document.getElementById('totalPrecio').textContent = '$' + totalPrecio.toFixed(2);
                document.getElementById('duracionTotal').textContent = totalDuracion + ' min';
                
                // Habilitar/deshabilitar botón de submit
                const btnSubmit = document.getElementById('btnSubmit');
                const hora = document.getElementById('hora').value;
                
                if (serviciosSeleccionados > 0 && hora) {
                    btnSubmit.disabled = false;
                } else {
                    btnSubmit.disabled = true;
                }
            }

            // Formatear hora en formato 12h
            function formatearHora(hora24) {
                const [hours, minutes] = hora24.split(':');
                const hour = parseInt(hours);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const hour12 = hour % 12 || 12;
                return `${hour12}:${minutes} ${ampm}`;
            }

            // Event listener para checkboxes de servicios
            const checkboxes = document.querySelectorAll('.servicio-checkbox');
            console.log('Checkboxes encontrados:', checkboxes.length);
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    console.log('Checkbox cambió:', this.checked, this.dataset.precio);
                    
                    const precio = parseFloat(this.dataset.precio);
                    const duracion = parseInt(this.dataset.duracion);
                    
                    if (this.checked) {
                        totalPrecio += precio;
                        totalDuracion += duracion;
                        serviciosSeleccionados++;
                        this.closest('.servicio-card').classList.add('border-indigo-500', 'bg-indigo-50');
                    } else {
                        totalPrecio -= precio;
                        totalDuracion -= duracion;
                        serviciosSeleccionados--;
                        this.closest('.servicio-card').classList.remove('border-indigo-500', 'bg-indigo-50');
                    }
                    
                    actualizarResumen();
                });
            });

            // Event listener para fecha
            const fechaInput = document.getElementById('fecha');
            console.log('Fecha input encontrado:', fechaInput);
            
            if (fechaInput) {
                fechaInput.addEventListener('change', function() {
                    console.log('Fecha seleccionada:', this.value);
                    
                    const fecha = this.value;
                    const horaSelect = document.getElementById('hora');
                    const loading = document.getElementById('loadingHorarios');
                    
                    if (!fecha) return;
                    
                    // Mostrar loading
                    loading.classList.remove('hidden');
                    horaSelect.disabled = true;
                    horaSelect.innerHTML = '<option value="">Cargando...</option>';
                    
                    // URL para la API
                    const url = `{{ route('api.horarios-disponibles') }}?fecha=${fecha}`;
                    console.log('Fetching:', url);
                    
                    // Fetch horarios disponibles
                    fetch(url)
                        .then(response => {
                            console.log('Response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Data recibida:', data);
                            loading.classList.add('hidden');
                            
                            if (data.success && data.horarios.length > 0) {
                                horaSelect.innerHTML = '<option value="">Selecciona una hora</option>';
                                
                                data.horarios.forEach(hora => {
                                    const option = document.createElement('option');
                                    option.value = hora;
                                    option.textContent = formatearHora(hora);
                                    horaSelect.appendChild(option);
                                });
                                
                                horaSelect.disabled = false;
                            } else {
                                horaSelect.innerHTML = '<option value="">No hay horarios disponibles</option>';
                                console.warn('No hay horarios disponibles para:', fecha);
                            }
                        })
                        .catch(error => {
                            console.error('Error al cargar horarios:', error);
                            loading.classList.add('hidden');
                            horaSelect.innerHTML = '<option value="">Error al cargar horarios</option>';
                        });
                });
            }

            // Event listener para hora
            const horaSelect = document.getElementById('hora');
            console.log('Hora select encontrado:', horaSelect);
            
            if (horaSelect) {
                horaSelect.addEventListener('change', function() {
                    console.log('Hora seleccionada:', this.value);
                    actualizarResumen();
                });
            }

            // Validación antes de enviar
            const formCita = document.getElementById('formCita');
            console.log('Formulario encontrado:', formCita);
            
            if (formCita) {
                formCita.addEventListener('submit', function(e) {
                    console.log('Intentando enviar formulario');
                    
                    if (serviciosSeleccionados === 0) {
                        e.preventDefault();
                        alert('Debes seleccionar al menos un servicio');
                        return false;
                    }
                    
                    console.log('Formulario válido, enviando...');
                });
            }
        });
    </script>
    @endpush
</x-app-layout>