<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Modelo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Botón volver -->
                    <div class="mb-6">
                        <a href="{{ route('generator.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                            ← Volver al generador
                        </a>
                    </div>

                    <!-- Prompt -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Prompt</h3>
                        <p class="text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900 p-4 rounded">
                            {{ $generatedModel->prompt }}
                        </p>
                    </div>

                    <!-- Estado y archivo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Estado</h3>
                            <span class="inline-block px-3 py-1 rounded font-semibold
                                @if($generatedModel->status === 'completed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                @elseif($generatedModel->status === 'failed') bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                                @else bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                                @endif">
                                {{ ucfirst($generatedModel->status) }}
                            </span>
                        </div>

                        @if($generatedModel->filename)
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Archivo</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $generatedModel->filename }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Checklist de validación -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Checklist de Validación</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="mr-2">
                                    @if($generatedModel->watertight)
                                        <span class="text-green-600 dark:text-green-400">✓</span>
                                    @else
                                        <span class="text-red-600 dark:text-red-400">✗</span>
                                    @endif
                                </span>
                                <span>Watertight (hermético)</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-2">
                                    @if($generatedModel->winding_consistent)
                                        <span class="text-green-600 dark:text-green-400">✓</span>
                                    @else
                                        <span class="text-red-600 dark:text-red-400">✗</span>
                                    @endif
                                </span>
                                <span>Normales consistentes</span>
                            </div>
                            @if($generatedModel->manifold !== null)
                            <div class="flex items-center">
                                <span class="mr-2">
                                    @if($generatedModel->manifold)
                                        <span class="text-green-600 dark:text-green-400">✓</span>
                                    @else
                                        <span class="text-red-600 dark:text-red-400">✗</span>
                                    @endif
                                </span>
                                <span>Manifold</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Metadata técnica -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Metadata Técnica</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @if($generatedModel->object_type)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tipo de objeto</p>
                                <p class="font-semibold">{{ $generatedModel->object_type }}</p>
                            </div>
                            @endif

                            @if($generatedModel->material)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Material</p>
                                <p class="font-semibold">{{ $generatedModel->material }}</p>
                            </div>
                            @endif

                            @if($generatedModel->print_type)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tipo de impresión</p>
                                <p class="font-semibold">{{ $generatedModel->print_type }}</p>
                            </div>
                            @endif

                            @if($generatedModel->max_dimension_mm)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Dimensión máxima</p>
                                <p class="font-semibold">{{ $generatedModel->max_dimension_mm }} mm</p>
                            </div>
                            @endif

                            @if($generatedModel->volume_mm3)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Volumen</p>
                                <p class="font-semibold">{{ number_format($generatedModel->volume_mm3, 2) }} mm³</p>
                            </div>
                            @endif

                            @if($generatedModel->triangle_count)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Cantidad de triángulos</p>
                                <p class="font-semibold">{{ number_format($generatedModel->triangle_count) }}</p>
                            </div>
                            @endif

                            @if($generatedModel->wall_thickness_mm)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Grosor de pared</p>
                                <p class="font-semibold">{{ $generatedModel->wall_thickness_mm }} mm</p>
                            </div>
                            @endif

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Hueco</p>
                                <p class="font-semibold">{{ $generatedModel->hollowed ? 'Sí' : 'No' }}</p>
                            </div>

                            @if($generatedModel->orientation)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Orientación</p>
                                <p class="font-semibold">{{ $generatedModel->orientation }}</p>
                            </div>
                            @endif

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Unidades</p>
                                <p class="font-semibold">{{ $generatedModel->units }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bounding Box -->
                    @if($generatedModel->bbox)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Bounding Box</h3>
                        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded">
                            <p class="font-mono text-sm">
                                [{{ implode(', ', $generatedModel->bbox) }}]
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                                [xmin, ymin, zmin, xmax, ymax, zmax]
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Respuesta completa de la API -->
                    @if($generatedModel->api_response)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Respuesta completa de la API</h3>
                        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded overflow-x-auto">
                            <pre class="text-xs">{{ json_encode($generatedModel->api_response, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                    @endif

                    <!-- Error message -->
                    @if($generatedModel->status === 'failed' && $generatedModel->error_message)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3 text-red-600 dark:text-red-400">Error</h3>
                        <div class="bg-red-100 dark:bg-red-900 p-4 rounded">
                            <p class="text-red-800 dark:text-red-200">{{ $generatedModel->error_message }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Botón de descarga -->
                    @if($generatedModel->status === 'completed')
                    <div class="flex justify-center">
                        <a href="{{ route('generator.download', $generatedModel) }}" 
                           class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg text-lg">
                            Descargar archivo STL
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
