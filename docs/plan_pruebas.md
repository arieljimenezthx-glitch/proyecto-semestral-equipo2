# Plan de pruebas · SIGEL (Equipo 02)

Cada caso se prueba con el servidor local (`php -S localhost:8000` o XAMPP). La captura de cada caso se guarda en `docs/capturas_pruebas/` con el mismo ID.

| ID | Módulo | Caso de prueba | Entrada | Resultado esperado | Resultado obtenido |
|----|--------|----------------|---------|--------------------|--------------------|
| P-01 | Seguridad | Script en un campo del registro | Nombre: `<script>alert(1)</script>` en `registro.php` | Se muestra como texto y no se ejecuta | Pendiente |
| P-02 | Seguridad | Acceso directo a un include | Abrir `/includes/encabezado.php` | "Acceso denegado" | Pendiente |
| P-03 | Seguridad | Acceso directo a una clase | Abrir `/clases/Usuario.php` | "Acceso denegado" | Pendiente |
| P-04 | Seguridad | La contraseña no se muestra | Registro válido con contraseña `Demo2026` | La contraseña no aparece en la pantalla de confirmación | Pendiente |
| P-05 | Seguridad | Script en la búsqueda | `principal_listado.php?buscar=<script>alert(1)</script>` | Se muestra escapado y no se ejecuta | Pendiente |
| P-06 | Datos inválidos | Registro vacío | Enviar `registro.php` sin llenar campos | Errores por campo, sin errores de PHP | Pendiente |
| P-07 | Datos inválidos | Cédula sin guiones | Cédula `81234567` en el registro | Se rechaza con mensaje | Pendiente |
| P-08 | Datos inválidos | Correo no institucional | Correo `ana@gmail.com` en el registro | Se rechaza con mensaje | Pendiente |
| P-09 | Datos inválidos | Código de inventario inválido | Código `abc-1` en `principal_formulario.php` | Se rechaza con mensaje | Pendiente |
| P-10 | Datos inválidos | Devolución a 5 días | Préstamo el 19/10/2026 y devolución el 24/10/2026 | Se rechaza: máximo 3 días | Pendiente |
| P-11 | Regla de negocio | Equipo en reparación | Solicitar `RED-40130` | "Equipo no disponible" | Pendiente |
| P-12 | Regla de negocio | Préstamo vencido | Correo `mjose.pena@utp.ac.pa` y código `RED-40117` | Se rechaza por préstamo vencido | Pendiente |
| P-13 | Regla de negocio | Código repetido en equipos | Registrar equipo con código `RED-40130` | "Ya existe un equipo con ese código" | Pendiente |
| P-14 | Paginación | Página inválida | `principal_listado.php?pagina=-1` y `?pagina=999` | Sin error, cae en una página válida | Pendiente |
| P-15 | Acceso | Rol que no corresponde | Iniciar sesión con `demo.estudiante@utp.ac.pa` y rol Laboratorista | "El rol elegido no corresponde a tu cuenta" | Pendiente |
