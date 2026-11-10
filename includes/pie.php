<?php
defined('APP_ACCESO') or exit('Acceso denegado');

$paginas = [
    'index.php' => 'Inicio',
    'login.php' => 'Iniciar sesión',
    'registro.php' => 'Registro',
    'recuperar.php' => 'Recuperar contraseña',
    'principal_formulario.php' => 'Solicitar préstamo',
    'principal_listado.php' => 'Listado de préstamos',
    'principal_detalle.php' => 'Detalle del préstamo',
    'secundaria_formulario.php' => 'Registro de equipos',
    'panel.php' => 'Panel de administración',
    'perfil.php' => 'Mi perfil',
];
?>
  </main>

  <footer id="eq02-pie" class="eq02-pie">
    <nav aria-label="Mapa del sitio">
      <h2>Mapa del sitio</h2>
      <ul class="eq02-mapa">
        <?php foreach ($paginas as $ruta => $texto): ?>
          <li><a href="<?= escapar($ruta) ?>?rol=<?= escapar($rol) ?>"><?= escapar($texto) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <p><small>&copy; 2026 SIGEL · Equipo 02 · Ariel Jimenez y Alejandro Saenz · Desarrollo Web</small></p>
  </footer>
</body>
</html>
