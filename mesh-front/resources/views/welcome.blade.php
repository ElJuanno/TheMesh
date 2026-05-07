<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Generador IA de Modelos STL</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-gray-900 dark:text-white">
        <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">
                    Generador IA de Modelos 3D STL
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
                    Crea modelos 3D imprimibles con inteligencia artificial. Describe lo que necesitas y obtén archivos STL listos para imprimir. Genera personajes, figuras, objetos funcionales y más.
                </p>
                
                <div class="flex gap-4 justify-center mb-12">
                    @auth
                        <a href="{{ route('generator.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
                            Ir al Generador
                        </a>
                        <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
                            Registrarse
                        </a>
                    @endauth
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">🎯 Fácil de usar</h3>
                        <p class="text-gray-600 dark:text-gray-400">Solo describe lo que necesitas y la IA genera el modelo STL automáticamente.</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">✓ Validación automática</h3>
                        <p class="text-gray-600 dark:text-gray-400">Todos los modelos son validados para asegurar que sean imprimibles.</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">📦 Listo para imprimir</h3>
                        <p class="text-gray-600 dark:text-gray-400">Descarga archivos STL optimizados para FDM, resina y más.</p>
                    </div>
                </div>

                <div class="mt-12 text-sm text-gray-500 dark:text-gray-500">
                    <p>Ejemplos: "genera un pikachu" • "genera un heroe grande" • "genera una estrella de 80mm" • "genera un corazon pequeño" • "genera un soporte para celular en PLA" • "genera una caja de 100mm"</p>
                </div>
            </div>
        </div>
    </body>
</html>
