<?php

namespace App;


class Login extends Usuarios
{

    public function __construct($args = [])
    {
        $this->correo = $args['correo'] ?? '';
        $this->contra = $args['contra'] ?? '';
    }
    /*BUSCA UN REGISTRO DEPENDIENDO DEL CORREO, SE DIFERENCIA DE find PORQUE NO PONE EL OBJETO EN MEMORIA SE UTILIZA PARA BUSCAR EL CORREO INGRESADO POR EL USUARIO EN EL LOGIN */
    public static function findCorreo($correo)
    {
        $query = self::$db->query("SELECT * FROM " . static::$table_name . "  WHERE correo = '$correo'")->fetch_assoc();
        return ($query);
    }
    public function validar()
    {

        if (!$this->correo) {
            self::$errores["correo"] = "El correo no puede estar vacio";
        }
        if (!$this->contra) {
            self::$errores["contra"] = "La contraseña no puede estar vacia";
        }
        return self::$errores;
    }
}
