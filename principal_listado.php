<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';

$titulo = 'Listado de préstamos';
$descripcion = 'Listado de préstamos de equipos del laboratorio con búsqueda por estudiante o código y filtros por estado y fechas.';
$pagina_actual = 'principal_listado.php';

// Parámetros GET: se limpian y se validan contra listas blancas.
$buscar = (isset($_GET['buscar']) && is_string($_GET['buscar'])) ? limpiar($_GET['buscar']) : '';
if (strlen($buscar) > 60) {
    $buscar = substr($buscar, 0, 60);
}

$estados_validos = ['todos', 'activo', 'vencido', 'devuelto'];
$estado = (isset($_GET['estado']) && is_string($_GET['estado'])) ? limpiar($_GET['estado']) : 'todos';
if (!in_array($estado, $estados_validos, true)) {
    $estado = 'todos';
}

$desde = (isset($_GET['fecha_desde']) && is_string($_GET['fecha_desde'])) ? limpiar($_GET['fecha_desde']) : '';
$desdeIso = fecha_iso($desde);

$hasta = (isset($_GET['fecha_hasta']) && is_string($_GET['fecha_hasta'])) ? limpiar($_GET['fecha_hasta']) : '';
$hastaIso = fecha_iso($hasta);

// Filtrado de los préstamos de demostración.
$filtrados = [];
foreach ($prestamos as $p) {
    $texto = $p['codigo'] . ' ' . $p['solicitante'];
    if ($buscar !== '' && stripos($texto, $buscar) === false) {
        continue;
    }
    if ($estado !== 'todos' && strtolower($p['estado']) !== $estado) {
        continue;
    }
    if ($desdeIso !== '' && $p['salida'] < $desdeIso) {
        continue;
    }
    if ($hastaIso !== '' && $p['salida'] > $hastaIso) {
        continue;
    }
    $filtrados[] = $p;
}

