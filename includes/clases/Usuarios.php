<?php

namespace App;

class Usuarios extends ActiveRecord
{
    protected static $table_name = 'Usuarios';
    protected static $columns = ['id', 'nombre', 'correo', 'contra', 'rol'];
    public $id;
    public $nombre;
    public $correo;
    public $contra;
    public $rol;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->contra = $args['contra'] ?? '';
        $this->rol = $args['rol'] ?? '';
    }
    /*DEVUELVE TODOS LOS REGISTROS DE UNA TABLA */
    public static function all()
    {
        $query = "SELECT usuarios.id as id,usuarios.nombre as nombre,usuarios.correo as correo, usuarios.contra as contra,roles.rol as rol FROM usuarios INNER JOIN roles ON usuarios.rol = roles.id;";
        $resultado = static::consultDB($query);

        return $resultado;
    }
    public function create()
    {
        $atributos = $this->sanitizarAtributos();
        $atributos['contra'] = password_hash($atributos['contra'], PASSWORD_DEFAULT);
        $keys = implode(',', array_keys($atributos));
        $values = implode("','", array_values($atributos));
        $query = self::$db->query(" INSERT INTO " .  static::$table_name . " ($keys) VALUES('$values')");
        if ($query) {
            header("Location:index.php");
        }
        return $query;
    }

    /*esta funcion devuelve los usuarios que mas vendieros */
    public static function Masvendidos($dia)
    {
        $query = self::$db->query("SELECT usuarios.nombre, SUM(listaventas.precio) as precio, ventas.vendedor,DATE(ventas.fecha) FROM `listaventas` INNER JOIN ventas ON ventas.id=listaventas.venta INNER JOIN usuarios ON usuarios.id=ventas.vendedor WHERE DATE(ventas.fecha) = '$dia' GROUP BY(ventas.vendedor);");
        $valores = [];
        while ($rowQuery = $query->fetch_assoc()) {
            $valores[] = $rowQuery;
        }
        return $valores;
    }


    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "El nombre no puede estar vacio";
        }
        if (!$this->correo) {
            self::$errores[] = "El correo no puede estar vacio";
        }
        if (!$this->contra) {
            self::$errores[] = "La contraseña no puede estar vacia";
        }
        return self::$errores;
    }
}
