<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cita') }}
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

                    <form method="POST" action="{{ route('citas.update', $cita) }}" id="formCita">
                        @csrf
                        @method('PUT')

                        <!-- Paso 1: Seleccionar Servicios -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Paso 1: Servicios</h3>
                            
                            @php
                                $serviciosActuales = $cita->servicios->pluck('id')->toArray();
                            @endphp

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($servicios as $servicio)
                                    @php
                                        $isChecked = in_array($servicio->id, $serviciosActuales);
                                    @endphp
                                    <label class="relative flex items-start p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition servicio-card {{ $isChecked ? 'border-indigo-500 bg-indigo-50' : '' }}">
                                        <input type="checkbox" 
                                               name="servicios[]" 
                                               value="{{ $servicio->id }}"
                                               class="servicio-checkbox mt-1"
                                               data-precio="{{ $servicio->precio }}"
                                               data-duracion="{{ $servicio->duracion_minutos }}"
                                               {{ $isChecked ? 'checked' : '' }}>
                                        
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

                            <!-- Resumen -->
                            <div class="mt-6 p-4 bg-indigo-50 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-semibold">Servicios: </span>
                                        <span id="serviciosCount">{{ count($serviciosActuales) }}</span>
                                    </div>
                                    <div>
                                        <span class="font-semibold">Total: </span>
                                        <span class="text-2xl font-bold text-indigo-600" id="totalPrecio">${{ number_format($cita->total, 2) }}</span>
                                    </div>
                                    <div>
                                        <span class="font-semibold">Duración: </span>
                                        <span id="duracionTotal">{{ $cita->servicios->sum('duracion_minutos') }} min</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 2: Fecha y Hora -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Paso 2: Fecha y Hora</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                                    <input type="date" 
                                           name="fecha" 
                                           id="fecha" 
                                           value="{{ $cita->fecha->format('Y-m-d') }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           min="{{ date('Y-m-d') }}"
                                           required>
                                    @error('fecha')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Hora</label>
                                    <select name="hora" 
                                            id="hora" 
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            required>
                                        <option value="{{ $cita->hora }}">{{ date('g:i A', strtotime($cita->hora)) }} (actual)</option>
                                    </select>
                                    @error('hora')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    
                                    <div id="loadingHorarios" class="hidden mt-2 text-sm text-gray-500">
                                        Cargando horarios...
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 3: Notas -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Paso 3: Notas</h3>
                            
                            <textarea name="notas" 
                                      id="notas" 
                                      rows="3" 
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Notas adicionales...">{{ old('notas', $cita->notas) }}</textarea>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('citas.show', $cita) }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg">
                                Cancelar
                            </a>
                            
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition"
                                    id="btnSubmit">
                                Actualizar Cita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let totalPrecio = {{ $cita->total }};
        let totalDuracion = {{ $cita->servicios->sum('duracion_minutos') }};
        let serviciosSeleccionados = {{ count($serviciosActuales) }};

        function actualizarResumen() {
            document.getElementById('serviciosCount').textContent = serviciosSeleccionados;
            document.getElementById('totalPrecio').textContent = '$' + totalPrecio.toFixed(2);
            document.getElementById('duracionTotal').textContent = totalDuracion + ' min';
        }

        document.querySelectorAll('.servicio-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
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

        document.getElementById('fecha').addEventListener('change', function() {
            const fecha = this.value;
            const horaSelect = document.getElementById('hora');
            const loading = document.getElementById('loadingHorarios');
            
            loading.classList.remove('hidden');
            
            fetch(`{{ route('api.horarios-disponibles') }}?fecha=${fecha}`)
                .then(response => response.json())
                .then(data => {
                    loading.classList.add('hidden');
                    
                    if (data.success && data.horarios.length > 0) {
                        horaSelect.innerHTML = '<option value="">Selecciona una hora</option>';
                        
                        data.horarios.forEach(hora => {
                            const option = document.createElement('option');
                            option.value = hora;
                            option.textContent = formatearHora(hora);
                            horaSelect.appendChild(option);
                        });
                    } else {
                        horaSelect.innerHTML = '<option value="">No hay horarios disponibles</option>';
                    }
                });
        });

        function formatearHora(hora24) {
            const [hours, minutes] = hora24.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const hour12 = hour % 12 || 12;
            return `${hour12}:${minutes} ${ampm}`;
        }
    </script>
    @endpush
</x-app-layout>