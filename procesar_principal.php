<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('principal_formulario.php');
}

$cedula = (isset($_POST['cedula_estudiante']) && is_string($_POST['cedula_estudiante'])) ? limpiar($_POST['cedula_estudiante']) : '';
$correo = (isset($_POST['correo_estudiante']) && is_string($_POST['correo_estudiante'])) ? limpiar($_POST['correo_estudiante']) : '';
$codigo = (isset($_POST['codigo_inventario']) && is_string($_POST['codigo_inventario'])) ? limpiar($_POST['codigo_inventario']) : '';
$tipo = (isset($_POST['tipo_item']) && is_string($_POST['tipo_item'])) ? limpiar($_POST['tipo_item']) : '';
$fecha_prestamo = (isset($_POST['fecha_prestamo']) && is_string($_POST['fecha_prestamo'])) ? fecha_iso(limpiar($_POST['fecha_prestamo'])) : '';
$fecha_devolucion = (isset($_POST['fecha_devolucion']) && is_string($_POST['fecha_devolucion'])) ? fecha_iso(limpiar($_POST['fecha_devolucion'])) : '';
$accesorios = (isset($_POST['cantidad_accesorios']) && is_string($_POST['cantidad_accesorios'])) ? limpiar($_POST['cantidad_accesorios']) : '';
$motivo = (isset($_POST['motivo']) && is_string($_POST['motivo'])) ? limpiar($_POST['motivo']) : '';

if ($accesorios === '') {
    $accesorios = '0';
}

$errores = [];

if (!preg_match('/^[0-9]{1,2}-[0-9]{1,4}-[0-9]{1,6}$/', $cedula)) {
    $errores[] = 'La cédula del estudiante debe escribirse con guiones, por ejemplo 8-123-4567.';
}
if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false || !preg_match('/@utp\.ac\.pa$/', $correo)) {
    $errores[] = 'El correo del estudiante debe ser institucional, que termina en @utp.ac.pa.';
}
if (!preg_match('/^[A-Z]{3}-[0-9]{5}$/', $codigo)) {
    $errores[] = 'El código de inventario debe tener 3 letras mayúsculas, guion y 5 números.';
} elseif (!isset($equipos[$codigo])) {
    $errores[] = 'El código de inventario no existe.';
} elseif ($equipos[$codigo]['en_reparacion']) {
    $errores[] = 'Equipo no disponible.';
}
if ($tipo !== 'equipo' && $tipo !== 'kit') {
    $errores[] = 'Indica si el ítem es equipo o kit.';
}

$fechas_ok = preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_prestamo) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_devolucion);
if (!$fechas_ok) {
    $errores[] = 'Las fechas del préstamo no son válidas.';
} else {
    $dias = (strtotime($fecha_devolucion) - strtotime($fecha_prestamo)) / 86400;
    if ($dias < 1 || $dias > $parametros['max_dias']) {
        $errores[] = 'La devolución debe ser de 1 a 3 días después del préstamo.';
    }
}

if (filter_var($accesorios, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 10]]) === false) {
    $errores[] = 'Los accesorios deben ser un número entre 0 y 10.';
}
if (strlen($motivo) < 10 || strlen($motivo) > 300) {
    $errores[] = 'El motivo debe tener entre 10 y 300 caracteres.';
}

$activos = 0;
$vencido = false;
foreach ($prestamos as $p) {
    if (isset($p['correo']) && $p['correo'] === $correo) {
        if ($p['estado'] !== 'Devuelto') {
            $activos++;
        }
        if ($p['estado'] === 'Vencido') {
            $vencido = true;
        }
    }
}
if ($vencido) {
    $errores[] = 'Tienes un préstamo vencido. No puedes solicitar otro hasta devolverlo.';
}
if ($activos >= $parametros['max_equipos']) {
    $errores[] = 'Ya tienes el máximo de ' . $parametros['max_equipos'] . ' equipos prestados.';
}

$titulo = 'Solicitud de préstamo';
$descripcion = 'Resultado de la solicitud de préstamo en SIGEL.';
$pagina_actual = 'principal_formulario.php';
require_once 'includes/encabezado.php';
?>
    <section class="eq02-formulario">
<?php if (count($errores) > 0): ?>
      <h1>No se pudo registrar el préstamo</h1>
      <?= mostrar_errores($errores) ?>
      <p><a href="principal_formulario.php?rol=<?= escapar($rol) ?>" class="eq02-boton">Volver al formulario</a></p>
<?php else: ?>
      <h1>Préstamo registrado</h1>
      <ul>
        <li>Equipo: <?= escapar($codigo) ?> (<?= escapar($equipos[$codigo]['nombre']) ?>)</li>
        <li>Lugar de retiro: <?= escapar($equipos[$codigo]['lugar']) ?></li>
        <li>Estudiante: <?= escapar($correo) ?></li>
        <li>Préstamo: <?= escapar(formatear_fecha($fecha_prestamo)) ?></li>
        <li>Devolución: <?= escapar(formatear_fecha($fecha_devolucion)) ?></li>
        <li>Accesorios: <?= escapar($accesorios) ?></li>
      </ul>
      <p class="eq02-nota">Demostración: el préstamo todavía no se guarda en base de datos. Eso llega en el Hito #3.</p>
<?php endif; ?>
    </section>
<?php require_once 'includes/pie.php'; ?>
