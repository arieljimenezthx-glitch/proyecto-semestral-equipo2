<?php
defined('APP_ACCESO') or exit('Acceso denegado');
require_once 'includes/funciones.php';

$rol = obtener_rol();
$titulo = isset($titulo) ? $titulo : 'Inicio';
$descripcion = isset($descripcion) ? $descripcion : 'SIGEL: sistema de préstamos de equipos del laboratorio.';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= escapar($descripcion) ?>">
  <title><?= escapar($titulo) ?> · SIGEL</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header id="eq02-encabezado">
    <a href="index.php?rol=<?= escapar($rol) ?>" class="eq02-marca"><img src="img/logo.svg" alt="Logotipo de SIGEL: matraz de laboratorio" width="40" height="40"> SIGEL</a>
    <?php require 'includes/menu.php'; ?>
  </header>

  <main class="eq02-principal">
