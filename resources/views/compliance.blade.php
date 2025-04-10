<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Búsqueda de Cumplimiento Legal Ambiental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Formulario de cumplimiento --}}
                    <form method="GET" action="{{ route('compliance.search') }}" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="country" class="block text-sm font-medium">País</label>
                                <input type="text" name="country" id="country" class="w-full p-2 border rounded-md text-gray-900" value="{{ request('country') }}">
                            </div>
                            <div>
                                <label for="province" class="block text-sm font-medium">Provincia</label>
                                <input type="text" name="province" id="province" class="w-full p-2 border rounded-md text-gray-900" value="{{ request('province') }}">
                            </div>
                            <div>
                                <label for="district" class="block text-sm font-medium">Partido</label>
                                <input type="text" name="district" id="district" class="w-full p-2 border rounded-md text-gray-900" value="{{ request('district') }}">
                            </div>
                        </div>

                        <hr class="my-4 border-gray-600">

                        {{-- Residuos --}}
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Residuos</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="waste[]" value="especiales" class="mr-2" {{ in_array('especiales', (array) request('waste')) ? 'checked' : '' }}>
                                    Residuos Especiales
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="waste[]" value="generales" class="mr-2" {{ in_array('generales', (array) request('waste')) ? 'checked' : '' }}>
                                    Residuos Generales
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="waste[]" value="patogenicos" class="mr-2" {{ in_array('patogenicos', (array) request('waste')) ? 'checked' : '' }}>
                                    Residuos Patogénicos
                                </label>
                            </div>
                        </div>

                        {{-- Aparatos --}}
                        <div>
                            <h3 class="text-lg font-semibold mt-6 mb-2">Aparatos</h3>
                            <label class="flex items-center">
                                <input type="checkbox" name="equipment[]" value="presion" class="mr-2" {{ in_array('presion', (array) request('equipment')) ? 'checked' : '' }}>
                                Aparatos sometidos a presión
                            </label>
                        </div>

                        {{-- Agua --}}
                        <div>
                            <h3 class="text-lg font-semibold mt-6 mb-2">Agua</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="water[]" value="efluentes_liquidos" class="mr-2" {{ in_array('efluentes_liquidos', (array) request('water')) ? 'checked' : '' }}>
                                    Efluentes Líquidos
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="water[]" value="efluentes_gaseosos" class="mr-2" {{ in_array('efluentes_gaseosos', (array) request('water')) ? 'checked' : '' }}>
                                    Efluentes Gaseosos
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="water[]" value="extraccion_pozo" class="mr-2" {{ in_array('extraccion_pozo', (array) request('water')) ? 'checked' : '' }}>
                                    Extracción de Agua de Pozo
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="water[]" value="tratamiento_efluentes" class="mr-2" {{ in_array('tratamiento_efluentes', (array) request('water')) ? 'checked' : '' }}>
                                    Tratamientos de Efluentes
                                </label>
                            </div>
                        </div>

                        {{-- Tipo de Actividad --}}
                        <div class="mt-6">
                            <label for="activity" class="block text-sm font-medium">Tipo de Actividad</label>
                            <select name="activity" id="activity" class="w-full p-2 border rounded-md text-gray-900">
                                <option value="">Seleccionar</option>
                                <option value="agro" {{ request('activity') == 'agro' ? 'selected' : '' }}>Agro</option>
                                <option value="industria" {{ request('activity') == 'industria' ? 'selected' : '' }}>Industria</option>
                                <option value="comercio" {{ request('activity') == 'comercio' ? 'selected' : '' }}>Comercio</option>
                                <option value="servicios" {{ request('activity') == 'servicios' ? 'selected' : '' }}>Servicios</option>
                            </select>
                        </div>

                        <div class="flex items-center mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Buscar</button>
                            <a href="{{ route('compliance.search') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Borrar filtros</a>
                        </div>
                    </form>

                    {{-- Resultados --}}
                    @if(isset($laws) && $laws->count() > 0)
                        <h3 class="text-lg font-bold mt-8">Leyes encontradas:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                            @foreach($laws as $law)
                                <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4">
                                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $law->title }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        <strong>Categoría:</strong> {{ $law->category }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        <strong>Descripción:</strong> {{ $law->description }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        <strong>Fecha:</strong> {{ $law->law_creation_date }}
                                    </p>
                                    <a href="{{ $law->link }}" target="_blank" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Ver ley completa
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @elseif(request()->all())
                        <p class="text-gray-500 dark:text-gray-400 mt-6">No se encontraron leyes con los filtros aplicados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
