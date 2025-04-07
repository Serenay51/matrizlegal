<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Búsqueda de Leyes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Verificar si el usuario está bloqueado --}}
                    @if(auth()->user()->bloqueado)
                        <div class="text-center">
                            <p class="text-red-500 font-bold">Has alcanzado el límite de 5 búsquedas. Suscríbete al plan premium para continuar buscando leyes.</p>
                            <button onclick="subscribe()" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Suscribirse</button>
                        </div>
                    @else
                        {{-- Verificar si el usuario tiene búsquedas disponibles --}}
                        @if(auth()->user()->is_admin == 1 || session('search_count', 0) < 5)
                            {{-- Formulario de búsqueda --}}
                            <div id="basic-search" class="mb-4">
                                <form method="GET" action="{{ route('laws.search') }}">
                                    <input type="text" name="query" placeholder="Buscar ley..."
                                           class="w-full p-2 border rounded-md text-gray-900" value="{{ request('query') }}">
                                    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Buscar</button>
                                </form>
                            </div>

                            {{-- Búsqueda avanzada --}}
                            <details id="advanced-search" class="mb-4">
                                <summary class="cursor-pointer text-blue-500 underline">Búsqueda avanzada</summary>
                                <form method="GET" action="{{ route('laws.search') }}" class="mt-2">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium">Título</label>
                                            <input type="text" name="name" id="name" class="w-full p-2 border rounded-md text-gray-900" value="{{ request('name') }}">
                                        </div>
                                        <div>
                                            <label for="category" class="block text-sm font-medium">Categoría</label>
                                            <select name="category" id="category" class="w-full p-2 border rounded-md text-gray-900">
                                                <option value="">Seleccionar</option>
                                                <option value="Nacional" {{ request('category') == 'Nacional' ? 'selected' : '' }}>Nacional</option>
                                                <option value="Provincial" {{ request('category') == 'Provincial' ? 'selected' : '' }}>Provincial</option>
                                                <option value="CABA" {{ request('category') == 'CABA' ? 'selected' : '' }}>CABA</option>
                                                <option value="La Matanza" {{ request('category') == 'La Matanza' ? 'selected' : '' }}>La Matanza</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="description" class="block text-sm font-medium">Descripción</label>
                                            <input type="text" name="description" id="description" class="w-full p-2 border rounded-md text-gray-900" value="{{ request('description') }}">
                                        </div>
                                        <div>
                                            <label for="date_from" class="block text-sm font-medium">Fecha desde</label>
                                            <input type="date" name="date_from" id="date_from" class="w-full p-2 border rounded-md text-gray-900" value="{{ request('date_from') }}">
                                        </div>
                                        <div>
                                            <label for="date_to" class="block text-sm font-medium">Fecha hasta</label>
                                            <input type="date" name="date_to" id="date_to" class="w-full p-2 border rounded-md text-gray-900" value="{{ request('date_to') }}">
                                        </div>
                                    </div>
                                    <div class="flex items-center mt-4">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Buscar</button>
                                        <a href="{{ route('laws.search') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Borrar filtros</a>
                                    </div>
                                </form>
                            </details>

                            {{-- Resultados de búsqueda --}}
                            @if(isset($laws) && $laws->count() > 0)
                                <h3 class="text-lg font-bold mt-4">Resultados:</h3>
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
                                                <strong>Fecha de creación:</strong> {{ $law->law_creation_date }}
                                            </p>
                                            <a href="{{ $law->link }}" target="_blank" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                Ver ley completa
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 mt-4">No se encontraron resultados para tu búsqueda.</p>
                            @endif
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Footer --}}
<footer class="bg-gray-800 text-white py-8">
    <div class="columns flex justify-between px-6 py-4">
        {{-- Columna 1: Logo e información --}}
        <div class="mb-3">
            <a href="/" class="flex items-center mb-3 text-white text-decoration-none">
                <img src="/images/serleg-icon.png" alt="Logo de SERLEG" style="width: 50px; height: 50px;" class="mt-3 mr-3">
                <span class="mt-2 ml-3 text-2xl font-bold">SERLEG</span>
            </a>
            <p class="text-sm text-gray-400">© 2025 SERLEG</p>
        </div>
        <div class="mb-3">
            <h5 class="text-lg font-bold mb-2">Información</h5>
            <ul class="list-none">
                <li><a href="#" class="text-gray-400 hover:text-white">Sobre nosotros</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white">Contáctanos</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white">Política de privacidad</a></li>
            </ul>
        </div>
        {{-- Columna 2: Redes sociales --}}
        <div class="mb-3">
            <h5 class="text-lg font-bold mb-2">Redes Sociales</h5>
            <ul class="list-none">
                <li><a href="#" class="text-gray-400 hover:text-white">Facebook</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white">Twitter</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white">Instagram</a></li>
            </ul>
        </div>
        {{-- Columna 3: Suscripción --}}
        <div class="mb-3">
            <h5 class="text-lg font-bold mb-2">Suscríbete</h5>
            <p class="text-gray-400">Recibe las últimas actualizaciones y noticias.</p>
            <form action="#" method="POST" class="mt-2">
                <input type="email" name="email" placeholder="Tu correo electrónico" class="p-2 rounded-md text-gray-900">
                <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Suscribirse</button>
            </form>
        </div>
    </div>
    <hr class="my-4 border-gray-700">
    <div class="text-center mt-4">
        <p class="text-sm text-gray-400">Desarrollado por © 2025 SERLEG</p>
        <p class="text-sm text-gray-400">Todos los derechos reservados</p>
    </div>
</footer>

{{-- SweetAlert2 Script --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function subscribe() {
        Swal.fire({
            title: '¡Obtén el plan premium!',
            text: 'Suscríbete para continuar buscando leyes sin restricciones.',
            icon: 'info',
            confirmButtonText: 'Suscribirse',
            confirmButtonColor: '#7acc61',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('payment.form') }}";
            }
        });
    }

    const advancedSearch = document.getElementById('advanced-search');
    const basicSearch = document.getElementById('basic-search');

    advancedSearch.addEventListener('toggle', () => {
        if (advancedSearch.open) {
            basicSearch.style.display = 'none';
        } else {
            basicSearch.style.display = 'block';
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        @if(auth()->user()->is_admin == 0)
            setTimeout(() => {
                Swal.fire({
                    title: '<img src="/images/serleg-icon.png" alt="SERLEG" style="width: 50px; height: 50px; display: block; margin: 0 auto;">',
                    html: '<p style="margin-top: 10px;">Disfruta de búsquedas ilimitadas y acceso completo con el plan premium.</p>',
                    showCloseButton: true,
                    confirmButtonText: 'Suscribirse',
                    confirmButtonColor: '#7acc61',
                    toast: true,
                    position: 'top-end',
                    timer: 10000,
                    timerProgressBar: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('payment.form') }}";
                    }
                });
            }, 5000); // Mostrar el popup 5 segundos después de cargar el dashboard
        @endif
    });

    @if(session('success'))
            Swal.fire({
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
    @endif
</script>