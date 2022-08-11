<?php
/*ESTA PAGINA RETROALIMENTA LOS GRAFICOS DE comparativas.php */

use App\Ventas;

require 'includes/app.php';


$fecha_1 = $_GET["fecha_1"];
$fecha_2 = $_GET["fecha_2"];
$query = $mysql->query("SELECT COUNT(id) as VentasTotales, DATE(fecha)  as fecha FROM  ventas  WHERE DATE(fecha) BETWEEN '$fecha_1' AND '$fecha_2' GROUP BY (DATE(fecha));");

$valores = [];
while ($rowQuery = $query->fetch_assoc()) {
    $valores[] = [
        "fecha" => $rowQuery["fecha"],
        "VentasTotales" => $rowQuery["VentasTotales"]
    ];
}

/*SE UTILIZA EL json_encode PARA JAVASCRIPT LO PUEDA LEER CORRECTAMENTE */
echo json_encode($valores, JSON_FORCE_OBJECT);
