# Capacidades del Generador Universal de Modelos 3D

## 🎯 Tipos de Objetos Soportados

### 1. Personajes y Figuras
El sistema puede generar personajes estilo low-poly con cuerpo, cabeza, brazos, piernas y base.

**Palabras clave:** pikachu, pokemon, personaje, figura, muñeco, character

**Ejemplos:**
- `genera un pikachu`
- `genera un personaje pequeño`
- `genera una figura grande en resina`

**Características:**
- Cuerpo esférico achatado
- Cabeza proporcional
- Orejas (conos)
- Brazos y piernas articulados
- Base de estabilidad

---

### 2. Héroes
Genera superhéroes con capa, torso definido y pose heroica.

**Palabras clave:** heroe, héroe, hero, superman, batman, spiderman, ironman, capitan

**Ejemplos:**
- `genera un heroe grande`
- `genera un batman`
- `genera un superman pequeño en PETG`

**Características:**
- Torso rectangular
- Cabeza esférica
- Capa detrás
- Brazos y piernas
- Base de estabilidad

---

### 3. Animales
Crea animales genéricos con 4 patas, cola y orejas.

**Palabras clave:** animal, perro, gato, conejo, oso, leon, león, tigre, elefante

**Ejemplos:**
- `genera un perro`
- `genera un gato pequeño`
- `genera un oso grande`

**Características:**
- Cuerpo elipsoidal
- Cabeza proporcional
- Orejas (conos)
- 4 patas
- Cola

---

### 4. Soportes para Celular
Soporte funcional tipo escritorio con base, respaldo y labio frontal.

**Palabras clave:** celular, telefono, teléfono, phone, soporte

**Ejemplos:**
- `genera un soporte para celular grande en PLA`
- `genera un soporte para telefono pequeño en PETG`

**Características:**
- Base horizontal estable
- Respaldo inclinado
- Labio frontal para detener el celular
- Optimizado para impresión FDM

---

### 5. Contenedores

#### Cajas
Caja con paredes y base, sin tapa.

**Palabras clave:** caja, box, contenedor, recipiente

**Ejemplos:**
- `genera una caja de 100mm`
- `genera un contenedor grande`

#### Vasos/Tazas
Vaso cilíndrico hueco con base.

**Palabras clave:** vaso, taza, cup, glass

**Ejemplos:**
- `genera un vaso`
- `genera una taza pequeña`

---

### 6. Accesorios

#### Llaveros
Disco plano con agujero para argolla.

**Palabras clave:** llavero, keychain

**Ejemplos:**
- `genera un llavero`
- `genera un keychain pequeño`

#### Bases/Placas
Plataforma plana circular o rectangular.

**Palabras clave:** base, placa, plataforma, plate

**Ejemplos:**
- `genera una base rectangular de 120mm`
- `genera una placa circular`

---

### 7. Formas Geométricas

#### Esfera
**Palabras clave:** esfera, bola, pelota, ball, sphere

**Ejemplos:**
- `genera una esfera de 60mm`
- `genera una bola pequeña`

#### Cubo
**Palabras clave:** cubo, cube, dado

**Ejemplos:**
- `genera un cubo de 50mm`
- `genera un dado grande`

#### Cilindro
**Palabras clave:** cilindro, cylinder, tubo

**Ejemplos:**
- `genera un cilindro`
- `genera un tubo de 100mm`

#### Estrella
Estrella 3D de 5 puntas extruida.

**Palabras clave:** estrella, star

**Ejemplos:**
- `genera una estrella de 80mm`
- `genera una star grande`

#### Corazón
Corazón 3D con dos esferas superiores y cono inferior.

**Palabras clave:** corazon, corazón, heart

**Ejemplos:**
- `genera un corazon pequeño`
- `genera un heart de 70mm`

---

## 📏 Modificadores de Tamaño

