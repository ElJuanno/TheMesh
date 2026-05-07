<?php

namespace App\Http\Controllers;

use App\Models\GeneratedModel;
use App\Services\StlApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StlGeneratorController extends Controller
{
    protected StlApiService $stlApiService;

    public function __construct(StlApiService $stlApiService)
    {
        $this->stlApiService = $stlApiService;
    }

    public function index()
    {
        $models = Auth::user()
            ->generatedModels()
            ->latest()
            ->paginate(10);

        return view('generator.index', compact('models'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|min:5|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        $prompt = $request->input('prompt');

        // Crear registro inicial
        $model = GeneratedModel::create([
            'user_id' => Auth::id(),
            'prompt' => $prompt,
            'status' => 'pending',
        ]);

        // Si hay imagen, usar endpoint de imagen
        if ($request->hasFile('image')) {
            $response = $this->stlApiService->generateFromImage(
                $request->file('image'),
                $prompt
            );
        } else {
            // Llamar a FastAPI con texto
            $response = $this->stlApiService->generate($prompt);
        }

        if (isset($response['success']) && $response['success']) {
            // Actualizar con datos exitosos
            $model->update([
                'status' => 'completed',
                'filename' => $response['filename'] ?? null,
                'file_path' => $response['path'] ?? null,
                'object_type' => $response['object_type'] ?? null,
                'units' => $response['units'] ?? 'mm',
                'bbox' => $response['bbox'] ?? null,
                'max_dimension_mm' => $response['max_dimension_mm'] ?? null,
                'volume_mm3' => $response['volume_mm3'] ?? null,
                'triangle_count' => $response['triangle_count'] ?? null,
                'watertight' => $response['watertight'] ?? false,
                'winding_consistent' => $response['winding_consistent'] ?? false,
                'manifold' => $response['manifold'] ?? null,
                'print_type' => $response['print_type'] ?? null,
                'material' => $response['material'] ?? null,
                'hollowed' => $response['hollowed'] ?? false,
                'wall_thickness_mm' => $response['wall_thickness_mm'] ?? null,
                'orientation' => $response['orientation'] ?? null,
                'api_response' => $response,
            ]);

            return redirect()
                ->route('generator.index')
                ->with('success', '¡Modelo STL generado exitosamente!');
        } else {
            // Actualizar con error
            $model->update([
                'status' => 'failed',
                'error_message' => $response['error'] ?? 'Error desconocido',
            ]);

            return redirect()
                ->route('generator.index')
                ->with('error', $response['error'] ?? 'Error al generar el modelo');
        }
    }

    public function download(GeneratedModel $generatedModel)
    {
        // Verificar que el modelo pertenezca al usuario autenticado
        if ($generatedModel->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        // Verificar que el modelo esté completado
        if ($generatedModel->status !== 'completed' || !$generatedModel->file_path) {
            abort(404, 'Archivo no disponible');
        }

        // Construir URL de descarga de FastAPI
        $downloadUrl = $this->stlApiService->downloadUrl($generatedModel->file_path);

        // Redirigir a FastAPI para la descarga
        return redirect($downloadUrl);
    }

    public function show(GeneratedModel $generatedModel)
    {
        // Verificar que el modelo pertenezca al usuario autenticado
        if ($generatedModel->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        return view('generator.show', compact('generatedModel'));
    }
}
