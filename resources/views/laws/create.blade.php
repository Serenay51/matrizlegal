<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Nueva Ley') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('laws.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Título de la Ley') }}</label>
                                <input type="text" id="title" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200" required>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Categoría') }}</label>
                                <select id="category" name="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200" required>
                                    <option value="Nacional">{{ __('Nacional') }}</option>
                                    <option value="Provincial">{{ __('Provincial') }}</option>
                                    <option value="CABA">{{ __('CABA') }}</option>
                                    <option value="La Matanza">{{ __('La Matanza') }}</option>
                                </select>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Descripción') }}</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200" required></textarea>
                            </div>

                            <div>
                                <label for="law_creation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Fecha de Creación de la Ley') }}</label>
                                <input type="date" id="law_creation_date" name="law_creation_date" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Enlace a la Ley Completa') }}</label>
                                <input type="url" id="link" name="link" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200" required>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-600">
                                {{ __('Agregar Ley') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
