<?php
$bool = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=".\../../complementos/bootstrap/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href=".\../estilos.css">
    <title> POS</title>
</head>
<header class="header">
    <div class="barra">
        Sistema POS
    </div>
    <?php if (strpos($_SERVER['REQUEST_URI'], 'POS/usuarios/') || strpos($_SERVER['REQUEST_URI'], 'POS/productos/') || strpos($_SERVER['REQUEST_URI'], 'POS/caja/') || strpos($_SERVER['REQUEST_URI'], 'POS/ventas/')) : ?>
        <a href="../cerrar_sesion.php">Cerrar Sesion</a>
    <?php
        $bool = false;
    endif; ?>
    <?php if ($bool) : ?>
        <a href="cerrar_sesion.php">Cerrar Sesion</a>
    <?php endif; ?>
</header>