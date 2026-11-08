<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('secundaria_formulario.php');
}

$codigo = (isset($_POST['codigo_inventario']) && is_string($_POST['codigo_inventario'])) ? limpiar($_POST['codigo_inventario']) : '';
$nombre = (isset($_POST['nombre_equipo']) && is_string($_POST['nombre_equipo'])) ? limpiar($_POST['nombre_equipo']) : '';
$marca = (isset($_POST['marca']) && is_string($_POST['marca'])) ? limpiar($_POST['marca']) : '';
$serie = (isset($_POST['numero_serie']) && is_string($_POST['numero_serie'])) ? limpiar($_POST['numero_serie']) : '';
$categoria = (isset($_POST['categoria']) && is_string($_POST['categoria'])) ? limpiar($_POST['categoria']) : '';
$fecha = (isset($_POST['fecha_adquisicion']) && is_string($_POST['fecha_adquisicion'])) ? limpiar($_POST['fecha_adquisicion']) : '';
$manual = (isset($_POST['url_manual']) && is_string($_POST['url_manual'])) ? limpiar($_POST['url_manual']) : '';
$disponible = isset($_POST['disponible']) && $_POST['disponible'] === '1';

$errores = [];

if (!preg_match('/^[A-Z]{3}-[0-9]{5}$/', $codigo)) {
    $errores[] = 'El código debe tener 3 letras mayúsculas, guion y 5 números, por ejemplo RED-00123.';
} elseif (isset($equipos[$codigo])) {
    $errores[] = 'Ya existe un equipo con ese código.';
}
if (strlen($nombre) < 3 || strlen($nombre) > 80) {
    $errores[] = 'El nombre del equipo debe tener entre 3 y 80 caracteres.';
}
if (strlen($marca) > 60) {
    $errores[] = 'La marca y el modelo no pueden pasar de 60 caracteres.';
}
if (strlen($serie) > 40) {
    $errores[] = 'El número de serie no puede pasar de 40 caracteres.';
}
if (!in_array($categoria, ['electronica', 'medicion', 'redes', 'computo', 'kit', 'accesorio'], true)) {
    $errores[] = 'Selecciona una categoría de la lista.';
}
if ($fecha !== '') {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha) || $fecha > '2026-10-19') {
        $errores[] = 'La fecha de adquisición no es válida ni puede ser posterior al 19/10/2026.';
    }
}
if ($manual !== '' && (filter_var($manual, FILTER_VALIDATE_URL) === false || strlen($manual) > 200)) {
    $errores[] = 'El enlace al manual debe ser una dirección web válida de hasta 200 caracteres.';
}

$titulo = 'Registro de equipo';
$descripcion = 'Resultado del registro de equipo en SIGEL.';
$pagina_actual = 'secundaria_formulario.php';
require_once 'includes/encabezado.php';
?>
    <section class="eq02-formulario">
<?php if (count($errores) > 0): ?>
      <h1>No se pudo registrar el equipo</h1>
      <?= mostrar_errores($errores) ?>
      <p><a href="secundaria_formulario.php?rol=<?= escapar($rol) ?>" class="eq02-boton">Volver al formulario</a></p>
<?php else: ?>
      <h1>Equipo registrado</h1>
      <ul>
        <li>Código: <?= escapar($codigo) ?></li>
        <li>Equipo: <?= escapar($nombre) ?></li>
        <li>Marca y modelo: <?= escapar($marca) ?></li>
        <li>Número de serie: <?= escapar($serie) ?></li>
        <li>Categoría: <?= escapar($categoria) ?></li>
        <li>Fecha de adquisición: <?= $fecha !== '' ? escapar(formatear_fecha($fecha)) : 'No indicada' ?></li>
        <li>Disponible para préstamo: <?= $disponible ? 'Sí' : 'No' ?></li>
      </ul>
      <p class="eq02-nota">Demostración: el equipo todavía no se guarda en base de datos. Eso llega en el Hito #3.</p>
<?php endif; ?>
    </section>
<?php require_once 'includes/pie.php'; ?>
