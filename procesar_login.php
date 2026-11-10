<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'clases/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('login.php');
}

$correo = (isset($_POST['correo']) && is_string($_POST['correo'])) ? limpiar($_POST['correo']) : '';
$contrasena = (isset($_POST['contrasena']) && is_string($_POST['contrasena'])) ? $_POST['contrasena'] : '';
$rol = (isset($_POST['rol']) && is_string($_POST['rol'])) ? limpiar($_POST['rol']) : '';

$cuentas = [
    'demo.estudiante@utp.ac.pa' => [
        'hash' => '$2y$10$xfdI1ey/os8Rs6c76ZKEy.UlIVUJl7Ug2PGqRyBRdVFwRyA/3dIaa',
        'rol' => 'estudiante',
    ],
];

$errores = [];

if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false || !preg_match('/@utp\.ac\.pa$/', $correo)) {
    $errores[] = 'Usa tu correo institucional, que termina en @utp.ac.pa.';
}
if (strlen($contrasena) < 8) {
    $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
}
if (!in_array($rol, ['estudiante', 'laboratorista', 'administrador'], true)) {
    $errores[] = 'Selecciona un rol válido.';
}

if (count($errores) === 0) {
    if (!isset($cuentas[$correo])) {
        $errores[] = 'Correo o contraseña incorrectos.';
    } else {
        $usuario = new Usuario($correo, $cuentas[$correo]['rol'], $cuentas[$correo]['hash']);
        if (!$usuario->verificarContrasena($contrasena)) {
            $errores[] = 'Correo o contraseña incorrectos.';
        } elseif ($usuario->getRol() !== $rol) {
            $errores[] = 'El rol elegido no corresponde a tu cuenta.';
        }
    }
}

if (count($errores) === 0) {
    redirigir('index.php?rol=' . $rol);
}

$titulo = 'Revisa tu inicio de sesión';
$descripcion = 'Inicio de sesión en SIGEL.';
$pagina_actual = 'login.php';
require_once 'includes/encabezado.php';
?>
    <section class="eq02-formulario">
      <h1>No se pudo iniciar sesión</h1>
      <?= mostrar_errores($errores) ?>
      <p><a href="login.php?rol=<?= escapar($rol) ?>" class="eq02-boton">Volver a iniciar sesión</a></p>
    </section>
<?php require_once 'includes/pie.php'; ?>
