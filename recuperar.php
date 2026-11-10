<?php
define('APP_ACCESO', true);
$titulo = 'Recuperar contraseña';
$descripcion = 'Recuperación de la contraseña de una cuenta de SIGEL mediante el correo institucional.';
$pagina_actual = 'recuperar.php';
require_once 'includes/encabezado.php';
?>
    <div class="eq02-dos-columnas">
      <section class="eq02-formulario">
        <h1>Recuperar contraseña</h1>
        <p class="eq02-nota">Maqueta: estos formularios no envían correos ni cambian contraseñas; solo muestran los dos pasos del proceso.</p>
        <form action="#" method="post">
          <p class="eq02-nota">Los campos marcados con <span class="eq02-obligatorio">*</span> son obligatorios.</p>
          <fieldset>
            <legend>Paso 1: solicitar el código</legend>
            <div class="eq02-campo">
              <label for="correo">Correo institucional <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="email" id="correo" name="correo" required maxlength="100" autocomplete="email" placeholder="nombre.apellido@utp.ac.pa" pattern=".+@utp\.ac\.pa" title="Usa tu correo institucional que termina en @utp.ac.pa" aria-describedby="eq02-ayuda-correo">
              <span class="eq02-ayuda" id="eq02-ayuda-correo">Solo correos institucionales que terminan en @utp.ac.pa.</span>
            </div>
            <div class="eq02-campo">
              <label for="cedula">Cédula <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="text" id="cedula" name="cedula" required pattern="[0-9]{1,2}-[0-9]{1,4}-[0-9]{1,6}" maxlength="15" autocomplete="off" placeholder="8-123-4567" title="Cédula con guiones: provincia-tomo-asiento. Ej.: 8-123-4567" aria-describedby="eq02-ayuda-cedula">
              <span class="eq02-ayuda" id="eq02-ayuda-cedula">Escríbela con guiones: 8-123-4567 (provincia-tomo-asiento).</span>
            </div>
          </fieldset>
          <button type="submit" name="accion" value="solicitar_codigo" class="eq02-boton">Enviar código a mi correo</button>
        </form>

        <form action="#" method="post">
          <p class="eq02-nota">Los campos marcados con <span class="eq02-obligatorio">*</span> son obligatorios.</p>
          <fieldset>
            <legend>Paso 2: escribir el código y la nueva contraseña</legend>
            <div class="eq02-campo">
              <label for="codigo_verificacion">Código de verificación recibido por correo <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="text" id="codigo_verificacion" name="codigo_verificacion" required pattern="[0-9]{6}" minlength="6" maxlength="6" inputmode="numeric" autocomplete="one-time-code" placeholder="6 dígitos" aria-describedby="eq02-ayuda-codigo">
              <span class="eq02-ayuda" id="eq02-ayuda-codigo">6 números, válido por 15 minutos.</span>
            </div>
            <div class="eq02-campo">
              <label for="nueva_contrasena">Nueva contraseña <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="password" id="nueva_contrasena" name="nueva_contrasena" required minlength="8" maxlength="64" autocomplete="new-password" placeholder="Mínimo 8 caracteres" aria-describedby="eq02-ayuda-contrasena">
              <span class="eq02-ayuda" id="eq02-ayuda-contrasena">Entre 8 y 64 caracteres.</span>
            </div>
          </fieldset>
          <button type="submit" name="accion" value="cambiar_contrasena" class="eq02-boton">Cambiar contraseña</button>
        </form>
      </section>
      <aside class="eq02-aside">
        <h2>¿Cómo funciona?</h2>
        <ol>
          <li>Escribe tu correo y tu cédula y presiona <strong>Enviar código a mi correo</strong>.</li>
          <li>Recibirás un código de 6 dígitos válido por <strong>15 minutos</strong>.</li>
          <li>En el paso 2 escribe el código y tu nueva contraseña.</li>
        </ol>
        <p><a href="login.php">Volver a iniciar sesión</a></p>
      </aside>
    </div>
<?php require_once 'includes/pie.php'; ?>
