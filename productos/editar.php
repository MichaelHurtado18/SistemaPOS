<?php
require '../includes/app.php';

use App\Producto;

$id = $_GET['id'] ?? '';
$producto = Producto::find($id);
$errores =  Producto::$errores;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $producto->sincronizar($_POST);
    $errores =  $producto->validacion();

    if (empty($errores)) {
        $producto->save();
    }
}
$nombreSeccion  = 'Editar Producto';
require '../includes/templates/sidebar.php';

?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <h1>Editar Productos</h1>

    <?php
    foreach ($errores as $alerta) {
        echo $alerta;
        echo "<br>";
    }
    ?>
    <form class="form" method="POST" action="editar.php?id=<?php echo $id ?>">
        <?php require '../includes/templates/formulario_Productos.php' ?>
        <input type="submit" class="btn btn-primary" value="Editar Producto">
    </form>
</main>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

<script src="dashboard.js"></script>
</body>

</html>