<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">¡Bienvenido!</h3>
                    <p class="mb-4">Has iniciado sesión correctamente. Ahora puedes generar modelos 3D STL con inteligencia artificial.</p>
                    <a href="{{ route('generator.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                        Ir al Generador STL
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="font-semibold mb-2">🎯 Generador de Modelos</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Crea modelos 3D imprimibles describiendo lo que necesitas.</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="font-semibold mb-2">📦 Historial</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Accede a todos tus modelos generados y descárgalos cuando quieras.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
