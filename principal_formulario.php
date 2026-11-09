<?php
define('APP_ACCESO', true);
$titulo = 'Solicitar préstamo';
$descripcion = 'Formulario para crear o modificar un préstamo de equipo del laboratorio con su código de inventario.';
$pagina_actual = 'principal_formulario.php';
require_once 'includes/encabezado.php';
?>
    <div class="eq02-dos-columnas">
      <section class="eq02-formulario">
        <h1>Solicitar préstamo de equipo</h1>
        <form action="procesar_principal.php" method="post">
          <p class="eq02-nota">Los campos marcados con <span class="eq02-obligatorio">*</span> son obligatorios.</p>
          <fieldset>
            <legend>Estudiante</legend>
            <div class="eq02-rejilla">
              <div class="eq02-campo">
                <label for="cedula_estudiante">Cédula del estudiante <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <input type="text" id="cedula_estudiante" name="cedula_estudiante" required pattern="[0-9]{1,2}-[0-9]{1,4}-[0-9]{1,6}" maxlength="15" autocomplete="off" placeholder="8-123-4567" title="Cédula con guiones: provincia-tomo-asiento. Ej.: 8-123-4567" aria-describedby="eq02-ayuda-cedula-estudiante">
                <span class="eq02-ayuda" id="eq02-ayuda-cedula-estudiante">Escríbela con guiones: 8-123-4567 (provincia-tomo-asiento).</span>
              </div>
              <div class="eq02-campo">
                <label for="correo_estudiante">Correo del estudiante <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <input type="email" id="correo_estudiante" name="correo_estudiante" required maxlength="100" autocomplete="email" placeholder="nombre.apellido@utp.ac.pa" pattern=".+@utp\.ac\.pa" title="Correo institucional del estudiante, termina en @utp.ac.pa" aria-describedby="eq02-ayuda-correo-estudiante">
                <span class="eq02-ayuda" id="eq02-ayuda-correo-estudiante">Solo correos institucionales que terminan en @utp.ac.pa.</span>
              </div>
            </div>
          </fieldset>
          <fieldset id="eq02-bloque-equipo">
            <legend>Equipo solicitado</legend>
            <div class="eq02-campo">
              <label for="codigo_inventario">Código de inventario del equipo <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="text" id="codigo_inventario" name="codigo_inventario" required pattern="[A-Z]{3}-[0-9]{5}" minlength="9" maxlength="9" autocomplete="off" placeholder="RED-00123" aria-describedby="eq02-ayuda-codigo-inventario">
              <span class="eq02-ayuda" id="eq02-ayuda-codigo-inventario">3 letras mayúsculas, guion y 5 números (ej. <code>ELE-00045</code>).</span>
            </div>
            <fieldset class="eq02-grupo">
              <legend>Tipo de ítem <span class="eq02-obligatorio" aria-hidden="true">*</span></legend>
              <div class="eq02-opcion">
                <input type="radio" id="tipo_equipo" name="tipo_item" value="equipo" required aria-describedby="eq02-ayuda-tipo-item">
                <label for="tipo_equipo">Equipo (cuenta para el máximo de 3)</label>
              </div>
              <div class="eq02-opcion">
                <input type="radio" id="tipo_kit" name="tipo_item" value="kit" aria-describedby="eq02-ayuda-tipo-item">
                <label for="tipo_kit">Kit (cuenta como 1 equipo)</label>
              </div>
              <span class="eq02-ayuda" id="eq02-ayuda-tipo-item">Los cables y accesorios no se piden con un código: se indican en «Cables o accesorios adicionales» y no cuentan para el límite.</span>
            </fieldset>
          </fieldset>
          <fieldset>
            <legend>Fechas del préstamo</legend>
            <p class="eq02-nota">Datos de demostración: fecha de referencia 19/10/2026.</p>
            <div class="eq02-rejilla">
              <div class="eq02-campo">
                <label for="fecha_prestamo">Fecha de préstamo <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <input type="date" id="fecha_prestamo" name="fecha_prestamo" required min="2026-10-19" max="2026-10-19" value="2026-10-19" aria-describedby="eq02-ayuda-fecha-prestamo">
                <span class="eq02-ayuda" id="eq02-ayuda-fecha-prestamo">En este ejemplo el préstamo sale el 19/10/2026.</span>
              </div>
              <div class="eq02-campo">
                <label for="hora_retiro">Hora de retiro <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <input type="time" id="hora_retiro" name="hora_retiro" required min="08:00" max="20:00" step="900">
              </div>
              <div class="eq02-campo">
                <label for="fecha_devolucion">Fecha de devolución <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <input type="date" id="fecha_devolucion" name="fecha_devolucion" required min="2026-10-19" max="2026-10-22" aria-describedby="eq02-ayuda-fecha-devolucion">
                <span class="eq02-ayuda" id="eq02-ayuda-fecha-devolucion">Máximo 3 días: en este ejemplo, del 19/10/2026 al 22/10/2026. En la maqueta el rango es fijo; el sistema final lo calculará desde la fecha de préstamo.</span>
              </div>
              <div class="eq02-campo">
                <label for="cantidad_accesorios">Cables o accesorios adicionales (no cuentan para el límite)</label>
                <input type="number" id="cantidad_accesorios" name="cantidad_accesorios" min="0" max="10" step="1" placeholder="0">
              </div>
            </div>
            <div class="eq02-campo">
              <label for="motivo">Motivo del préstamo <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <textarea id="motivo" name="motivo" rows="3" required minlength="10" maxlength="300" placeholder="Ej.: práctica 4 de Circuitos II"></textarea>
            </div>
          </fieldset>
          <p class="eq02-acciones">
            <button type="submit" class="eq02-boton">Registrar préstamo</button>
            <a href="perfil.php" class="eq02-boton eq02-boton-secundario">Cancelar y volver a mi perfil</a>
          </p>
        </form>
      </section>
      <aside class="eq02-aside">
        <h2>Tu situación</h2>
        <p class="eq02-nota">Ejemplo: Ariel Jimenez, con KIT-00007 y MED-00020 prestados.</p>
        <p><label for="eq02-equipos-activos">Equipos prestados ahora</label></p>
        <meter id="eq02-equipos-activos" min="0" max="3" low="2" high="3" optimum="0" value="2">2 de 3</meter>
        <p><strong>2 de 3</strong> equipos. Puedes pedir 1 más.</p>
        <h3>Antes de enviar</h3>
        <ul>
          <li>Máximo <strong>3 equipos</strong> a la vez (un kit cuenta como 1).</li>
          <li>Máximo <strong>3 días</strong> por préstamo.</li>
          <li>Con un préstamo <strong>vencido</strong> no puedes solicitar otro.</li>
        </ul>
      </aside>
    </div>
<?php require_once 'includes/pie.php'; ?>
