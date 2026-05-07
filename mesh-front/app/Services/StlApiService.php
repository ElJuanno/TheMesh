<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StlApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.stl_api.url');
    }

    public function generate(string $prompt): array
    {
        try {
            $response = Http::timeout(120)
                ->post("{$this->baseUrl}/generate", [
                    'prompt' => $prompt,
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('FastAPI generation failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'error' => 'Error al generar el modelo 3D',
            ];
        } catch (\Exception $e) {
            Log::error('FastAPI connection error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'No se pudo conectar con el motor de generación 3D. Verifica que FastAPI esté corriendo.',
            ];
        }
    }

    public function generateFromImage($imageFile, string $prompt = null): array
    {
        try {
            $multipart = [
                [
                    'name' => 'file',
                    'contents' => fopen($imageFile->getRealPath(), 'r'),
                    'filename' => $imageFile->getClientOriginalName(),
                ],
            ];

            if ($prompt) {
                $multipart[] = [
                    'name' => 'prompt',
                    'contents' => $prompt,
                ];
            }

            $response = Http::timeout(180)
                ->attach('file', fopen($imageFile->getRealPath(), 'r'), $imageFile->getClientOriginalName())
                ->post("{$this->baseUrl}/generate-from-image", [
                    'prompt' => $prompt,
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('FastAPI image generation failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'error' => 'Error al generar el modelo 3D desde la imagen',
            ];
        } catch (\Exception $e) {
            Log::error('FastAPI image generation error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'No se pudo procesar la imagen. Verifica que FastAPI esté corriendo.',
            ];
        }
    }

    public function downloadUrl(string $path): string
    {
        return "{$this->baseUrl}/download?path=" . urlencode($path);
    }

    public function isAvailable(): bool
    {
        try {
            $response = Http::timeout(5)->get($this->baseUrl);
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
