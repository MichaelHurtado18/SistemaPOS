<?php
require '../includes/app.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../estilos/estilos.css">

    <title>Sistema | Caja </title>
</head>
<header class="header_caja">
    <h1>Caja Registradora</h1>
    <a href="../cerrar_sesion.php"><i class="bi bi-box-arrow-right" style="font-size: 2rem; color: white;"></i></a>

</header>

<body>
    <main class="container">
        <?php if ($_SESSION["rol"] == '1') { ?>
            <a href="../dashboard.php" class="btn btn-default">Regresar</a>
        <?php  } ?>
        <!--EN EL DIV CON CLASE ALERTA SE UTILIZA PARA ESCRIBIR QUE UN PRODUCTO YA ALCANZO SU MAXIMO STOCK-->
        <div class="alerta" id="alerta">
            <h5></h5>
        </div>
        <input type="text" class="form-control" id="iProducto" name="buscar" placeholder="Ingrese Producto" onkeypress="hacer(event)">

        <a id="btmCantidad" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal">Editar Cantidades</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody id="items"></tbody>
            <tfoot>
                <tr id="footer">
                    <th scope="row" colspan="5">Carrito Vacio</th>
                </tr>
            </tfoot>
        </table>
        <button class="btn btn-primary" id="comprar">Finalizar Compra</button>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="eProducto" placeholder="Eliminar Producto" onkeypress="eliminar(event)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <template id="template-carrito">
        <!--TEMPLATE PARA -->
        <tr>
            <td>A232</td>
            <td>Computador HP</td>
            <td>235.000</td>
            <td>235.000</td>
        </tr>
    </template>


    <template id="template-footer">
        <!--TEMPLATE PARA -->
        <th Scope="row" colspan="2">Resumen Carrito</th>
        <td>235.000</td>
        <td>235.000</td>
    </template>
    <script src="../../complementos/jquery.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="../js/caja.js"></script>
</body>

</html>