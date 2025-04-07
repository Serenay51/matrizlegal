<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Leyes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Leyes Registradas') }}</h3>
                        <a href="{{ route('laws.create') }}" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-600">
                            {{ __('Agregar Nueva Ley') }}
                        </a>
                    </div>

                    <table class="min-w-full bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Título</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Categoría</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Descripción</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Fecha de Creación</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Enlace</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($laws as $law)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $law->title }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $law->category }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $law->description }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $law->law_creation_date }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">
                                        <a href="{{ $law->link }}" target="_blank" class="text-blue-500 hover:text-blue-700">Ver Ley</a>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">
                                        <!--<a href="{1{ route('laws.edit', $law->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>-->
                                        <!--<form action="{1{ route('laws.destroy', $law->id) }}" method="POST" class="inline">
                                            1@csrf
                                            1@method('DELETE')-->
                                            <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $laws->links() }} <!-- Paginación -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
