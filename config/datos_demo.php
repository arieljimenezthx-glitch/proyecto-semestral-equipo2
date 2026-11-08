<?php
defined('APP_ACCESO') or exit('Acceso denegado');

// Equipos del inventario. "en_reparacion" => true bloquea la solicitud.
$equipos = [
    'ELE-00045' => ['nombre' => 'Osciloscopio Rigol DS1054Z', 'categoria' => 'Electrónica', 'en_reparacion' => false],
    'MED-00012' => ['nombre' => 'Multímetro Fluke 117', 'categoria' => 'Medición', 'en_reparacion' => false],
    'MED-00020' => ['nombre' => 'Multímetro UNI-T UT33D', 'categoria' => 'Medición', 'en_reparacion' => false],
    'KIT-00007' => ['nombre' => 'Kit Arduino Uno', 'categoria' => 'Kit', 'en_reparacion' => false],
    'RED-00123' => ['nombre' => 'Router Cisco 1941', 'categoria' => 'Redes', 'en_reparacion' => false],
    'RED-40117' => ['nombre' => 'Router 2901', 'categoria' => 'Redes', 'en_reparacion' => false],
    'RED-40118' => ['nombre' => 'Kit de cableado', 'categoria' => 'Kit', 'en_reparacion' => false],
    'RED-40125' => ['nombre' => 'Switch 24 puertos', 'categoria' => 'Redes', 'en_reparacion' => false],
    'RED-40130' => ['nombre' => 'Router 1941', 'categoria' => 'Redes', 'en_reparacion' => true],
];

// Préstamos de demostración: los de la maqueta y las tres semillas de clase.
$prestamos = [
    ['codigo' => 'ELE-00045', 'solicitante' => 'Luis Gómez', 'rol' => 'Estudiante', 'salida' => '2026-10-13', 'devolucion' => '2026-10-16', 'estado' => 'Vencido'],
    ['codigo' => 'MED-00012', 'solicitante' => 'Ana Torres', 'rol' => 'Estudiante', 'salida' => '2026-10-18', 'devolucion' => '2026-10-21', 'estado' => 'Activo'],
    ['codigo' => 'KIT-00007', 'solicitante' => 'Ariel Jimenez', 'rol' => 'Estudiante', 'salida' => '2026-10-19', 'devolucion' => '2026-10-22', 'estado' => 'Activo'],
    ['codigo' => 'MED-00020', 'solicitante' => 'Ariel Jimenez', 'rol' => 'Estudiante', 'salida' => '2026-10-18', 'devolucion' => '2026-10-21', 'estado' => 'Activo'],
    ['codigo' => 'RED-00123', 'solicitante' => 'María Ríos', 'rol' => 'Estudiante', 'salida' => '2026-10-09', 'devolucion' => '2026-10-12', 'estado' => 'Devuelto'],
    ['codigo' => 'RED-40117', 'solicitante' => 'Nicolás Barría-Quintero', 'rol' => 'Estudiante', 'salida' => '2026-11-03', 'devolucion' => '2026-11-05', 'estado' => 'Activo'],
    ['codigo' => 'RED-40118', 'solicitante' => 'Prof. Iris Valdivieso', 'rol' => 'Docente', 'salida' => '2026-11-02', 'devolucion' => '2026-11-04', 'estado' => 'Devuelto'],
     ['codigo' => 'RED-40125', 'solicitante' => 'Mª José Peña-D’Alessandro', 'correo' => 'mjose.pena@utp.ac.pa', 'rol' => 'Estudiante', 'salida' => '2026-10-30', 'devolucion' => '2026-11-02', 'estado' => 'Vencido'],

// Parámetros de la regla de préstamo.
$parametros = [
    'max_equipos' => 3,
    'max_dias' => 3,
];
