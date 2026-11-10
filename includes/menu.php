<?php
defined('APP_ACCESO') or exit('Acceso denegado');

$menu = [
    'index.php' => ['texto' => 'Inicio', 'roles' => ['estudiante', 'docente', 'laboratorista', 'administrador']],
    'principal_formulario.php' => ['texto' => 'Solicitar préstamo', 'roles' => ['estudiante', 'docente', 'laboratorista']],
    'principal_listado.php' => ['texto' => 'Préstamos', 'roles' => ['docente', 'laboratorista']],
    'secundaria_formulario.php' => ['texto' => 'Equipos', 'roles' => ['administrador']],
    'panel.php' => ['texto' => 'Panel', 'roles' => ['administrador']],
    'perfil.php' => ['texto' => 'Mi perfil', 'roles' => ['estudiante']],
    'login.php' => ['texto' => 'Iniciar sesión', 'roles' => ['estudiante', 'docente', 'laboratorista', 'administrador']],
];
?>
<nav class="eq02-menu" aria-label="Menú principal">
  <ul>
    <?php foreach ($menu as $ruta => $item): ?>
      <?php if (in_array($rol, $item['roles'], true)): ?>
        <?php $activo = (isset($pagina_actual) && $pagina_actual === $ruta); ?>
        <li><a href="<?= escapar($ruta) ?>?rol=<?= escapar($rol) ?>"<?= $activo ? ' class="eq02-activo" aria-current="page"' : '' ?>><?= escapar($item['texto']) ?></a></li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</nav>
