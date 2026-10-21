# Prueba de usabilidad · SIGEL (Equipo 02)

## Datos de la prueba

- Fecha: 20 / 10 / 2026
- Lugar: Universidad Tecnológica de Panamá (UTP)
- Material: maqueta HTML en pantalla (laptop), abierta desde `index.html`
- Indicación a cada participante: "es una maqueta, los botones no guardan datos". Una tarea cuenta como completada cuando el formulario se envía sin errores o se llega a la pantalla pedida.

## Participantes (3 personas ajenas al equipo)

| Nº | Nombre | Perfil |
|----|--------|--------|
| P1 | Luis Gómez | Estudiante de Ingeniería Electrónica |
| P2 | Abril Arroyo | Estudiante de Licenciatura en Ciberseguridad |
| P3 | Pedro Rangel | Estudiante de Licenciatura en Ciberseguridad |

## Tareas

| Nº | Tarea | Pantallas |
|----|-------|-----------|
| T1 | Crear una cuenta de estudiante. | Inicio → Registro |
| T2 | Solicitar el osciloscopio `ELE-00045` para devolverlo en 2 días. | Inicio → Solicitar préstamo |
| T3 | Como laboratorista, encontrar el préstamo vencido de Luis Gómez y abrir su detalle. | Préstamos → Detalle |

## Resultados

| Participante | Tarea | ¿La completó? | Tiempo | Comentarios y problemas |
|--------------|-------|---------------|--------|-------------------------|
| P1 | T1 | Sí | 40 s | Ninguno |
| P1 | T2 | Sí | 38 s | Ninguno |
| P1 | T3 | Sí | 54 s | Ninguno |
| P2 | T1 | Sí | 1 min 12 s | Escribió el teléfono sin guion (todo corrido) y el formulario no la dejó enviar hasta ponerlo con el formato 6123-4567. |
| P2 | T2 | Sí | 57 s | Ninguno |
| P2 | T3 | Sí | 55 s | Ninguno |
| P3 | T1 | Sí | 1 min 32 s | Escribió la cédula sin guiones (todo corrido) y el formulario no la dejó enviar hasta ponerla con el formato 8-123-4567. |
| P3 | T2 | Sí | 58 s | Ninguno |
| P3 | T3 | Sí | 1 min 04 s | Ninguno |

Resumen: las 9 tareas se completaron (100 %). Tiempo promedio: T1 1 min 08 s, T2 51 s, T3 58 s. Los dos problemas ocurrieron en el registro (T1) y los dos fueron por el formato de un número.

## Cambios al diseño derivados de la prueba

| Nº | Problema observado (participante y tarea) | Cambio aplicado | Página modificada |
|----|-------------------------------------------|-----------------|-------------------|
| 1 | P2, T1: se confundió con el teléfono y lo escribió todo corrido, sin guion. | El teléfono ahora se acepta con o sin guion (`pattern="6[0-9]{3}-?[0-9]{4}"`), con la ayuda "Ej.: 6123-4567 o 61234567" debajo del campo y un `title` que explica el formato en el mensaje de error. | `registro.html` |
| 2 | P3, T1: se confundió con la cédula y la escribió toda corrida, sin guiones. | La cédula mantiene los guiones porque separan provincia, tomo y asiento, pero ahora tiene la ayuda "Escríbela con guiones: 8-123-4567" y un `title` para que el mensaje de error del navegador diga el formato. Se aplicó en los tres formularios que piden cédula. | `registro.html`, `recuperar.html`, `principal-formulario.html` |

## Conclusión

Los participantes encontraron todas las pantallas sin ayuda; la navegación por el menú y el listado funcionó bien. Lo que más demoró fue el formato de los números en el registro, porque el campo exigía guiones sin explicarlo al momento del error. Por eso ahora los campos de teléfono y cédula muestran un ejemplo visible y un mensaje de error que indica el formato.
