<?php
define('APP_ACCESO', true);
$titulo = 'Mi perfil';
$descripcion = 'Perfil del estudiante en SIGEL con sus datos y los préstamos de equipos activos.';
$pagina_actual = 'perfil.php';
require_once 'includes/encabezado.php';
?>
    <h1>Mi perfil</h1>
    <div class="eq02-dos-columnas">
      <section class="eq02-tarjeta">
        <h2>Préstamos activos</h2>
        <p class="eq02-nota">Datos de demostración al 19/10/2026.</p>
        <ul>
          <li><a href="principal_detalle.php#eq02-prestamo-kit-00007"><strong>KIT-00007</strong></a> · Kit Arduino Uno · devolver el <time datetime="2026-10-22">22/10/2026</time></li>
          <li><a href="principal_detalle.php#eq02-prestamo-med-00020"><strong>MED-00020</strong></a> · Multímetro digital UNI-T UT33D · devolver el <time datetime="2026-10-21">21/10/2026</time></li>
        </ul>
        <p><label for="eq02-mis-equipos">Uso de tu límite</label></p>
        <meter id="eq02-mis-equipos" min="0" max="3" low="2" high="3" optimum="0" value="2">2 de 3</meter>
        <p>Tienes <strong>2 de 3</strong> equipos y ningún préstamo vencido: puedes solicitar 1 más.</p>
        <p class="eq02-acciones"><a href="principal_formulario.php" class="eq02-boton">Solicitar préstamo</a></p>
      </section>
      <aside class="eq02-aside">
        <figure>
          <img src="img/avatar.svg" alt="Foto de perfil genérica" width="120" height="120">
          <figcaption>Ariel Jimenez</figcaption>
        </figure>
        <h2>Mis datos</h2>
        <dl class="eq02-detalle">
          <dt>Cédula</dt>
          <dd>8-123-4567</dd>
          <dt>Correo</dt>
          <dd>ariel.jimenez@utp.ac.pa</dd>
          <dt>Carrera</dt>
          <dd>Licenciatura en Ingeniería de Sistemas y Computación · 3.<sup>er</sup> semestre</dd>
        </dl>
        <p><a href="recuperar.php">Cambiar contraseña</a></p>
      </aside>
    </div>
<?php require_once 'includes/pie.php'; ?>
