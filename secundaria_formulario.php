<?php
define('APP_ACCESO', true);
require_once 'config/datos_demo.php';
$titulo = 'Registro de equipos';
$descripcion = 'Registro y listado de los equipos del inventario del laboratorio con su código de inventario.';
$pagina_actual = 'secundaria_formulario.php';
require_once 'includes/encabezado.php';
?>
    <h1>Equipos del inventario</h1>
    <div class="eq02-dos-columnas">
      <section class="eq02-formulario">
        <h2>Registrar equipo</h2>
        <form action="procesar_secundaria.php" method="post" enctype="multipart/form-data">
          <p class="eq02-nota">Los campos marcados con <span class="eq02-obligatorio">*</span> son obligatorios.</p>
          <fieldset>
            <legend>Identificación</legend>
            <div class="eq02-rejilla">
              <div class="eq02-campo">
                <label for="codigo_inventario">Código de inventario <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <input type="text" id="codigo_inventario" name="codigo_inventario" required pattern="[A-Z]{3}-[0-9]{5}" minlength="9" maxlength="9" autocomplete="off" placeholder="RED-00123">
              </div>
              <div class="eq02-campo">
                <label for="nombre_equipo">Nombre del equipo <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <input type="text" id="nombre_equipo" name="nombre_equipo" required minlength="3" maxlength="80" placeholder="Osciloscopio digital">
              </div>
              <div class="eq02-campo">
                <label for="marca">Marca y modelo</label>
                <input type="text" id="marca" name="marca" maxlength="60" placeholder="Rigol DS1054Z">
              </div>
              <div class="eq02-campo">
                <label for="numero_serie">Número de serie</label>
                <input type="text" id="numero_serie" name="numero_serie" maxlength="40" autocomplete="off" placeholder="DS1ZA2020">
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>Clasificación</legend>
            <div class="eq02-rejilla">
              <div class="eq02-campo">
                <label for="categoria">Categoría <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
                <select id="categoria" name="categoria" required>
                  <option value="">Seleccione</option>
                  <option value="electronica">Electrónica</option>
                  <option value="medicion">Medición</option>
                  <option value="redes">Redes</option>
                  <option value="computo">Cómputo</option>
                  <option value="kit">Kit</option>
                  <option value="accesorio">Cable o accesorio</option>
                </select>
              </div>
              <div class="eq02-campo">
                <label for="fecha_adquisicion">Fecha de adquisición</label>
                <input type="text" id="fecha_adquisicion" name="fecha_adquisicion" placeholder="dd/mm/aaaa" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" maxlength="10">
              </div>
              <div class="eq02-campo">
                <label for="foto_equipo">Foto del equipo</label>
                <input type="file" id="foto_equipo" name="foto_equipo" accept="image/png, image/jpeg">
              </div>
              <div class="eq02-campo">
                <label for="url_manual">Enlace al manual</label>
                <input type="url" id="url_manual" name="url_manual" maxlength="200" placeholder="https://fabricante.com/manual.pdf">
              </div>
            </div>
            <div class="eq02-opcion">
              <input type="checkbox" id="disponible" name="disponible" value="1" checked>
              <label for="disponible">Disponible para préstamo</label>
            </div>
          </fieldset>
          <button type="submit" class="eq02-boton">Guardar equipo</button>
        </form>
      </section>
      <aside class="eq02-aside">
        <h2>Códigos por categoría</h2>
        <ul>
          <li><code>ELE</code> electrónica: osciloscopios, fuentes y generadores</li>
          <li><code>MED</code> medición: multímetros</li>
          <li><code>RED</code> redes</li>
          <li><code>KIT</code> kits</li>
          <li><code>COM</code> cómputo</li>
        </ul>
        <figure>
          <img src="img/multimetro.svg" alt="Ilustración de un multímetro digital" width="160" height="120">
          <figcaption>Cada equipo lleva su código en una etiqueta.</figcaption>
        </figure>
      </aside>
    </div>

    <section>
      <h2>Listado de equipos</h2>
      <p class="eq02-nota">Datos de demostración del inventario.</p>
      <div class="eq02-tabla-contenedor">
        <table>
          <caption>Equipos registrados en el inventario (<?= count($equipos) ?>)</caption>
          <thead>
            <tr>
              <th scope="col">Código</th>
              <th scope="col">Equipo</th>
              <th scope="col">Categoría</th>
              <th scope="col">Disponible</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($equipos as $codigo => $e): ?>
              <?php
                $disponible = 'Sí';
                if ($e['en_reparacion']) {
                    $disponible = 'No (en reparación)';
                }
                foreach ($prestamos as $p) {
                    if ($p['codigo'] === $codigo && $p['estado'] !== 'Devuelto') {
                        $disponible = 'No (prestado)';
                    }
                }
              ?>
              <tr>
                <th scope="row"><?= escapar($codigo) ?></th>
                <td><?= escapar($e['nombre']) ?></td>
                <td><?= escapar($e['categoria']) ?></td>
                <td><?= escapar($disponible) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
<?php require_once 'includes/pie.php'; ?>