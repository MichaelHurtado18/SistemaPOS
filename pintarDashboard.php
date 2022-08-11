<?php
/*ESTE ARCHIVO RETROALIMENTA EL DASHBOARD */
use App\ListaVentas;
use App\Producto;
use App\Usuarios;
use App\Ventas;

require 'includes/app.php';

$fecha = $_GET["fecha"];

$ventas = ListaVentas::VentaDia($fecha);

/*Obtenemos los productos mas vendidos */
$productos = Producto::Masvendidos($fecha);
/*Obtenemos los usuarios que mas vendieron */
$usuarios = Usuarios::Masvendidos($fecha);

/*Traemos el numero total de ventas  */
$queryVentas = $mysql->query("SELECT COUNT(id)  as nVentas FROM ventas WHERE DATE(fecha) = '$fecha'");
$rowQuery = $queryVentas->fetch_assoc();
$nVentas =  $rowQuery["nVentas"];
/*Traemos el numero de productos vendidos */
$queryProductos = $mysql->query("SELECT SUM(cantidad) tVendidos, DATE(ventas.fecha) FROM listaventas INNER JOIN ventas ON ventas.id=listaventas.venta WHERE DATE(ventas.fecha) = '$fecha'");
$rowQuery_1 = $queryProductos->fetch_assoc();
$nProductos = $rowQuery_1["tVendidos"];

 
$objetoGeneral = [
    "ventaDia" => json_encode($ventas),
    "ProductosmasVendidos" => json_encode($productos, JSON_FORCE_OBJECT),
    "usuariosmasVendidos" => json_encode($usuarios, JSON_FORCE_OBJECT),
    "nVentas" => json_encode($nVentas, JSON_NUMERIC_CHECK),
    "nProductos" => json_encode($nProductos, JSON_NUMERIC_CHECK),
    "fecha" => $fecha,
];
/*SE UTILIZA EL json_encode PARA JAVASCRIPT LO PUEDA LEER CORRECTAMENTE */
echo json_encode($objetoGeneral);
