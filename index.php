<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/estilos.css">

    <?php

    require 'includes/app.php';

    if ($_SESSION) {
        header("Location:dashboard.php");
    };

    use App\Login;

    $usuario = new Login;

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $val = Login::findCorreo($_POST["correo"]);
        $usuario->sincronizar($_POST);
        $errores =  $usuario->validar();
        if ($val) {
            $password = $_POST['contra'] ?? '';
            /*VERIFICAMOS QUE LA CONTRASEÑA INGRESADA SEA IGUAL A LA DE LA BD, SI ES CORRECTA $auth SERIA TRUE */
            $auth = password_verify($password, $val['contra']);
            if ($auth) {
                /*INICIAMOS SECCION Y AGREGAMOS LOS SIGUIENTES VALORES A LA VARIABLE GLOBAL */
                session_start();
                $_SESSION["id"] = $val["id"];
                $_SESSION["user"] = $val['nombre'];
                $_SESSION["rol"] = $val["rol"];
                $_SESSION["login"] = true;
                /*SI EL USUARIO ES ADMINISTRADOR ENTONCES LO REDIRIGE AL DASHBOARD, SI NO , A LA CAJA */
                if ($val["rol"] ==  1) {
                    header("Location:dashboard.php");
                } else {
                    header("Location:caja/");
                }
            } else {
                if (empty(Login::$errores["contra"])) {
                    Login::$errores["contra"] = "La contraseña no es correcta";
                }
            }
        } else {
            if (empty(Login::$errores["correo"])) {
                Login::$errores["correo"] = "El correo no es correcto";
            }
        }
    }
    ?>

    <title>SISTEMA | POS</title>
</head>

<body>
    <div class="contenedor">

        <div class="contenedor_formulario">
            <h1>Ingresar Al Sistema</h1>
            <?php
            $errores = Login::$errores;
            foreach ($errores as $error) { ?>
                <div class="alerta">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
            <form method="POST" action="index.php" class="formulario">
                <div class="contenedor_input d-row">
                    <input type="email" class="form-control input_form" name="correo" value="<?php echo s($usuario->correo) ?>">
                    <input type="password" class="form-control input_form" name="contra">
                    <input class="btn btn-primary" type="submit" value="Ingresar">
                </div>

            </form>
        </div>
    </div>

</body>

</html>