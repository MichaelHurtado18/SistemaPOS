<?php

/*VALIDA QUE EL USUARIO TENGA PERMISOS Y LO REDIRIGE AL index SI NO LOS TIENES    */
function auth()
{
    session_start();

    if (!strpos($_SERVER['REQUEST_URI'], 'POS/index.php')) {
        if (!$_SESSION['login']) {
            if (strpos($_SERVER['REQUEST_URI'], 'POS/usuarios/') || strpos($_SERVER['REQUEST_URI'], 'POS/productos/') || strpos($_SERVER['REQUEST_URI'], 'POS/caja/') || strpos($_SERVER['REQUEST_URI'], 'POS/ventas/')) {
                header("Location:../index.php");
            } else {
                header("Location:index.php");
            }
            return;
        }
        if (!strpos($_SERVER['REQUEST_URI'], 'POS/caja/') && $_SESSION["rol"] == '2') {
            header("Location:caja/");
            return;
        }
    }
}


function s($atributo)

{
    $valor = htmlspecialchars($atributo);
    return $valor;
}
