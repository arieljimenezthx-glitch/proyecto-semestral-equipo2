<?php
defined('APP_ACCESO') or exit('Acceso denegado');

// Equipos del inventario. "en_reparacion" => true bloquea la solicitud.
$equipos = [
    'RED-40117' => ['nombre' => 'Router 2901', 'tipo' => 'equipo', 'en_reparacion' => false],
    'RED-40118' => ['nombre' => 'Kit de cableado', 'tipo' => 'kit', 'en_reparacion' => false],
    'RED-40125' => ['nombre' => 'Switch 24 puertos', 'tipo' => 'equipo', 'en_reparacion' => false],
    'RED-40130' => ['nombre' => 'Router 1941', 'tipo' => 'equipo', 'en_reparacion' => true],
];

// Préstamos de demostración (semillas dictadas en clase).
$prestamos = [
    ['codigo' => 'RED-40117', 'solicitante' => 'Nicolás Barría-Quintero', 'rol' => 'Estudiante', 'salida' => '2026-11-03', 'devolucion' => '2026-11-05', 'estado' => 'Activo'],
    ['codigo' => 'RED-40118', 'solicitante' => 'Prof. Iris Valdivieso', 'rol' => 'Docente', 'salida' => '2026-11-02', 'devolucion' => '2026-11-04', 'estado' => 'Devuelto'],
    ['codigo' => 'RED-40125', 'solicitante' => 'Mª José Peña-D’Alessandro', 'rol' => 'Estudiante', 'salida' => '2026-10-30', 'devolucion' => '2026-11-02', 'estado' => 'Vencido'],
];

// Parámetros de la regla de préstamo.
$parametros = [
    'max_equipos' => 3,
    'max_dias' => 3,
];
