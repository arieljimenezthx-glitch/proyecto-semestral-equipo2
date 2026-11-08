<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';

// Solo se aceptan envíos por POST; cualquier otro acceso vuelve al formulario.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('registro.php');
}

// Lista blanca de carreras: debe coincidir con las opciones de registro.php.
$carreras_validas = [
    'fct-ingenieria-en-alimentos',
    'fct-ingenieria-forestal',
    'fct-ingenieria-quimica',
    'fct-comunicacion-ejecutiva-bilingue',
    'fic-ingenieria-civil',
    'fic-ingenieria-ambiental',
    'fic-ingenieria-geologica',
    'fic-ingenieria-geomatica',
    'fic-ingenieria-maritima-portuaria',
    'fic-ingenieria-en-administracion-de-proyectos-de-construccion',
    'fic-dibujo-automatizado',
    'fic-edificaciones',
    'fic-operaciones-maritimas-y-portuarias',
    'fic-saneamiento-y-ambiente',
    'fic-topografia',
    'fic-modelado-y-gestion-digital-en-proyectos',
    'fie-ingenieria-electrica',
    'fie-ingenieria-electrica-y-electronica',
    'fie-ingenieria-electromecanica',
    'fie-ingenieria-electronica-industrial',
    'fie-ingenieria-electronica-y-telecomunicaciones',
    'fie-ingenieria-de-control-y-automatizacion',
    'fie-ingenieria-electronica',
    'fie-ingenieria-en-telecomunicaciones',
    'fie-electronica-y-sistemas-de-comunicacion',
    'fie-sistemas-electricos-y-automatizacion',
    'fie-tecnico-en-ingenieria-electromecanica-industrial',
    'fie-tecnico-en-ingenieria-con-especializacion-en-electronica-biomedica',
    'fie-tecnico-en-ingenieria-con-especializacion-en-sistemas-electricos',
    'fie-tecnico-en-ingenieria-con-especializacion-en-telecomunicaciones',
    'fie-tecnico-en-ingenieria-con-especializacion-en-autotronica',
    'fii-ingenieria-industrial',
    'fii-ingenieria-logistica-y-cadena-de-suministro',
    'fii-ingenieria-mecanica-industrial',
    'fii-ingenieria-en-seguridad-industrial-e-higiene-ocupacional',
    'fii-gestion-administrativa',
    'fii-gestion-de-la-produccion-industrial',
    'fii-logistica-y-transporte-multimodal',
    'fii-mercadeo-y-negocios-internacionales',
    'fii-recursos-humanos-y-gestion-de-la-productividad',
    'fii-mercadeo-y-comercio-internacional',
    'fim-ingenieria-mecanica',
    'fim-ingenieria-de-mantenimiento',
    'fim-ingenieria-naval',
    'fim-ingenieria-aeronautica',
    'fim-ingenieria-de-energia-y-ambiente',
    'fim-mecanica-industrial',
    'fim-refrigeracion-y-aire-acondicionado',
    'fim-mecanica-automotriz',
    'fim-soldadura',
    'fim-administracion-de-aviacion',
    'fim-administracion-de-aviacion-con-opcion-a-vuelo-piloto',
    'fim-tecnico-en-ingenieria-de-mantenimiento-de-aeronaves-con-especializacion-en-motores-y-fuselajes',
    'fim-tecnico-en-despacho-de-vuelo',
    'fisc-ingenieria-de-sistemas-de-informacion',
    'fisc-ingenieria-de-sistemas-de-informacion-gerencial',
    'fisc-ingenieria-de-sistemas-y-computacion',
    'fisc-ingenieria-de-software',
    'fisc-ciberseguridad',
    'fisc-ciencias-de-la-computacion',
    'fisc-desarrollo-de-software',
    'fisc-desarrollo-y-gestion-de-software',
    'fisc-informatica-aplicada-a-la-educacion',
    'fisc-redes-informaticas',
    'fisc-tecnico-en-informatica-para-la-gestion-empresarial',
];

