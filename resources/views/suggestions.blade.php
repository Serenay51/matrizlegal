<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sugerencias y Cambios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4">
                        Envíanos tus sugerencias o cambios para mejorar nuestra plataforma. ¡Tu opinión es importante para nosotros!
                    </p>

                    {{-- Formulario de sugerencias --}}
                    <form method="POST" action="{{ route('suggestions.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium">Tu Nombre</label>
                            <input type="text" name="name" id="name" class="w-full p-2 border rounded-md text-gray-900" placeholder="Ingresa tu nombre" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium">Tu Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="w-full p-2 border rounded-md text-gray-900" placeholder="Ingresa tu correo electrónico" required>
                        </div>
                        <div class="mb-4">
                            <label for="suggestion" class="block text-sm font-medium">Tu Sugerencia</label>
                            <textarea name="suggestion" id="suggestion" rows="5" class="w-full p-2 border rounded-md text-gray-900" placeholder="Escribe tu sugerencia o cambio aquí..." required></textarea>
                        </div>
                        <div class="flex items-center">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Enviar</button>
                            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>