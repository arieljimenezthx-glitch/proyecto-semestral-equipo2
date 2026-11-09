<?php
defined('APP_ACCESO') or exit('Acceso denegado');

// Quita espacios y etiquetas HTML de la entrada del usuario.
function limpiar($dato) {
    return strip_tags(trim($dato));
}

// Escapa todo lo que se muestra en pantalla.
function escapar($dato) {
    return htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
}

// Envía al navegador a otra página y detiene el script.
function redirigir($pagina) {
    header('Location: ' . $pagina);
    exit;
}

// Devuelve el rol simulado solo si está en la lista blanca; si no, estudiante.
function obtener_rol() {
    $roles_validos = ['estudiante', 'docente', 'laboratorista', 'administrador'];
    $rol = isset($_GET['rol']) ? limpiar($_GET['rol']) : 'estudiante';
    return in_array($rol, $roles_validos, true) ? $rol : 'estudiante';
}

// Convierte una fecha AAAA-MM-DD a DD/MM/AAAA.
function formatear_fecha($fecha) {
    return date('d/m/Y', strtotime($fecha));
}

// Devuelve el HTML de la lista de errores de validación, con cada mensaje escapado.
function mostrar_errores($errores) {
    if (empty($errores)) {
        return '';
    }
    $html = '<div class="eq02-errores" role="alert"><ul>';
    foreach ($errores as $error) {
        $html .= '<li>' . escapar($error) . '</li>';
    }
    $html .= '</ul></div>';
    return $html;
}

function fecha_iso($texto) {
    if (!preg_match('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $texto, $m)) {
        return '';
    }
    if (!checkdate((int) $m[2], (int) $m[1], (int) $m[3])) {
        return '';
    }
    return $m[3] . '-' . $m[2] . '-' . $m[1];
}
