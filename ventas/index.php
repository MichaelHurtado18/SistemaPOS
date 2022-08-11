<?php

use App\ListaVentas;
use App\Ventas;

require '../includes/app.php';
$nombreSeccion  = 'Ventas';
require '../includes/templates/sidebar.php';

$query = $mysql->query("SELECT  venta, GROUP_CONCAT(producto.producto) as productos,GROUP_CONCAT(listaventas.cantidad) as cantidad, GROUP_CONCAT(listaventas.precio) as precios,  usuarios.nombre, fecha FROM listaventas INNER JOIN producto ON producto.id=listaventas.producto INNER JOIN ventas ON ventas.id=listaventas.venta INNER JOIN usuarios ON ventas.vendedor=usuarios.id GROUP BY(venta) ORDER BY  fecha DESC");
?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <table class="table  table-sm  table-bordered " id="tablVentas">
        <thead>
            <tr>
                <th>Productos</th>
                <th>Cantidad</th>
                <th>Precios</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rowQuery = $query->fetch_assoc()) : ?>
                <tr>
                    <td> <?php echo $rowQuery["productos"] ?></td>
                    <td> <?php echo $rowQuery["cantidad"] ?></td>
                    <td> <?php echo $rowQuery["precios"] ?></td>
                    <td> <?php echo $rowQuery["nombre"] ?></td>
                    <td> <?php echo $rowQuery["fecha"] ?></td>
                    <td> <a href="" class="btn btn-primary" dataset-id="<?php echo $rowQuery["venta"] ?>" data-bs-toggle="modal" data-bs-target="#modal">Detalles</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Resumen Venta</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="vendedor"></h4>
                    <h4 id="fecha"></h4>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</main>


<template id="templateModal">
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</template>
</main>

<!--INCLUIMOS EL PLUGIN JQUERY-->
<script src="../../complementos/jquery.min.js"> </script>
<!--INCLUIMOS EL BOOSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!--INCLUIMOS EL DATATABLES-->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
<script src="../js/ventas.js"> </script>

</body>

</html>