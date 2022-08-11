<?php
/*ESTE  CODIGO CAMBIA EL STOCK DE PRODUCTOS EN LA BD, CADA VEZ QUE SE DA CLICK EN FINALIZAR COMPRAR SE EJECUTA ESTE CODIGO*/

require '../includes/app.php';

use App\ListaVentas;
use App\Producto;
use App\Ventas;

$carrito = $_POST;

$stock = Producto::changeStcok($carrito);

$vendedor = ["vendedor" => $_SESSION["id"]];
$ventas = new Ventas($vendedor);
$ventas->save();


$query =  $mysql->query("SELECT MAX(id) as id FROM ventas");
$rowQuery = $query->fetch_assoc();
$idVentas = $rowQuery["id"];

foreach ($carrito as $producto) {
    $id = $producto['id'];
    $cantidad = $producto['cantidad'];
    $precio =  $producto['cantidad'] * $producto['precio'];

    $lista = [
        "venta" => $idVentas,
        "producto" => $id,
        "cantidad" => $cantidad,
        "precio" => $precio
    ];

    $listaVentas = new ListaVentas($lista);
    ListaVentas::debug($listaVentas);
    $listaVentas->save();
}
