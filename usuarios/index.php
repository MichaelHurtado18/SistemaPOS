<?php
require '../includes/app.php';

use App\Usuarios;
use App\Rol;

$usuarios = Usuarios::all();
$roles = Rol::all();

$errores = Usuarios::$errores;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $usuarios = new Usuarios($_POST);
    $errores = $usuarios->validar();
    if (empty($errores)) {
        $usuarios->save();
    }
}
$nombreSeccion  = 'Usuarios';
require '../includes/templates/sidebar.php';
?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">Nuevo Usuario</a>
    <table class="table table-bordered table-sm" id="tablaUsuarios">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario->nombre ?></td>
                    <td><?php echo $usuario->correo ?></td>
                    <td><?php echo $usuario->rol ?></td>
                    <td>
                        <?php if ($usuario->nombre != 'admin') : ?>
                            <a href="eliminar.php?id=<?php echo $usuario->id ?>" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
                        <?php endif; ?>
                        <?php if ($usuario->nombre == 'admin') : ?>
                            <a href="eliminar.php?id=<?php echo $usuario->id ?>" class="btn btn-danger disabled">Admin</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</main>

<!-- Modal  Nuevo Usuario-->
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alerta">
                    <p></p>
                </div>
                <form id="formCrear" class="form" method="POST" action="index.php">
                    <?php $usuarios = new Usuarios;
                    require '../includes/templates/formulario_usuarios.php' ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnCrearUsuario">Crear Usuario</button>
            </div>
        </div>
    </div>
</div>

<!--INCLUIMOS EL PLUGIN JQUERY-->
<script src="../../complementos/jquery.min.js"> </script>
<!--INCLUIMOS EL BOOSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<!--INCLUIMOS EL DATATABLES-->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!--INCLUIMOS EL JS DEL SIDEBAR Y EL DE NOSOTROS -->
<script src=".\../js/dashboard.js"></script>
<script src="../js/usuarios.js"> </script>

</body>

</html>