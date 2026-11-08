<?php
define('APP_ACCESO', true);
$titulo = 'Inicio';
$descripcion = 'SIGEL: solicitud y control de préstamos de equipos del laboratorio para estudiantes, laboratoristas y administradores.';
$pagina_actual = 'index.php';
require_once 'includes/encabezado.php';
?>
    <section class="eq02-portada">
      <div>
        <h1>Préstamos de equipos del laboratorio, sin hojas de papel</h1>
        <p><strong>SIGEL</strong> permite a los estudiantes solicitar osciloscopios, multímetros, kits y laptops en línea, y al laboratorista saber en todo momento <em>quién tiene cada equipo</em> y cuándo debe devolverlo.</p>
        <p class="eq02-acciones">
          <a href="login.php" class="eq02-boton">Iniciar sesión</a>
          <a href="registro.php" class="eq02-boton eq02-boton-secundario">Crear cuenta de estudiante</a>
        </p>
      </div>
      <figure>
        <img src="img/laboratorio.svg" alt="Ilustración de una mesa de laboratorio con osciloscopio, multímetro y laptop" width="420" height="260">
        <figcaption>Equipos disponibles en el laboratorio de electrónica.</figcaption>
      </figure>
    </section>

    <section>
      <h2>¿Qué puedes hacer según tu rol?</h2>
      <div class="eq02-tarjetas">
        <article class="eq02-tarjeta">
          <h3>Estudiante</h3>
          <ul>
            <li>Solicitar un préstamo.</li>
            <li>Ver sus préstamos activos y fechas de devolución.</li>
          </ul>
          <a href="principal_formulario.php">Solicitar préstamo</a>
        </article>
        <article class="eq02-tarjeta">
          <h3>Laboratorista</h3>
          <ul>
            <li>Buscar y filtrar préstamos.</li>
            <li>Registrar entregas y devoluciones.</li>
          </ul>
          <a href="principal_listado.php">Ver préstamos</a>
        </article>
        <article class="eq02-tarjeta">
          <h3>Administrador</h3>
          <ul>
            <li>Registrar equipos del inventario.</li>
            <li>Configurar los parámetros de préstamo.</li>
          </ul>
          <a href="panel.php">Ir al panel</a>
        </article>
      </div>
    </section>

    <section id="eq02-reglas">
      <h2>Reglas de préstamo</h2>
      <ol>
        <li>Un estudiante puede tener como máximo <strong>3 equipos</strong> prestados a la vez. Un <em>kit</em> cuenta como un equipo; los cables y accesorios no cuentan.</li>
        <li>Cada préstamo dura como máximo <strong>3 días</strong>.</li>
        <li>Quien tenga un préstamo <strong>vencido</strong> no puede solicitar otro hasta devolverlo.</li>
      </ol>
      <p class="eq02-nota">La cantidad de equipos y los días son parámetros que el administrador puede cambiar. Vigentes desde el <time datetime="2026-10-19">19 de octubre de 2026</time>.</p>
    </section>
<?php require_once 'includes/pie.php'; ?>
