# 📸 Guía: Generar Modelos 3D desde Imágenes

## 🎯 ¿Qué puedes hacer?

El sistema ahora puede convertir **cualquier imagen** en un modelo 3D imprimible:

- ✅ **Llaveros personalizados** con logos, fotos, dibujos
- ✅ **Relieves 3D** de personajes, símbolos, texto
- ✅ **Placas decorativas** con imágenes
- ✅ **Sellos personalizados**
- ✅ **Medallas y monedas** personalizadas

---

## 🚀 Cómo Usar

### Opción 1: Desde la Interfaz Web

1. Ve a http://127.0.0.1:8080/generator
2. Escribe un prompt descriptivo (ej: "llavero de Hollow Knight")
3. **Haz clic en "Elegir archivo"** y sube tu imagen
4. Haz clic en "Generar STL"
5. Espera a que se procese (30-60 segundos)
6. Descarga tu modelo STL

### Opción 2: Desde la API (cURL)

```bash
curl -X POST http://127.0.0.1:8000/generate-from-image \
  -F "file=@/ruta/a/tu/imagen.png" \
  -F "prompt=llavero de Hollow Knight" \
  -F "depth_mm=5.0" \
  -F "base_thickness_mm=2.0"
```

### Opción 3: Desde Python

```python
import requests

url = "http://127.0.0.1:8000/generate-from-image"

files = {
    'file': open('hollow_knight.png', 'rb')
}

data = {
    'prompt': 'llavero de Hollow Knight',
    'depth_mm': 5.0,
    'base_thickness_mm': 2.0
}

response = requests.post(url, files=files, data=data)
result = response.json()

print(f"Archivo generado: {result['filename']}")
print(f"Ruta: {result['path']}")
```

---

## 🎨 Consejos para Mejores Resultados

### 1. Preparación de la Imagen

**✅ Imágenes Ideales:**
- Alto contraste (blanco y negro funciona mejor)
- Bordes definidos
- Sin fondo o fondo uniforme
- Resolución: 500x500 a 2000x2000 px
- Formato: PNG con transparencia o JPG

**❌ Evitar:**
- Imágenes borrosas o pixeladas
- Demasiados detalles finos (se perderán)
- Fondos complejos
- Imágenes muy oscuras o muy claras

### 2. Tipos de Imágenes Recomendadas

**Logos y Símbolos:**
```
✓ Logo de Hollow Knight
✓ Símbolo de Batman
✓ Logo de empresa
✓ Escudo de equipo
```

**Siluetas:**
```
✓ Silueta de personaje
✓ Perfil de rostro
✓ Forma de animal
✓ Contorno de objeto
```

**Texto:**
```
✓ Nombre en fuente bold
✓ Iniciales grandes
✓ Texto con sombra
```

### 3. Parámetros Ajustables

**depth_mm** (Profundidad del relieve):
- `2-3mm`: Relieve sutil, ideal para detalles finos
- `5mm`: Estándar, buen balance
- `8-10mm`: Relieve pronunciado, más dramático

**base_thickness_mm** (Grosor de la base):
- `1-2mm`: Llavero delgado y ligero
- `3-4mm`: Estándar, resistente
- `5mm+`: Placa gruesa, muy resistente

---

## 📐 Dimensiones Automáticas

El sistema ajusta automáticamente:
- **Ancho máximo:** 50mm (ideal para llaveros)
- **Proporción:** Se mantiene la relación de aspecto original
- **Agujero para llavero:** Se agrega automáticamente si es pequeño (<60mm)

---

## 🎯 Ejemplos de Uso

### Ejemplo 1: Llavero de Hollow Knight

**Imagen:** Logo de Hollow Knight (PNG con transparencia)

**Prompt:** `"llavero de Hollow Knight"`

**Resultado:**
- Relieve 3D del logo
- 50mm de ancho
- 5mm de profundidad
- Agujero para argolla incluido
- Listo para imprimir en PLA

### Ejemplo 2: Placa Decorativa

**Imagen:** Foto de mascota (JPG)

**Prompt:** `"placa decorativa de mi perro"`

**Parámetros:**
- `depth_mm=8.0` (relieve pronunciado)
- `base_thickness_mm=4.0` (base gruesa)

**Resultado:**
- Relieve 3D de la foto
- 50mm de ancho
- 8mm de profundidad
- Sin agujero (es una placa)

### Ejemplo 3: Sello Personalizado

**Imagen:** Iniciales "JD" en fuente bold

**Prompt:** `"sello con mis iniciales"`

**Parámetros:**
- `depth_mm=3.0` (relieve sutil)
- `base_thickness_mm=10.0` (mango grueso)

**Resultado:**
- Sello funcional
- Iniciales en relieve
- Listo para usar con tinta

---

## 🔧 Procesamiento Técnico

### Método: Relieve desde Imagen (Relief)

