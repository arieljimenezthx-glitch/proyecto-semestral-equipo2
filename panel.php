<?php
define('APP_ACCESO', true);
require_once 'config/datos_demo.php';
$titulo = 'Panel de administración';
$descripcion = 'Panel de administración de SIGEL con resumen de préstamos, parámetros de la regla de préstamo y estudiantes.';
$pagina_actual = 'panel.php';
require_once 'includes/encabezado.php';

$fuera = 0;
$vencidos = 0;
$personas = [];
foreach ($prestamos as $p) {
    if ($p['estado'] === 'Devuelto') {
        continue;
    }
    $fuera++;
    if (!isset($personas[$p['solicitante']])) {
        $personas[$p['solicitante']] = ['equipos' => 0, 'vencidos' => 0];
    }
    $personas[$p['solicitante']]['equipos']++;
    if ($p['estado'] === 'Vencido') {
        $vencidos++;
        $personas[$p['solicitante']]['vencidos']++;
    }
}
$dentroPlazo = $fuera - $vencidos;

$disponibles = 0;
foreach ($equipos as $codigo => $e) {
    $prestado = false;
    foreach ($prestamos as $p) {
        if ($p['codigo'] === $codigo && $p['estado'] !== 'Devuelto') {
            $prestado = true;
        }
    }
    if (!$prestado && !$e['en_reparacion']) {
        $disponibles++;
    }
}
?>
    <h1>Panel de administración</h1>
    <section>
      <h2>Resumen de hoy</h2>
      <p class="eq02-nota">Datos de demostración de config/datos_demo.php.</p>
      <div class="eq02-tarjetas">
        <article class="eq02-tarjeta">
          <h3>Equipos fuera</h3>
          <p><strong><?= $fuera ?></strong> equipos fuera del laboratorio: <?= $dentroPlazo ?> dentro del plazo y <?= $vencidos ?> vencido(s) sin devolver.</p>
          <a href="principal_listado.php?rol=laboratorista">Ver préstamos</a>
        </article>
        <article class="eq02-tarjeta">
          <h3>Vencidos</h3>
          <p><strong><?= $vencidos ?></strong> préstamo(s) pasó(aron) su fecha de devolución.</p>
          <a href="principal_listado.php?rol=laboratorista&amp;estado=vencido">Ver préstamos vencidos</a>
        </article>
        <article class="eq02-tarjeta">
          <h3>Inventario</h3>
          <p><strong><?= count($equipos) ?></strong> equipos registrados; <?= $disponibles ?> disponible(s) para préstamo.</p>
          <a href="secundaria_formulario.php?rol=administrador">Gestionar equipos</a>
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
                <th scope="col">Estudiante o docente</th>
                <th scope="col">Equipos en su poder</th>
                <th scope="col">Vencidos sin devolver</th>
                <th scope="col">¿Puede solicitar?</th>
              </tr>
            </thead>
            <tbody>
<?php if (count($personas) === 0): ?>
              <tr><td colspan="4">Nadie tiene equipos en su poder.</td></tr>
<?php endif; ?>
<?php foreach ($personas as $nombre => $datos): ?>
<?php $restantes = $parametros['max_equipos'] - $datos['equipos']; ?>
              <tr>
                <th scope="row"><?= escapar($nombre) ?></th>
                <td><?= $datos['equipos'] ?></td>
                <td><?= $datos['vencidos'] ?></td>
                <td>
<?php if ($datos['vencidos'] > 0): ?>
                  <span class="eq02-estado eq02-estado-vencido">No, tiene un vencido</span>
<?php elseif ($restantes > 0): ?>
                  <span class="eq02-estado">Sí, <?= $restantes ?> más</span>
<?php else: ?>
                  <span class="eq02-estado">No, llegó al máximo</span>
<?php endif; ?>
                </td>
              </tr>
<?php endforeach; ?>
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
              <input type="number" id="max_equipos" name="max_equipos" required min="1" max="10" step="1" value="<?= escapar($parametros['max_equipos']) ?>">
            </div>
            <div class="eq02-campo">
              <label for="max_dias">Máximo de días por préstamo <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="number" id="max_dias" name="max_dias" required min="1" max="15" step="1" value="<?= escapar($parametros['max_dias']) ?>">
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
