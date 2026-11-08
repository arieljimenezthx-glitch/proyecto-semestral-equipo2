<?php
define('APP_ACCESO', true);
$titulo = 'Iniciar sesión';
$descripcion = 'Inicio de sesión en SIGEL para estudiantes, laboratoristas y administradores del laboratorio.';
$pagina_actual = 'login.php';
require_once 'includes/encabezado.php';
?>
    <div class="eq02-dos-columnas">
      <section class="eq02-formulario">
        <h1>Iniciar sesión</h1>
        <form action="#" method="post">
          <p class="eq02-nota">Los campos marcados con <span class="eq02-obligatorio">*</span> son obligatorios.</p>
          <fieldset>
            <legend>Datos de acceso</legend>
            <div class="eq02-campo">
              <label for="correo">Correo institucional <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="email" id="correo" name="correo" required maxlength="100" autocomplete="email" placeholder="nombre.apellido@utp.ac.pa" pattern=".+@utp\.ac\.pa" title="Usa tu correo institucional que termina en @utp.ac.pa" aria-describedby="eq02-ayuda-correo">
              <span class="eq02-ayuda" id="eq02-ayuda-correo">Solo correos institucionales que terminan en @utp.ac.pa.</span>
            </div>
            <div class="eq02-campo">
              <label for="contrasena">Contraseña <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="password" id="contrasena" name="contrasena" required minlength="8" maxlength="64" autocomplete="current-password" placeholder="Mínimo 8 caracteres">
            </div>
            <div class="eq02-campo">
              <label for="rol">Rol con el que ingresas <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <select id="rol" name="rol" required aria-describedby="eq02-ayuda-rol">
                <option value="">Seleccione un rol</option>
                <option value="estudiante">Estudiante</option>
                <option value="laboratorista">Laboratorista</option>
                <option value="administrador">Administrador</option>
              </select>
              <span class="eq02-ayuda" id="eq02-ayuda-rol">Elegir un rol no da permisos: el sistema solo permitirá el rol asignado a tu cuenta.</span>
            </div>
            <div class="eq02-opcion">
              <input type="checkbox" id="recordar" name="recordar" value="1">
              <label for="recordar">Recordar mi sesión en este equipo</label>
            </div>
          </fieldset>
          <button type="submit" class="eq02-boton">Entrar</button>
        </form>
        <p><a href="recuperar.php">¿Olvidaste tu contraseña?</a></p>
      </section>
      <aside class="eq02-aside">
        <h2>¿Primera vez?</h2>
        <p>Los estudiantes de la UTP crean su cuenta con su cédula y correo institucional.</p>
        <p><a href="registro.php" class="eq02-boton eq02-boton-secundario">Crear cuenta</a></p>
        <p class="eq02-nota">Las cuentas de laboratorista y administrador las crea el administrador del sistema.</p>
      </aside>
    </div>
<?php require_once 'includes/pie.php'; ?>