**Cómo funciona:**
1. Convierte la imagen a escala de grises
2. Redimensiona a 200x200 px (optimización)
3. Crea una malla 3D donde:
   - Píxeles claros = Altura máxima
   - Píxeles oscuros = Altura mínima
4. Genera base plana
5. Conecta superficie con base (paredes laterales)
6. Agrega agujero para llavero si aplica
7. Exporta como STL

**Ventajas:**
- ✅ Rápido (5-10 segundos)
- ✅ Funciona sin GPU
- ✅ 100% gratuito
- ✅ Resultados predecibles
- ✅ Ideal para llaveros y placas

**Limitaciones:**
- ❌ Solo 2.5D (no 3D completo)
- ❌ Detalles finos se simplifican
- ❌ No captura profundidad real

---

## 🚀 Métodos Avanzados (Opcionales)

### Shap-E (OpenAI)

**Instalación:**
```bash
cd mesh-backend
source venv/bin/activate
pip install shap-e torch
```

**Ventajas:**
- ✅ Genera modelos 3D completos
- ✅ Entiende contexto de la imagen
- ✅ Resultados más orgánicos

**Desventajas:**
- ❌ Requiere GPU (recomendado)
- ❌ Más lento (30-60 segundos)
- ❌ Resultados menos predecibles

### TripoSR (Stability AI)

**Instalación:**
```bash
pip install triposr
```

**Ventajas:**
- ✅ Reconstrucción 3D real
- ✅ Múltiples vistas
- ✅ Alta calidad

**Desventajas:**
- ❌ Requiere GPU potente
- ❌ Más lento
- ❌ Mayor complejidad

---

## 📊 Comparación de Métodos

| Método | Velocidad | Calidad | GPU | Costo | Mejor Para |
|--------|-----------|---------|-----|-------|------------|
| **Relief** | ⚡⚡⚡ Rápido | ⭐⭐⭐ Buena | ❌ No | 💰 Gratis | Llaveros, placas |
| **Shap-E** | ⚡⚡ Medio | ⭐⭐⭐⭐ Muy buena | ✅ Sí | 💰 Gratis | Figuras, objetos |
| **TripoSR** | ⚡ Lento | ⭐⭐⭐⭐⭐ Excelente | ✅ Sí | 💰 Gratis | Reconstrucción 3D |

---

## 🎨 Flujo de Trabajo Recomendado

### Para Llaveros de Personajes (ej: Hollow Knight)

1. **Busca una imagen de alta calidad:**
   - Google Images: "Hollow Knight logo PNG"
   - Asegúrate de que tenga transparencia o fondo blanco

2. **Edita la imagen (opcional):**
   - Aumenta el contraste
   - Elimina el fondo
   - Convierte a blanco y negro si es necesario

3. **Sube a la plataforma:**
   - Prompt: "llavero de Hollow Knight"
   - Imagen: hollow_knight.png
   - Genera

4. **Descarga y verifica:**
   - Abre el STL en tu slicer favorito
   - Verifica dimensiones (50mm aprox)
   - Verifica que el agujero esté presente

5. **Imprime:**
   - Material: PLA o PETG
   - Altura de capa: 0.2mm
   - Relleno: 20-30%
   - Soportes: No necesarios

---

## 🐛 Solución de Problemas

### Problema: "El modelo está muy plano"
**Solución:** Aumenta `depth_mm` a 8-10mm

### Problema: "Se perdieron los detalles"
**Solución:** 
- Usa una imagen con más contraste
- Simplifica la imagen antes de subirla
- Aumenta el tamaño de la imagen original

### Problema: "El agujero no aparece"
**Solución:** El agujero solo se agrega automáticamente si el modelo es <60mm. Para modelos más grandes, agrégalo manualmente en tu slicer.

### Problema: "Error al procesar la imagen"
**Solución:**
- Verifica que sea JPG o PNG
- Reduce el tamaño si es >10MB
- Asegúrate de que no esté corrupta

---

## 💡 Ideas de Proyectos

1. **Llaveros de videojuegos:** Hollow Knight, Zelda, Mario, etc.
2. **Logos de empresas:** Para regalos corporativos
3. **Fotos de mascotas:** Relieves personalizados
4. **Iniciales personalizadas:** Regalos únicos
5. **Símbolos y escudos:** Equipos deportivos, casas de Harry Potter
6. **Arte pixel:** Sprites de juegos retro
7. **Sellos personalizados:** Para artesanías
8. **Medallas:** Para eventos o competencias

---

## 🎉 ¡Empieza Ahora!

1. Encuentra una imagen que te guste
2. Ve a http://127.0.0.1:8080/generator
3. Sube la imagen
4. Genera tu modelo
5. ¡Imprime y disfruta!

**¿Necesitas ayuda?** El sistema usa el método de relieve por defecto, que funciona sin configuración adicional. ¡Solo sube tu imagen y genera!
