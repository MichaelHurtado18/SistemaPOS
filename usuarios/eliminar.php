<?php


require '../includes/app.php';

use App\Usuarios;

$id = $_GET['id'] ?? '';

$usuarios = Usuarios::find($id);
$usuarios->delete();