### Tamaños Relativos
- **Grande:** `grande`, `big`, `large`, `enorme` → Multiplica dimensiones x1.5
- **Pequeño:** `pequeño`, `pequeno`, `small`, `mini`, `chico` → Multiplica dimensiones x0.7
- **Mediano:** `mediano`, `medium` → Tamaño por defecto

### Dimensiones Específicas
Puedes especificar dimensiones exactas en milímetros:

**Formato:** `[número]mm` o `[número] mm` o `de [número] mm`

**Ejemplos:**
- `genera una esfera de 60mm` → Diámetro de 60mm
- `genera una caja de 100mm` → 100mm de ancho
- `genera una estrella de 80mm 20mm` → 80mm ancho, 20mm alto

**Orden de dimensiones:**
1. Primera dimensión → Ancho (width)
2. Segunda dimensión → Alto (height)
3. Tercera dimensión → Profundidad (depth)

---

## 🎨 Materiales Soportados

El sistema detecta el material deseado y ajusta parámetros de impresión:

- **PLA** (por defecto): `pla`
- **PETG**: `petg`
- **ABS**: `abs`
- **TPU/Flexible**: `tpu`, `flexible`
- **Resina**: `resina`, `resin` → Ajusta grosor de pared a 0.8mm

**Ejemplos:**
- `genera un pikachu en resina`
- `genera un soporte para celular en PETG`
- `genera una caja en ABS`

---

## 🔧 Características Adicionales

### Hueco vs Sólido
- **Hueco:** `hueco`, `hollow`, `vacio`, `vacío`
- **Sólido:** `solido`, `sólido`, `solid`, `macizo`

### Complejidad
- **Simple:** `simple`, `basico`, `básico`
- **Complejo:** `complejo`, `detallado`, `detailed`

---

## 📊 Metadata Generada

Cada modelo incluye:

- **Geometría:**
  - Bounding box (xmin, ymin, zmin, xmax, ymax, zmax)
  - Dimensión máxima en mm
  - Volumen en mm³
  - Cantidad de triángulos

- **Validación:**
  - Watertight (hermético)
  - Normales consistentes
  - Manifold

- **Impresión:**
  - Tipo de impresión (FDM/Resina)
  - Material recomendado
  - Grosor de pared
  - Orientación sugerida

---

## 🚀 Ejemplos Completos

### Personajes
```
genera un pikachu
genera un pikachu grande en resina
genera un heroe pequeño
genera un batman grande en PLA
genera un personaje mediano
```

### Animales
```
genera un perro
genera un gato pequeño
genera un oso grande en PETG
genera un conejo
```

### Formas
```
genera una esfera de 60mm
genera un cubo de 50mm
genera un cilindro de 40mm 100mm
genera una estrella de 80mm
genera un corazon pequeño
```

### Objetos Funcionales
```
genera un soporte para celular grande en PLA
genera una caja de 100mm
genera un vaso
genera un llavero pequeño
genera una base rectangular de 120mm
```

### Combinaciones Avanzadas
```
genera un pikachu grande en resina
genera un heroe pequeño en PETG
genera una estrella de 80mm 20mm en PLA
genera un soporte para celular mediano en ABS
genera una caja de 100mm 80mm 60mm
```

---

## 🎯 Consejos para Mejores Resultados

1. **Sé específico:** Incluye tamaño, material y características
2. **Usa dimensiones:** Especifica mm cuando sea importante
3. **Combina modificadores:** "grande", "pequeño" + material + características
4. **Prueba variaciones:** El sistema es flexible con sinónimos
5. **Verifica metadata:** Revisa watertight y dimensiones antes de imprimir

---

## 🔮 Próximas Capacidades

- Texto en llaveros y objetos
- Más detalles en personajes (ojos, boca, accesorios)
- Texturas y colores
- Generación con IA real (text-to-3D)
- Más tipos de animales específicos
- Objetos articulados
- Ensamblajes multi-parte
