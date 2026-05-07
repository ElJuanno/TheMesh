# Generador IA de Modelos 3D STL

Sistema completo de generación de modelos 3D imprimibles usando Laravel 11 + FastAPI.

## Arquitectura

- **Frontend/Backend Web**: Laravel 11 (PHP)
- **Motor de Generación 3D**: FastAPI (Python)
- **Base de datos**: SQLite
- **Autenticación**: Laravel Breeze

## Estructura del Proyecto

```
Mesh/
├── mesh-front/          # Aplicación Laravel 11
│   ├── app/
│   │   ├── Http/Controllers/
│   │   │   └── StlGeneratorController.php
│   │   ├── Models/
│   │   │   ├── User.php
│   │   │   └── GeneratedModel.php
│   │   └── Services/
│   │       └── StlApiService.php
│   ├── resources/views/
│   │   └── generator/
│   │       ├── index.blade.php
│   │       └── show.blade.php
│   └── routes/web.php
│
└── mesh-backend/        # API FastAPI
    ├── app/
    │   ├── api.py
    │   ├── generator/
    │   ├── prompts/
    │   └── validator/
    └── outputs/
```

## Instalación y Configuración

### 1. Backend FastAPI

```bash
cd mesh-backend
source venv/bin/activate
pip install -r requirements.txt
```

### 2. Frontend Laravel

```bash
cd mesh-front
composer install
npm install
npm run build
php artisan migrate
```

### 3. Configuración

El archivo `.env` de Laravel ya está configurado con:

```env
FASTAPI_STL_URL=http://127.0.0.1:8000
```

## Ejecución

### Iniciar FastAPI (Terminal 1)

```bash
cd mesh-backend
source venv/bin/activate
uvicorn app.api:app --reload --port 8000
```

### Iniciar Laravel (Terminal 2)

```bash
cd mesh-front
php artisan serve --port=8080
```

## Uso

1. Accede a: http://127.0.0.1:8080
2. Regístrate o inicia sesión
3. Ve a "Generador STL" en el menú
4. Escribe un prompt, por ejemplo:
   
   **Personajes y Figuras:**
   - "genera un pikachu"
   - "genera un heroe grande"
   - "genera un personaje pequeño"
   - "genera un animal"
   
   **Formas y Objetos:**
   - "genera una estrella de 80mm"
   - "genera un corazon pequeño"
   - "genera una esfera de 60mm"
   - "genera un cubo"
   - "genera un cilindro"
   
   **Objetos Funcionales:**
   - "genera un soporte para celular grande en PLA"
   - "genera una caja de 100mm"
   - "genera un llavero"
   - "genera una base rectangular de 120mm"
   - "genera un vaso"

5. Haz clic en "Generar STL"
6. Espera a que se genere el modelo
7. Descarga el archivo STL

## Endpoints FastAPI

- `GET /` - Información de la API
- `POST /generate` - Generar modelo STL
  ```json
  {
    "prompt": "genera un soporte para celular grande en PLA"
  }
  ```
- `GET /download?path=...` - Descargar archivo STL

## Rutas Laravel

- `GET /` - Página de bienvenida
- `GET /register` - Registro de usuario
- `GET /login` - Inicio de sesión
- `GET /dashboard` - Dashboard del usuario
- `GET /generator` - Generador de modelos STL
- `POST /generator` - Generar nuevo modelo
- `GET /generator/{id}/download` - Descargar modelo
- `GET /models/{id}` - Ver detalles del modelo

## Base de Datos

### Tabla: generated_models

Almacena todos los modelos generados con su metadata:

- Información básica: prompt, filename, file_path
- Geometría: bbox, max_dimension_mm, volume_mm3, triangle_count
- Validación: watertight, winding_consistent, manifold
- Impresión: print_type, material, hollowed, wall_thickness_mm
- Estado: status (pending, completed, failed)

## Características

### ✅ Implementado

- Autenticación completa (registro, login, logout)
- **Generación universal de modelos 3D:**
  - **Personajes:** Pikachu, héroes, figuras genéricas
  - **Animales:** Perros, gatos, conejos, etc.
  - **Formas geométricas:** Esferas, cubos, cilindros, estrellas, corazones
  - **Objetos funcionales:** Soportes de celular, cajas, vasos, llaveros, bases
  - **Detección inteligente de dimensiones** (grande, pequeño, mediano, mm específicos)
  - **Detección de materiales** (PLA, PETG, ABS, TPU, Resina)
- Validación de mallas (watertight, normales, etc.)
- Historial de modelos generados
- Descarga de archivos STL
- Vista de detalles con metadata completa
- Interfaz oscura y moderna
- Ejemplos rápidos de prompts variados
- Manejo de errores y timeouts

### 🚧 Próximas Mejoras

- Más detalles en personajes (ojos, boca, accesorios)
- Texto en llaveros y objetos
- Texturas y colores
- Preview 3D en navegador (Three.js)
- Cola de trabajos para generaciones largas
- Exportación de metadata técnica
- Integración con slicer
- Generación con IA real (text-to-3D models)

## Flujo de Generación

1. Usuario escribe prompt en Laravel
2. Laravel valida el prompt (5-1000 caracteres)
3. Laravel crea registro en BD con status "pending"
4. Laravel envía POST a FastAPI con el prompt
5. FastAPI parsea el prompt y detecta tipo de objeto
6. FastAPI genera la malla 3D con trimesh
7. FastAPI valida la malla (watertight, normales, etc.)
8. FastAPI guarda el archivo STL
9. FastAPI responde con metadata completa
10. Laravel actualiza el registro con status "completed"
11. Usuario puede descargar el STL

## Errores Comunes

### FastAPI no está disponible

**Error**: "No se pudo conectar con el motor de generación 3D"

**Solución**: Verifica que FastAPI esté corriendo en http://127.0.0.1:8000

```bash
cd mesh-backend
source venv/bin/activate
uvicorn app.api:app --reload --port 8000
```

### Puerto ocupado

**Error**: "Address already in use"

**Solución**: Cambia el puerto o mata el proceso:

```bash
# Para Laravel
php artisan serve --port=8081

# Para FastAPI
uvicorn app.api:app --reload --port=8001
```

### Dependencias faltantes

**Error**: "ModuleNotFoundError" o "Class not found"

**Solución**:

```bash
# Python
cd mesh-backend
source venv/bin/activate
pip install -r requirements.txt

# PHP
cd mesh-front
composer install
npm install
```

## Tecnologías

- **Laravel 11**: Framework PHP moderno
- **Laravel Breeze**: Autenticación simple y elegante
- **FastAPI**: Framework Python de alto rendimiento
- **Trimesh**: Librería Python para manipulación de mallas 3D
- **Tailwind CSS**: Framework CSS utility-first
- **Alpine.js**: Framework JavaScript ligero
- **SQLite**: Base de datos embebida

## Licencia

MIT
