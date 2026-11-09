# Plan de pruebas · SIGEL (Equipo 02)

Cada caso se prueba con el servidor local (`php -S localhost:8000` o XAMPP). La captura de cada caso se guarda fuera del proyecto, en `C:/Users/ariel/Downloads/capturas_pruebas_SIGEL/`, con el mismo ID.

| ID | Módulo | Caso de prueba | Entrada | Resultado esperado | Resultado obtenido |
|----|--------|----------------|---------|--------------------|--------------------|
| P-01 | Seguridad | Script en un campo del registro | Nombre: `<script>alert(1)</script>` en `registro.php` | Se muestra como texto y no se ejecuta | Pasa. Las etiquetas se quitan y se muestra "alert(1)" como texto. No se ejecuta. |
| P-02 | Seguridad | Acceso directo a un include | Abrir `/includes/encabezado.php` | "Acceso denegado" | Pasa. Muestra "Acceso denegado". |
| P-03 | Seguridad | Acceso directo a una clase | Abrir `/clases/Usuario.php` | "Acceso denegado" | Pasa con la guarda de PHP. El `.htaccess` solo se prueba con Apache (pendiente). |
| P-04 | Seguridad | La contraseña no se muestra | Registro válido con contraseña `Demo2026` | La contraseña no aparece en la pantalla de confirmación | Pasa. La confirmación no muestra la contraseña. |
| P-05 | Seguridad | Script en la búsqueda | `principal_listado.php?buscar=<script>alert(1)</script>` | Se muestra escapado y no se ejecuta | Pasa. No hay resultados y el texto queda como "alert(1)". No se ejecuta. |
| P-06 | Datos inválidos | Registro vacío | Enviar `registro.php` sin llenar campos | Errores por campo, sin errores de PHP | Pasa. Muestra los errores de cada campo y no hay errores de PHP. |
| P-07 | Datos inválidos | Cédula sin guiones | Cédula `81234567` en el registro | Se rechaza con mensaje | Pasa. "La cédula debe escribirse con guiones…" |
| P-08 | Datos inválidos | Correo no institucional | Correo `ana@gmail.com` en el registro | Se rechaza con mensaje | Pasa. "Usa tu correo institucional, que termina en @utp.ac.pa." |
| P-09 | Datos inválidos | Código de inventario inválido | Código `abc-1` en `principal_formulario.php` | Se rechaza con mensaje | Pasa. "El código de inventario debe tener 3 letras mayúsculas…" |
| P-10 | Datos inválidos | Devolución a 5 días | Préstamo el 19/10/2026 y devolución el 24/10/2026 | Se rechaza: máximo 3 días | Pasa. "La devolución debe ser de 1 a 3 días después del préstamo." |
| P-11 | Regla de negocio | Equipo en reparación | Solicitar `RED-40130` | "Equipo no disponible" | Pasa. "Equipo no disponible." |
| P-12 | Regla de negocio | Préstamo vencido | Cédula `8-765-4321` y correo `mjose.pena@utp.ac.pa` con `RED-00123` | Se rechaza por préstamo vencido | Pasa. "Tienes un préstamo vencido. No puedes solicitar otro hasta devolverlo." |
| P-13 | Regla de negocio | Código repetido en equipos | Registrar equipo con código `RED-40130` | "Ya existe un equipo con ese código" | Pasa. "Ya existe un equipo con ese código." |
| P-14 | Paginación | Página inválida | `principal_listado.php?pagina=-1` y `?pagina=999` | Sin error, cae en una página válida | Pasa. Con -1 muestra página 1 de 2 y con 999 muestra página 2 de 2. |
| P-15 | Acceso | Rol que no corresponde | Iniciar sesión con `demo.estudiante@utp.ac.pa` y rol Laboratorista | "El rol elegido no corresponde a tu cuenta" | Pasa. "El rol elegido no corresponde a tu cuenta." |
| P-16 | Acceso | Inicio de sesión correcto | Correo `demo.estudiante@utp.ac.pa`, contraseña `Demo2026`, rol Estudiante | Redirige a `index.php` con el rol Estudiante | Pasa. Redirige a la página de inicio con el menú de estudiante. Probado por Ariel en el navegador. |
| P-17 | Regla de negocio | Solicitud con 2 equipos activos (límite de 3) | Correo `ariel.jimenez@utp.ac.pa`, equipo `RED-00123`, fechas 19/10/2026 y 21/10/2026, motivo válido | Se acepta el tercer equipo (2 de 3 activos) | Pasa. Se muestra "Préstamo registrado" con el lugar de retiro. Probado por Ariel en el navegador. |

Notas:
- Las pruebas de formulario se enviaron con los mismos campos del formulario (POST) desde el navegador.
- P-02 y P-03 con Apache deben repetirse, porque el `.htaccess` no lo lee `php -S`.