// Lectura y limpieza de cada campo. Si no llega, queda vacío.
$nombre = (isset($_POST['nombre']) && is_string($_POST['nombre'])) ? limpiar($_POST['nombre']) : '';
$apellido = (isset($_POST['apellido']) && is_string($_POST['apellido'])) ? limpiar($_POST['apellido']) : '';
$cedula = (isset($_POST['cedula']) && is_string($_POST['cedula'])) ? limpiar($_POST['cedula']) : '';
$fecha_nacimiento = (isset($_POST['fecha_nacimiento']) && is_string($_POST['fecha_nacimiento'])) ? limpiar($_POST['fecha_nacimiento']) : '';
$correo = (isset($_POST['correo']) && is_string($_POST['correo'])) ? limpiar($_POST['correo']) : '';
$telefono = (isset($_POST['telefono']) && is_string($_POST['telefono'])) ? limpiar($_POST['telefono']) : '';
$carrera = (isset($_POST['carrera']) && is_string($_POST['carrera'])) ? limpiar($_POST['carrera']) : '';
$semestre = (isset($_POST['semestre']) && is_string($_POST['semestre'])) ? limpiar($_POST['semestre']) : '';
$contrasena = (isset($_POST['contrasena']) && is_string($_POST['contrasena'])) ? $_POST['contrasena'] : '';
$confirmar_contrasena = (isset($_POST['confirmar_contrasena']) && is_string($_POST['confirmar_contrasena'])) ? $_POST['confirmar_contrasena'] : '';
$acepta_reglamento = isset($_POST['acepta_reglamento']) && $_POST['acepta_reglamento'] === '1';

// Validación en el servidor: nunca se confía en lo que hace el navegador.
$errores = [];

if (strlen($nombre) < 2 || strlen($nombre) > 50) {
    $errores[] = 'El nombre debe tener entre 2 y 50 caracteres.';
}
if (strlen($apellido) < 2 || strlen($apellido) > 50) {
    $errores[] = 'El apellido debe tener entre 2 y 50 caracteres.';
}
if (!preg_match('/^[0-9]{1,2}-[0-9]{1,4}-[0-9]{1,6}$/', $cedula)) {
    $errores[] = 'La cédula debe escribirse con guiones, por ejemplo 8-123-4567.';
}
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_nacimiento) || !checkdate((int) substr($fecha_nacimiento, 5, 2), (int) substr($fecha_nacimiento, 8, 2), (int) substr($fecha_nacimiento, 0, 4)) || $fecha_nacimiento > '2026-10-19') {
    $errores[] = 'Escribe una fecha de nacimiento válida, no posterior al 19/10/2026.';
}
if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false || !preg_match('/@utp\.ac\.pa$/', $correo)) {
    $errores[] = 'Usa tu correo institucional, que termina en @utp.ac.pa.';
}
if (!preg_match('/^6[0-9]{3}-?[0-9]{4}$/', $telefono)) {
    $errores[] = 'El teléfono debe ser un celular de 8 dígitos que empieza en 6, con o sin guion.';
}
if (!in_array($carrera, $carreras_validas, true)) {
    $errores[] = 'Selecciona una carrera de la lista.';
}
if (filter_var($semestre, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 20]]) === false) {
    $errores[] = 'El semestre debe ser un número entre 1 y 20.';
}
if (strlen($contrasena) < 8 || strlen($contrasena) > 64) {
    $errores[] = 'La contraseña debe tener entre 8 y 64 caracteres.';
}
if ($contrasena !== $confirmar_contrasena) {
    $errores[] = 'Las contraseñas no coinciden.';
}
if (!$acepta_reglamento) {
    $errores[] = 'Debes aceptar el reglamento de préstamos.';
}

if (count($errores) === 0) {
    // La contraseña nunca se muestra ni se guarda en texto plano.
    // Sin base de datos todavía: el hash se guardará en el Hito #3.
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
}

$titulo = count($errores) > 0 ? 'Revisa el registro' : 'Cuenta creada';
$descripcion = 'Resultado del registro de estudiante en SIGEL.';
$pagina_actual = 'registro.php';
require_once 'includes/encabezado.php';
?>
    <section class="eq02-formulario">
<?php if (count($errores) > 0): ?>
      <h1>Revisa los datos del registro</h1>
      <?= mostrar_errores($errores) ?>
      <p><a href="registro.php?rol=<?= escapar($rol) ?>" class="eq02-boton">Volver al formulario</a></p>
<?php else: ?>
      <h1>Cuenta creada</h1>
      <p>Bienvenido, <?= escapar($nombre) ?> <?= escapar($apellido) ?>.</p>
      <ul>
        <li>Cédula: <?= escapar($cedula) ?></li>
        <li>Correo: <?= escapar($correo) ?></li>
        <li>Teléfono: <?= escapar($telefono) ?></li>
        <li>Semestre: <?= escapar($semestre) ?></li>
      </ul>
      <p class="eq02-nota">Demostración: los datos todavía no se guardan en base de datos. Eso llega en el Hito #3.</p>
      <p><a href="login.php?rol=<?= escapar($rol) ?>" class="eq02-boton">Iniciar sesión</a></p>
<?php endif; ?>
    </section>
<?php require_once 'includes/pie.php'; ?>