// Paginación: 5 por página; un número inválido o fuera de rango cae en una página válida.
$porPagina = 5;
$total = count($filtrados);
$totalPaginas = max(1, (int) ceil($total / $porPagina));
$pagina = filter_var(isset($_GET['pagina']) ? $_GET['pagina'] : 1, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($pagina === false) {
    $pagina = 1;
}
if ($pagina > $totalPaginas) {
    $pagina = $totalPaginas;
}
$visibles = array_slice($filtrados, ($pagina - 1) * $porPagina, $porPagina);

require_once 'includes/encabezado.php';
?>
    <h1>Préstamos de equipos</h1>

    <section class="eq02-formulario">
      <h2>Buscar</h2>
      <form method="get" action="principal_listado.php" class="eq02-filtros">
        <input type="hidden" name="rol" value="<?= escapar($rol) ?>">
        <input type="hidden" name="estado" value="<?= escapar($estado) ?>">
        <input type="hidden" name="fecha_desde" value="<?= escapar($desde) ?>">
        <input type="hidden" name="fecha_hasta" value="<?= escapar($hasta) ?>">
        <div class="eq02-campo">
          <label for="buscar">Estudiante o código de inventario</label>
          <input type="search" id="buscar" name="buscar" maxlength="60" value="<?= escapar($buscar) ?>" placeholder="Ej.: Gómez o ELE-00045">
        </div>
        <div class="eq02-campo">
          <button type="submit" class="eq02-boton">Buscar</button>
        </div>
      </form>
    </section>

    <section class="eq02-formulario">
      <h2>Filtrar por estado y fechas</h2>
      <form method="get" action="principal_listado.php" class="eq02-filtros">
        <input type="hidden" name="rol" value="<?= escapar($rol) ?>">
        <input type="hidden" name="buscar" value="<?= escapar($buscar) ?>">
        <div class="eq02-campo">
          <label for="estado">Estado</label>
          <select id="estado" name="estado">
            <option value="todos"<?= $estado === 'todos' ? ' selected' : '' ?>>Todos</option>
            <option value="activo"<?= $estado === 'activo' ? ' selected' : '' ?>>Activo</option>
            <option value="vencido"<?= $estado === 'vencido' ? ' selected' : '' ?>>Vencido</option>
            <option value="devuelto"<?= $estado === 'devuelto' ? ' selected' : '' ?>>Devuelto</option>
          </select>
        </div>
        <div class="eq02-campo">
          <label for="fecha_desde">Desde</label>
          <input type="text" placeholder="dd/mm/aaaa" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" maxlength="10" id="fecha_desde" name="fecha_desde" value="<?= escapar($desde) ?>">
        </div>
        <div class="eq02-campo">
          <label for="fecha_hasta">Hasta</label>
          <input type="text" placeholder="dd/mm/aaaa" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" maxlength="10" id="fecha_hasta" name="fecha_hasta" value="<?= escapar($hasta) ?>">
        </div>
        <div class="eq02-campo">
          <button type="submit" class="eq02-boton">Filtrar</button>
        </div>
      </form>
    </section>

    <section>
      <h2>Resultados</h2>
      <p class="eq02-nota">Datos de demostración de config/datos_demo.php. Se muestran 5 por página.</p>
      <p class="eq02-acciones"><a href="principal_formulario.php?rol=<?= escapar($rol) ?>" class="eq02-boton">Nuevo préstamo</a></p>
      <div class="eq02-tabla-contenedor">
        <table>
          <caption>Préstamos encontrados (<?= $total ?>)</caption>
          <thead>
            <tr>
              <th scope="col">Código</th>
              <th scope="col">Equipo</th>
              <th scope="col">Estudiante</th>
              <th scope="col">Préstamo</th>
              <th scope="col">Devolución</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($total === 0): ?>
              <tr><td colspan="7">No hay préstamos con esos filtros.</td></tr>
            <?php endif; ?>
            <?php foreach ($visibles as $p): ?>
              <?php
                $codigo = $p['codigo'];
                $nombre = isset($equipos[$codigo]) ? $equipos[$codigo]['nombre'] : 'Equipo sin nombre';
                $clase = 'eq02-estado';
                if ($p['estado'] === 'Vencido') {
                    $clase .= ' eq02-estado-vencido';
                }
                if ($p['estado'] === 'Devuelto') {
                    $clase .= ' eq02-estado-devuelto';
                }
              ?>
              <tr>
                <th scope="row"><?= escapar($codigo) ?></th>
                <td><?= escapar($nombre) ?></td>
                <td><?= escapar($p['solicitante']) ?></td>
                <td><time datetime="<?= escapar($p['salida']) ?>"><?= escapar(formatear_fecha($p['salida'])) ?></time></td>
                <td><time datetime="<?= escapar($p['devolucion']) ?>"><?= escapar(formatear_fecha($p['devolucion'])) ?></time></td>
                <td><span class="<?= escapar($clase) ?>"><?= escapar($p['estado']) ?></span></td>
                <td><a href="principal_detalle.php?codigo=<?= escapar($codigo) ?>" aria-label="Ver detalle del préstamo <?= escapar($codigo) ?>">Ver detalle</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"><?= $total ?> préstamos · página <?= $pagina ?> de <?= $totalPaginas ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <nav aria-label="Paginación" class="eq02-acciones">
        <?php if ($pagina > 1): ?>
          <a href="?<?= escapar(http_build_query(array_merge($_GET, ['pagina' => $pagina - 1]))) ?>" class="eq02-boton eq02-boton-secundario">Anterior</a>
        <?php endif; ?>
        <span>Página <?= $pagina ?> de <?= $totalPaginas ?></span>
        <?php if ($pagina < $totalPaginas): ?>
          <a href="?<?= escapar(http_build_query(array_merge($_GET, ['pagina' => $pagina + 1]))) ?>" class="eq02-boton eq02-boton-secundario">Siguiente</a>
        <?php endif; ?>
      </nav>
    </section>
<?php require_once 'includes/pie.php'; ?>
