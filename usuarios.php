<?php

require 'includes/app.php';

use App\Usuarios;

$datos = [
    "nombre" => 'admin',
    "correo" => 'admin@gmail.com',
    "contra" => "admin2022",
    "rol" => 1,
];

Usuarios::debug($datos);

$usuario = new Usuarios($datos);
$usuario->save();
