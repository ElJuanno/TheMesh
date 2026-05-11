<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Generador IA de Modelos STL')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de éxito/error -->
            <?php if(session('success')): ?>
                <div class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mb-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Formulario de generación -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Genera tu modelo 3D imprimible</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Describe el modelo que deseas generar. Puedes especificar dimensiones, material, tipo de impresión y características especiales.
                    </p>

                    <form method="POST" action="<?php echo e(route('generator.generate')); ?>" id="generatorForm" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        
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
                            ><?php echo e(old('prompt')); ?></textarea>
                            <?php $__errorArgs = ['prompt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            
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

                    <?php if($models->count() > 0): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 hover:shadow-lg transition">
                                    <!-- Estado -->
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-semibold px-2 py-1 rounded
                                            <?php if($model->status === 'completed'): ?> bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                            <?php elseif($model->status === 'failed'): ?> bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                                            <?php else: ?> bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($model->status)); ?>

                                        </span>
                                        <?php if($model->watertight): ?>
                                            <span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded">
                                                ✓ Watertight
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Prompt -->
                                    <p class="text-sm font-medium mb-2 line-clamp-2"><?php echo e($model->prompt); ?></p>

                                    <!-- Metadata -->
                                    <div class="text-xs text-gray-600 dark:text-gray-400 space-y-1 mb-3">
                                        <?php if($model->filename): ?>
                                            <p><strong>Archivo:</strong> <?php echo e($model->filename); ?></p>
                                        <?php endif; ?>
                                        <?php if($model->object_type): ?>
                                            <p><strong>Tipo:</strong> <?php echo e($model->object_type); ?></p>
                                        <?php endif; ?>
                                        <?php if($model->material): ?>
                                            <p><strong>Material:</strong> <?php echo e($model->material); ?></p>
                                        <?php endif; ?>
                                        <?php if($model->print_type): ?>
                                            <p><strong>Impresión:</strong> <?php echo e($model->print_type); ?></p>
                                        <?php endif; ?>
                                        <?php if($model->max_dimension_mm): ?>
                                            <p><strong>Dimensión máx:</strong> <?php echo e($model->max_dimension_mm); ?> mm</p>
                                        <?php endif; ?>
                                        <?php if($model->volume_mm3): ?>
                                            <p><strong>Volumen:</strong> <?php echo e(number_format($model->volume_mm3, 0)); ?> mm³</p>
                                        <?php endif; ?>
                                        <?php if($model->triangle_count): ?>
                                            <p><strong>Triángulos:</strong> <?php echo e(number_format($model->triangle_count)); ?></p>
                                        <?php endif; ?>
                                        <p><strong>Fecha:</strong> <?php echo e($model->created_at->format('d/m/Y H:i')); ?></p>
                                    </div>

                                    <!-- Acciones -->
                                    <div class="flex gap-2">
                                        <?php if($model->status === 'completed'): ?>
                                            <a href="<?php echo e(route('generator.download', $model)); ?>" 
                                               class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 px-4 rounded text-center">
                                                Descargar STL
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('generator.show', $model)); ?>" 
                                           class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-bold py-2 px-4 rounded text-center">
                                            Ver detalles
                                        </a>
                                    </div>

                                    <?php if($model->status === 'failed' && $model->error_message): ?>
                                        <p class="text-xs text-red-600 dark:text-red-400 mt-2"><?php echo e($model->error_message); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-6">
                            <?php echo e($models->links()); ?>

                        </div>
                    <?php else: ?>
                        <p class="text-gray-600 dark:text-gray-400">No has generado ningún modelo todavía. ¡Comienza creando tu primer modelo 3D!</p>
                    <?php endif; ?>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /home/Janpo/Mesh/mesh-front/resources/views/generator/index.blade.php ENDPATH**/ ?>