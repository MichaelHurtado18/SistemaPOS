<?php
/*ESTA PAGINA SE ENCARGA DE RETROALIMENTAR index.php DE VENTAS, ESPECIFICAMENTE LA INFORMACION QUE SALE CUANDO LE DAS CLICK AL BOTON "DETALLES" VIENE DE AQUI */
require '../includes/app.php';


$id = $_GET["id"] ?? '';
$query = $mysql->query("SELECT  venta, (producto.producto) as productos, (listaventas.cantidad) as cantidad, (listaventas.precio) as precios,  usuarios.nombre, fecha FROM listaventas INNER JOIN producto ON producto.id=listaventas.producto INNER JOIN ventas ON ventas.id=listaventas.venta INNER JOIN usuarios ON ventas.vendedor=usuarios.id WHERE venta = '$id'");

$valores = [];
while ($rowQuery = $query->fetch_assoc()) {

    $valores[] = $rowQuery;
}
/*SE UTILIZA EL json_encode PARA JAVASCRIPT LO PUEDA LEER CORRECTAMENTE */
echo json_encode(($valores));
