<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generador IA de Modelos STL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de éxito/error -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Formulario de generación -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Genera tu modelo 3D imprimible</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Describe el modelo que deseas generar. Puedes especificar dimensiones, material, tipo de impresión y características especiales.
                    </p>

                    <form method="POST" action="{{ route('generator.generate') }}" id="generatorForm" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="prompt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Prompt de generación
                            </label>
                            <textarea 
                                name="prompt" 
                                id="prompt" 
                                rows="4" 
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                                placeholder="Ejemplo: genera un soporte para celular grande en PLA"
                                required
                                minlength="5"
                                maxlength="1000"
                            >{{ old('prompt') }}</textarea>
                            @error('prompt')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subir imagen (opcional) -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                O sube una imagen (opcional)
                            </label>
                            <div class="flex items-center gap-4">
                                <input 
                                    type="file" 
                                    name="image" 
                                    id="image" 
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                    class="block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-700
                                        hover:file:bg-indigo-100
                                        dark:file:bg-indigo-900 dark:file:text-indigo-300
                                        dark:hover:file:bg-indigo-800"
                                    onchange="previewImage(event)"
                                />
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Sube una imagen para crear un relieve 3D o llavero personalizado (JPG, PNG, máx 10MB)
                            </p>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            
                            <!-- Preview de imagen -->
                            <div id="imagePreview" class="mt-3 hidden">
                                <img id="previewImg" src="" alt="Preview" class="max-w-xs rounded border border-gray-300 dark:border-gray-700">
                            </div>
                        </div>

                        <!-- Ejemplos rápidos -->
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ejemplos rápidos:</p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" onclick="setPrompt('genera un pikachu')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Pikachu
                                </button>
                                <button type="button" onclick="setPrompt('genera un heroe grande')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Héroe grande
                                </button>
                                <button type="button" onclick="setPrompt('genera un soporte para celular grande en PLA')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Soporte celular PLA
                                </button>
                                <button type="button" onclick="setPrompt('genera una estrella de 80mm')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Estrella 80mm
                                </button>
                                <button type="button" onclick="setPrompt('genera un corazon pequeño')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Corazón pequeño
                                </button>
                                <button type="button" onclick="setPrompt('genera un llavero')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Llavero
                                </button>
                                <button type="button" onclick="setPrompt('genera una caja de 100mm')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Caja 100mm
                                </button>
                                <button type="button" onclick="setPrompt('genera un animal')" class="text-xs bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded">
                                    Animal
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button 
                                type="submit" 
                                id="submitBtn"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline"
                            >
                                Generar STL
                            </button>
                            <span id="loadingText" class="text-sm text-gray-600 dark:text-gray-400 hidden">
                                Generando modelo... esto puede tomar unos segundos
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Historial de modelos -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Historial de modelos generados</h3>

                    @if ($models->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($models as $model)
                                <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 hover:shadow-lg transition">
                                    <!-- Estado -->
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-semibold px-2 py-1 rounded
                                            @if($model->status === 'completed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                            @elseif($model->status === 'failed') bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                                            @else bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                                            @endif">
                                            {{ ucfirst($model->status) }}
                                        </span>
                                        @if($model->watertight)
                                            <span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded">
                                                ✓ Watertight
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Prompt -->
                                    <p class="text-sm font-medium mb-2 line-clamp-2">{{ $model->prompt }}</p>

                                    <!-- Metadata -->
                                    <div class="text-xs text-gray-600 dark:text-gray-400 space-y-1 mb-3">
                                        @if($model->filename)
                                            <p><strong>Archivo:</strong> {{ $model->filename }}</p>
                                        @endif
                                        @if($model->object_type)
                                            <p><strong>Tipo:</strong> {{ $model->object_type }}</p>
                                        @endif
                                        @if($model->material)
                                            <p><strong>Material:</strong> {{ $model->material }}</p>
                                        @endif
                                        @if($model->print_type)
                                            <p><strong>Impresión:</strong> {{ $model->print_type }}</p>
                                        @endif
                                        @if($model->max_dimension_mm)
                                            <p><strong>Dimensión máx:</strong> {{ $model->max_dimension_mm }} mm</p>
                                        @endif
                                        @if($model->volume_mm3)
                                            <p><strong>Volumen:</strong> {{ number_format($model->volume_mm3, 0) }} mm³</p>
                                        @endif
                                        @if($model->triangle_count)
                                            <p><strong>Triángulos:</strong> {{ number_format($model->triangle_count) }}</p>
                                        @endif
                                        <p><strong>Fecha:</strong> {{ $model->created_at->format('d/m/Y H:i') }}</p>
                                    </div>

                                    <!-- Acciones -->
                                    <div class="flex gap-2">
                                        @if($model->status === 'completed')
                                            <a href="{{ route('generator.download', $model) }}" 
                                               class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 px-4 rounded text-center">
                                                Descargar STL
                                            </a>
                                        @endif
                                        <a href="{{ route('generator.show', $model) }}" 
                                           class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-bold py-2 px-4 rounded text-center">
                                            Ver detalles
                                        </a>
                                    </div>

                                    @if($model->status === 'failed' && $model->error_message)
                                        <p class="text-xs text-red-600 dark:text-red-400 mt-2">{{ $model->error_message }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginación -->
                        <div class="mt-6">
                            {{ $models->links() }}
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No has generado ningún modelo todavía. ¡Comienza creando tu primer modelo 3D!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function setPrompt(text) {
            document.getElementById('prompt').value = text;
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').classList.add('hidden');
            }
        }

        document.getElementById('generatorForm').addEventListener('submit', function() {
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').classList.add('opacity-50', 'cursor-not-allowed');
            document.getElementById('loadingText').classList.remove('hidden');
        });
    </script>
</x-app-layout>
