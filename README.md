# SIGEL · Sistema de Gestión de Préstamos de Equipos del Laboratorio

Equipo 02 · Desarrollo Web · Hito #2 (Integración HTML/CSS con backend PHP)

## Integrantes

| Integrante | Usuario GitHub |
|------------|----------------|
| Ariel Jimenez | [arieljimenezthx-glitch](https://github.com/arieljimenezthx-glitch) |
| Alejandro Saenz | [Alejo50716](https://github.com/Alejo50716) |

La distribución de roles del hito está en `docs/matriz_responsabilidades.pdf`.

## Descripción

SIGEL reemplaza la hoja de papel con la que hoy se prestan los equipos del laboratorio (osciloscopios, multímetros, kits, routers y laptops). El estudiante solicita el préstamo en línea, el laboratorista sabe quién tiene cada equipo y cuándo debe devolverlo, y el administrador gestiona el inventario y los parámetros de préstamo.

## Requisitos

- PHP 8.2 o superior. Probado con PHP 8.2.12 de XAMPP.
- Sin base de datos todavía. MySQL llega en el Hito #3.
- Sin frameworks ni Composer.

## Cómo ejecutar el proyecto

Opción 1: servidor de PHP incluido. Desde la carpeta del proyecto:

```bash
php -S localhost:8000
```

Si PHP está instalado con XAMPP, usa la ruta completa:

```bash
"C:\xampp\php\php.exe" -S localhost:8000
```

Luego abre en el navegador: `http://localhost:8000/index.php?rol=estudiante`

Opción 2: XAMPP con Apache. Copia la carpeta del proyecto a `C:\xampp\htdocs\` y abre `http://localhost/proyecto-semestral-equipo2/index.php?rol=estudiante`

### Roles simulados

El rol se pasa en la dirección con `?rol=`: `estudiante`, `docente`, `laboratorista` o `administrador`. El menú cambia según el rol. Si el valor no es válido, se usa `estudiante`.

### Usuario de demostración

Para probar el inicio de sesión:

- Correo: `demo.estudiante@utp.ac.pa`
- Contraseña: `Demo2026`
- Rol: Estudiante

## Estructura del proyecto

```
proyecto-semestral-equipo2/
├── index.php
├── login.php
├── registro.php
├── recuperar.php
├── principal_formulario.php
├── principal_listado.php
├── principal_detalle.php
├── secundaria_formulario.php
├── panel.php
├── perfil.php
├── procesar_registro.php
├── procesar_login.php
├── procesar_principal.php
├── procesar_secundaria.php
├── includes/
│   ├── encabezado.php
│   ├── menu.php
│   ├── pie.php
│   └── funciones.php
├── config/
│   └── datos_demo.php
├── css/
├── img/
└── docs/
```

## Páginas

| Archivo | Pantalla | Roles |
|---------|----------|-------|
| `index.php` | Inicio con accesos por rol y reglas de préstamo | Todos |
| `login.php` | Inicio de sesión | Todos |
| `registro.php` | Registro de estudiante | Estudiante |
| `recuperar.php` | Recuperación de contraseña | Todos |
| `principal_formulario.php` | Solicitar préstamo | Estudiante, docente, laboratorista |
| `principal_listado.php` | Listado de préstamos con búsqueda, filtros y paginación | Docente, laboratorista |
| `principal_detalle.php` | Detalle del préstamo | Laboratorista |
| `secundaria_formulario.php` | Registro y listado de equipos | Administrador |
| `panel.php` | Panel de administración | Administrador |
| `perfil.php` | Perfil del estudiante | Estudiante |

Las pantallas de recuperación, detalle, panel y perfil todavía muestran datos de la maqueta. Los datos dinámicos llegan en las siguientes partes del hito.

## Formularios y procesamiento

| Formulario | Método | Script | Qué valida |
|------------|--------|--------|------------|
| Registro de estudiante | POST | `procesar_registro.php` | Campos obligatorios, cédula, correo institucional, teléfono, carrera de lista blanca, contraseña con `password_hash()` |
| Inicio de sesión | POST | `procesar_login.php` | Correo institucional, contraseña verificada con `password_verify()`, rol de lista blanca |
| Solicitar préstamo | POST | `procesar_principal.php` | Cédula, código de inventario, equipo en reparación, préstamo vencido, límite de equipos, fechas y hora |
| Registro de equipo | POST | `procesar_secundaria.php` | Código único, categoría de lista blanca, fecha de adquisición, enlace al manual |
| Búsqueda de préstamos | GET | `principal_listado.php` | Estudiante o código de inventario |
| Filtro de préstamos | GET | `principal_listado.php` | Estado y rango de fechas |
| Paginación | GET | `principal_listado.php?pagina=N` | 5 préstamos por página; números inválidos o fuera de rango caen en una página válida |

## Datos de demostración

`config/datos_demo.php` contiene los equipos, los préstamos y los parámetros de la regla. Incluye las tres semillas dictadas en clase y el equipo `RED-40130` (Router 1941) en reparación. Mientras no haya base de datos, es la única fuente de datos.

## Reglas de préstamo

- Máximo 3 equipos prestados a la vez. Un kit cuenta como 1; los cables y accesorios no cuentan.
- Cada préstamo dura máximo 3 días.
- Quien tenga un préstamo vencido no puede solicitar otro hasta devolverlo.
- `RED-40130` (Router 1941) está en reparación: no se puede solicitar y el sistema responde "Equipo no disponible".

El límite de equipos se cuenta con los préstamos que tienen correo en `config/datos_demo.php`.

## Seguridad

- Toda salida en pantalla pasa por `escapar()`, que usa `htmlspecialchars()`.
- Las contraseñas se guardan solo como hash con `password_hash()` y se verifican con `password_verify()`. Nunca se muestran.
- Los archivos de `includes/` tienen una guarda: si se abren directamente, muestran "Acceso denegado".
- Todos los campos se validan en el servidor. Los `select` se validan contra listas blancas.

## Funciones propias

En `includes/funciones.php`: `limpiar()`, `escapar()`, `redirigir()`, `obtener_rol()`, `formatear_fecha()` y `mostrar_errores()`.

## Documentos

- `docs/propuesta.pdf`: propuesta del sistema.
- `docs/wireframes.pdf`: wireframes de las 10 pantallas, versiones móviles y flujo por rol.
- `docs/guia_estilo.pdf`: paleta, tipografías, componentes y contraste.
- `docs/matriz_responsabilidades.pdf`: tareas con responsable, revisor, fecha y estado.
- `docs/usabilidad.pdf`: resultados de la prueba de usabilidad del 20/10/2026.
- `docs/bitacora.md`: bitácora de las sesiones de trabajo.
- Pendientes para la entrega: `docs/plan_pruebas.pdf`, `docs/trazabilidad.pdf` e `docs/informe_hito2.pdf`.

Las capturas de validación W3C del Hito #1 están en `docs/capturas_w3c/`.

## Declaración de herramientas

- Editor: Visual Studio Code. Navegador: Google Chrome. Control de versiones: Git y GitHub.
- Servidor local: XAMPP con PHP 8.2.12.
- Validadores: W3C Nu HTML Checker y W3C CSS Validation Service.
- Se uso Claude para tener una buena organizacion general y un progreso ordenado.
