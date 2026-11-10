# Informe técnico · Hito #2 · SIGEL (Equipo 02)

Desarrollo Web · Universidad Tecnológica de Panamá

Integrantes: Ariel Jimenez y Alejandro Saenz.

SIGEL es el sistema para prestar equipos del laboratorio. En este hito, las páginas se convirtieron a PHP, los formularios envían datos al servidor y el servidor los valida. Todavía no hay base de datos: los datos de ejemplo están en `config/datos_demo.php`.

## 1. Flujo de una petición

```
Navegador  ->  Servidor web  ->  Archivo PHP  ->  Respuesta HTML  ->  Navegador
(usuario)      (Apache o       (lee los datos,   (confirmación o    (muestra la
                php -S)         valida y decide)  errores)           página)
```

1. El usuario abre una página o envía un formulario.
2. El servidor web recibe la petición y ejecuta el archivo PHP.
3. El PHP lee los datos (`$_GET` o `$_POST`), los limpia y los valida.
4. El PHP responde con HTML: una confirmación o la lista de errores.
5. El navegador muestra la respuesta.

## 2. Estructura de la aplicación

| Carpeta o archivo | Para qué sirve |
|-------------------|----------------|
| Páginas `.php` | Muestran cada pantalla (inicio, login, listados, etc.). |
| `procesar_*.php` | Reciben los formularios y los validan. |
| `includes/` | Encabezado, menú por rol, pie y funciones propias. |
| `clases/` | `Validador`, `Usuario`, `Prestamo` y `Equipo`. |
| `config/datos_demo.php` | Equipos, préstamos y reglas de ejemplo. |
| `css/` y `img/` | Estilo y gráficos. |
| `docs/` | Propuesta, plan de pruebas, trazabilidad e informe. |

## 3. Tabla de validaciones

| Campo | Regla | Mensaje de error |
|-------|-------|------------------|
| Cédula | Formato con guiones, por ejemplo 8-123-4567 | La cédula debe escribirse con guiones, por ejemplo 8-123-4567. |
| Correo | Termina en @utp.ac.pa | Usa tu correo institucional, que termina en @utp.ac.pa. |
| Contraseña | Entre 8 y 64 caracteres | La contraseña debe tener entre 8 y 64 caracteres. |
| Código de inventario | 3 letras, guion y 5 números, y debe existir | El código de inventario no existe. |
| Equipo | No puede estar en reparación ni prestado | Equipo no disponible. |
| Fechas | Formato dd/mm/aaaa; devolución de 0 a 3 días después | La devolución no puede ser más de 3 días después del préstamo. |
| Límite | Máximo 3 equipos activos y sin vencidos | Ya tienes el máximo de 3 equipos prestados. |
| Motivo | Entre 10 y 300 caracteres | El motivo debe tener entre 10 y 300 caracteres. |

## 4. Cuándo usar GET y cuándo POST

- **POST** se usa para enviar datos que se guardan o que son sensibles. En SIGEL: el registro de estudiante (cédula y contraseña), el inicio de sesión, la solicitud de un préstamo y el registro de un equipo. Así los datos no quedan en la dirección del navegador.
- **GET** se usa para leer datos sin cambiar nada. En SIGEL: buscar un préstamo (`principal_listado.php?buscar=ELE-00045`), filtrar por estado (`?estado=vencido`) y cambiar de página (`?pagina=2`).

Regla del proyecto: si una acción cambia datos, usa POST. Nunca se cambia un dato con GET.

## 5. Decisiones de seguridad

| Decisión | Por qué |
|----------|---------|
| Todo lo que se muestra pasa por `htmlspecialchars()` | Un `<script>` escrito en un campo se muestra como texto y no se ejecuta. |
| Contraseñas con `password_hash()` | Si alguien ve la base de datos, no puede leer las contraseñas. |
| `includes/` y `clases/` no se abren directamente | Los archivos internos no deben verse desde el navegador. |
| Listas fijas para carreras, roles y categorías | El navegador puede cambiar el valor de un `select`; el servidor lo rechaza. |
| Validar en el servidor, no solo en el formulario | Cualquiera puede quitar `required` desde el navegador. |
| Mismo mensaje si el correo o la contraseña están mal | Así no se puede saber qué correos existen. |

## 6. Para publicar el sistema

| Opción | Ventajas | Desventajas | Costo |
|--------|----------|-------------|-------|
| Hosting compartido con PHP y MySQL | Fácil de usar y de configurar. | Recursos limitados y compartidos. | Desde unos USD 4.50 al mes. |
| Servidor privado virtual (VPS) | Control total del servidor. | Hay que administrarlo: actualizaciones, seguridad y respaldos. | Unos USD 3 a 6 al mes (1 GB de RAM). La renovación puede costar más. |

- **Dominio:** un dominio `.pa`, registrado en NIC Panamá. Costo: unos USD 165 a 297 al año, según el registrador. Hay que tener antes un `.com.pa`.
- **Base de datos:** MySQL, que es la que usa el Hito #3. Viene incluida en las dos opciones de hosting.

Los precios son aproximados y vienen de páginas de terceros (letsdomains.com para el dominio, neolo.com/panama para el hosting y vpssos.com para el VPS). Hay que confirmarlos en cada proveedor antes de contratar.

## 7. Reflexión individual

**Ariel Jimenez:** Un problema que resolví fue el pie del listado de préstamos, que mostraba el nombre de una página en lugar del número de página. Lo encontré al revisar la pantalla y vi que el menú usaba la misma variable que la paginación. Lo corregí cambiando el nombre de esa variable y lo probé comprobando que el pie dijera "página 1 de 2". Aprendí a buscar las variables que se pisan entre sí y a revisar cada cambio en el navegador.

**Alejandro Saenz:** Un problema que resolví fue un error de sintaxis en los datos de demostración: al faltar un corchete, el sitio no cargaba. Lo encontré revisando el archivo con el comando de PHP para verificar la sintaxis, y lo corregí en un commit aparte. Aprendí que una revisión rápida antes de subir un cambio evita que un error pequeño rompa todo el sistema.

## 8. Conclusión

**Ariel Jimenez:** Con este hito aprendí a pasar páginas de HTML a PHP usando archivos comunes (`includes/`) y a validar los formularios en el servidor. Lo que más me costó fue ordenar el trabajo con Git.

**Alejandro Saenz:** Con este hito aprendí a guardar contraseñas con hash y a usar clases en PHP. Lo más útil fue revisar cada cambio antes de subirlo.
