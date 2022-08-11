<?php


require '../includes/app.php';

use App\Producto;

$id = $_GET['id'] ?? '';

$producto = Producto::find($id);
$producto->delete();
