<?php
define('APP_ACCESO', true);
$titulo = 'Listado de préstamos';
$descripcion = 'Listado de préstamos de equipos del laboratorio con búsqueda por estudiante o código y filtros por estado.';
$pagina_actual = 'principal_listado.php';
require_once 'includes/encabezado.php';
?>
    <h1>Préstamos de equipos</h1>
    <section class="eq02-formulario">
      <h2>Buscar y filtrar</h2>
      <form action="#" method="post" class="eq02-filtros">
        <div class="eq02-campo">
          <label for="buscar">Estudiante o código de inventario</label>
          <input type="search" id="buscar" name="buscar" maxlength="60" placeholder="Ej.: Gómez o ELE-00045">
        </div>
        <div class="eq02-campo">
          <label for="estado">Estado</label>
          <select id="estado" name="estado">
            <option value="todos">Todos</option>
            <option value="activo">Activo</option>
            <option value="vencido">Vencido</option>
            <option value="devuelto">Devuelto</option>
          </select>
        </div>
        <div class="eq02-campo">
          <label for="fecha_desde">Desde</label>
          <input type="date" id="fecha_desde" name="fecha_desde" min="2026-01-01" max="2026-12-31">
        </div>
        <div class="eq02-campo">
          <button type="submit" class="eq02-boton">Buscar</button>
        </div>
      </form>
    </section>

    <section>
      <h2>Resultados</h2>
      <p class="eq02-nota">Datos de demostración al 19/10/2026. En la maqueta la búsqueda y los filtros no cambian la tabla.</p>
      <p class="eq02-acciones"><a href="principal_formulario.php" class="eq02-boton">Nuevo préstamo</a></p>
      <div class="eq02-tabla-contenedor">
        <table>
          <caption>Préstamos registrados en octubre de 2026 (5)</caption>
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
            <tr>
              <th scope="row">ELE-00045</th>
              <td>Osciloscopio digital</td>
              <td>Luis Gómez</td>
              <td><time datetime="2026-10-13">13/10/2026</time></td>
              <td><time datetime="2026-10-16">16/10/2026</time></td>
              <td><span class="eq02-estado eq02-estado-vencido">Vencido</span></td>
              <td><a href="principal_detalle.php#eq02-prestamo-ele-00045" aria-label="Ver detalle del préstamo ELE-00045">Ver detalle</a></td>
            </tr>
            <tr>
              <th scope="row">MED-00012</th>
              <td>Multímetro digital</td>
              <td>Ana Torres</td>
              <td><time datetime="2026-10-18">18/10/2026</time></td>
              <td><time datetime="2026-10-21">21/10/2026</time></td>
              <td><span class="eq02-estado">Activo</span></td>
              <td><a href="principal_detalle.php#eq02-prestamo-med-00012" aria-label="Ver detalle del préstamo MED-00012">Ver detalle</a></td>
            </tr>
            <tr>
              <th scope="row">KIT-00007</th>
              <td>Kit Arduino Uno</td>
              <td>Ariel Jimenez</td>
              <td><time datetime="2026-10-19">19/10/2026</time></td>
              <td><time datetime="2026-10-22">22/10/2026</time></td>
              <td><span class="eq02-estado">Activo</span></td>
              <td><a href="principal_detalle.php#eq02-prestamo-kit-00007" aria-label="Ver detalle del préstamo KIT-00007">Ver detalle</a></td>
            </tr>
            <tr>
              <th scope="row">MED-00020</th>
              <td>Multímetro digital</td>
              <td>Ariel Jimenez</td>
              <td><time datetime="2026-10-18">18/10/2026</time></td>
              <td><time datetime="2026-10-21">21/10/2026</time></td>
              <td><span class="eq02-estado">Activo</span></td>
              <td><a href="principal_detalle.php#eq02-prestamo-med-00020" aria-label="Ver detalle del préstamo MED-00020">Ver detalle</a></td>
            </tr>
            <tr>
              <th scope="row">RED-00123</th>
              <td>Router Cisco 1941</td>
              <td>María Ríos</td>
              <td><time datetime="2026-10-09">09/10/2026</time></td>
              <td><time datetime="2026-10-12">12/10/2026</time></td>
              <td><span class="eq02-estado eq02-estado-devuelto">Devuelto</span></td>
              <td><a href="principal_detalle.php#eq02-prestamo-red-00123" aria-label="Ver detalle del préstamo RED-00123">Ver detalle</a></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7">5 préstamos · 3 activos dentro del plazo · 1 vencido sin devolver · 1 devuelto</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </section>
<?php require_once 'includes/pie.php'; ?>
