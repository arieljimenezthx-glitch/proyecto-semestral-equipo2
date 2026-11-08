<?php
define('APP_ACCESO', true);
$titulo = 'Panel de administración';
$descripcion = 'Panel de administración de SIGEL con resumen de préstamos, parámetros de la regla de préstamo y estudiantes.';
$pagina_actual = 'panel.php';
require_once 'includes/encabezado.php';
?>
    <h1>Panel de administración</h1>
    <section>
      <h2>Resumen de hoy</h2>
      <p class="eq02-nota">Datos de demostración al 19/10/2026.</p>
      <div class="eq02-tarjetas">
        <article class="eq02-tarjeta">
          <h3>Equipos fuera</h3>
          <p><strong>4</strong> equipos fuera del laboratorio: 3 dentro del plazo y 1 vencido sin devolver.</p>
          <a href="principal_listado.php">Ver préstamos</a>
        </article>
        <article class="eq02-tarjeta">
          <h3>Vencidos</h3>
          <p><strong>1</strong> préstamo pasó su fecha de devolución.</p>
          <a href="principal_detalle.php#eq02-prestamo-ele-00045">Ver el préstamo vencido</a>
        </article>
        <article class="eq02-tarjeta">
          <h3>Inventario</h3>
          <p><strong>5</strong> equipos registrados; 1 disponible para préstamo.</p>
          <a href="secundaria_formulario.php">Gestionar equipos</a>
        </article>
      </div>
    </section>

    <div class="eq02-dos-columnas">
      <section>
        <h2>Estudiantes con préstamos</h2>
        <div class="eq02-tabla-contenedor">
          <table>
            <caption>¿Puede solicitar otro préstamo?</caption>
            <thead>
              <tr>
                <th scope="col">Estudiante</th>
                <th scope="col">Equipos en su poder</th>
                <th scope="col">Vencidos sin devolver</th>
                <th scope="col">¿Puede solicitar?</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Luis Gómez</th>
                <td>1</td>
                <td>1</td>
                <td><span class="eq02-estado eq02-estado-vencido">No, tiene un vencido</span></td>
              </tr>
              <tr>
                <th scope="row">Ana Torres</th>
                <td>1</td>
                <td>0</td>
                <td><span class="eq02-estado">Sí, 2 más</span></td>
              </tr>
              <tr>
                <th scope="row">Ariel Jimenez</th>
                <td>2</td>
                <td>0</td>
                <td><span class="eq02-estado">Sí, 1 más</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="eq02-nota">Un préstamo vencido sin devolver sigue contando como equipo en poder del estudiante.</p>
      </section>
      <section class="eq02-formulario">
        <h2>Parámetros de préstamo</h2>
        <form action="#" method="post">
          <p class="eq02-nota">Los campos marcados con <span class="eq02-obligatorio">*</span> son obligatorios.</p>
          <fieldset>
            <legend>Regla de negocio</legend>
            <div class="eq02-campo">
              <label for="max_equipos">Máximo de equipos por estudiante <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="number" id="max_equipos" name="max_equipos" required min="1" max="10" step="1" value="3">
            </div>
            <div class="eq02-campo">
              <label for="max_dias">Máximo de días por préstamo <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="number" id="max_dias" name="max_dias" required min="1" max="15" step="1" value="3">
            </div>
            <div class="eq02-opcion">
              <input type="checkbox" id="bloquear_vencidos" name="bloquear_vencidos" value="1" checked>
              <label for="bloquear_vencidos">Bloquear a quien tenga un préstamo vencido</label>
            </div>
          </fieldset>
          <button type="submit" class="eq02-boton">Guardar parámetros</button>
        </form>
      </section>
    </div>
<?php require_once 'includes/pie.php'; ?>
