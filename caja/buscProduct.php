<?php
require '../includes/app.php';

use App\Producto;

/*BUSCA UN PRODUOTO Y LO DEVUELVE EN CASO DE EXITO*/

$articulo = $_GET["producto"] ?? 'A89';

$producto = Producto::findReference($articulo);
/*SE UTILIZA EL json_encode PARA JAVASCRIPT LO PUEDA LEER CORRECTAMENTE */
echo $producto;
