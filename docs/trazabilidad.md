# Matriz de trazabilidad · SIGEL (Equipo 02)

Relaciona cada requerimiento funcional de la propuesta (`docs/propuesta.pdf`, sección 7) con el archivo donde se implementa y con la prueba que lo verifica. Los casos P-01 a P-17 están en `docs/plan_pruebas.md`.

| RF | Requerimiento | Archivo o clase | Prueba | Estado |
|----|---------------|-----------------|--------|--------|
| RF-01 | Registrar estudiantes | `registro.php`, `procesar_registro.php`, `clases/Usuario.php` | P-01, P-04, P-06, P-07, P-08 | Parcial: valida y confirma el registro, pero no guarda la cuenta. `Usuario.php` existe, pero la página todavía no la usa. |
| RF-02 | Iniciar sesión con correo, contraseña y rol | `login.php`, `procesar_login.php` | P-15, P-16 | Parcial: solo verifica el usuario de ejemplo con `password_verify()`. |
| RF-03 | Recuperar la contraseña con código de 6 dígitos | `recuperar.php` | Sin prueba | No implementado: la pantalla es una maqueta y no envía correos. |
| RF-04 | Crear préstamo | `principal_formulario.php`, `procesar_principal.php` | P-09, P-10, P-11, P-12 | Implementado con cambios: se quitaron el campo de laboratorio y la hora de retiro. El lugar de retiro sale del equipo. |
| RF-05 | Validar código de inventario (3 letras, guion, 5 números) | `procesar_principal.php`, `procesar_secundaria.php` | P-09, P-13 | Implementado. |
| RF-06 | Máximo 3 equipos a la vez; un kit cuenta 1; accesorios no cuentan | `procesar_principal.php`, `config/datos_demo.php` | P-17 | Parcial: el conteo se hace por correo. La prueba verifica que se acepta un tercer equipo con 2 activos. |
| RF-07 | Máximo 3 días por préstamo; el vencido bloquea nuevas solicitudes | `procesar_principal.php` | P-10, P-12 | Implementado. |
| RF-08 | El administrador configura el máximo de equipos y de días | `panel.php` | Sin prueba | No implementado: el formulario de parámetros no guarda los valores. |
| RF-09 | Listado con búsqueda por estudiante o código y filtros por estado y fecha | `principal_listado.php` | P-05, P-14 | Implementado. |
| RF-10 | Ver el detalle de un préstamo y modificarlo o eliminarlo | `principal_detalle.php` | Sin prueba | Parcial: el detalle es una maqueta. Modificar y eliminar no hacen cambios reales. |
| RF-11 | Registrar la devolución con fecha, hora y estado del equipo | `principal_detalle.php` | Sin prueba | Parcial: el formulario existe, pero no guarda la devolución. |
| RF-12 | Registrar y listar equipos con código, nombre, marca, serie, categoría, fecha, foto y manual | `secundaria_formulario.php`, `procesar_secundaria.php` | P-13 | Parcial: no se procesan la foto ni el manual. |
| RF-13 | Marcar como Vencido todo préstamo cuya devolución ya pasó | `principal_listado.php`, `config/datos_demo.php` | Sin prueba | Parcial: el estado viene de los datos y no se calcula con la fecha actual. |
| RF-14 | Perfil con préstamos activos y cuántos equipos más puede pedir | `perfil.php` | Sin prueba | Parcial: el perfil es una maqueta con datos fijos. |

## Notas

- **Sin prueba:** RF-03, RF-08, RF-10, RF-11, RF-13 y RF-14. Dependen de guardar datos o de cambios que no se hacen en este hito, por eso no se prueban aquí.
- **Límite de 3 equipos (RF-06):** la prueba P-17 verifica que se acepta el tercer equipo. El rechazo cuando ya hay 3 activos no se puede probar sin guardar préstamos.
- **Cambio en RF-04:** se quitaron el laboratorio y la hora de retiro. El lugar de retiro es el mismo para todos los equipos de la demostración.
