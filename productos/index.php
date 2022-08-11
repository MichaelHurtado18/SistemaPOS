<?php

use App\Producto;

require '../includes/app.php';


/*ESTE CODIGO SE EJECUTA CUANDO SE ENVIA EL FORMULARIO DE AGREGAR UN NUEVO PRODUCTO */
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $producto = new Producto($_POST);
    $errores =  $producto->validacion();

    if (empty($errores)) {
        Producto::debug($producto);
          $producto->save();
    }
}
$nombreSeccion  = 'Productos';
require '../includes/templates/sidebar.php';

$productos = Producto::all();
?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">Nuevo Producto</a>
    <table class="table table-bordered table-sm" id="tablaProductos">
        <thead>
            <tr>
                <th>Referencia</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $key) : ?>
                <tr>
                    <td><?php echo $key->referencia ?></td>
                    <td><?php echo $key->producto ?></td>
                    <td><?php echo $key->precio ?></td>
                    <td><?php echo $key->cantidad ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $key->id ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i> </a>
                        <a href="eliminar.php?id=<?php echo $key->id ?>" class="btn btn-danger"><i class="bi bi-trash3"></i> </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<!-- Modal  Nuevo Producto-->
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCrear" class="form" method="POST" action="index.php">
                    <?php $producto = new Producto;
                    require '../includes/templates/formulario_Productos.php' ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnCrearProducto">Crear Producto</button>
            </div>
        </div>
    </div>
</div>
<!--INCLUIMOS EL PLUGIN JQUERY-->
<script src="../../complementos/jquery.min.js"> </script>
<!--INCLUIMOS EL BOOSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!--INCLUIMOS EL DATATABLES-->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
<script src=".\../js/dashboard.js"></script>
<script src="../js/producto.js"> </script>


</body>

</html>