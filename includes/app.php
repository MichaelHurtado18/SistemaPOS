<?php
require 'funciones.php';
$autenticar = auth();

require 'config/database.php';
require 'clases/ActiveRecord.php';
require 'clases/Producto.php';
require 'clases/Usuarios.php';
require 'clases/Login.php';
require 'clases/Roles.php';
require 'clases/Ventas.php';
require 'clases/ListaVentas.php';


$mysql = database();

use App\ActiveRecord;

ActiveRecord::setConectar($mysql);
