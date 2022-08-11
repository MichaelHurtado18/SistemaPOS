<?php



namespace App;

class ActiveRecord
{

    protected static $table_name = '';
    public static  $primary_key = 'id';
    public static $errores = [];
    public  static $db;
    public static $database = 'pos';
    protected static $columns = [];


    /* CONEXION A LA BD */
    public static function setConectar($conexion)
    {
        return self::$db = $conexion;
    }
    public static function debug($variable)
    {
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
    }

    /*SI LA CLASE TIENE UN VALOR EN $this->id SIGNIFICA QUE SE UTILIZO EL METODO find Y SE QUIERE ACTUALIZAR entonces llama al metodo update, SI NO ES ASI LLAMA AL METODO create */
    public function save()
    {
        if (!$this->id) {
            $resultado = $this->create();
            return $resultado;
        } else {
            $resultado = $this->update();
            return $resultado;
        }
    }
    /*INSERTA UN NUEVO REGISTRO EN LA BD */
    public function create()
    {
        $atributos = $this->sanitizarAtributos();
        $keys = implode(',', array_keys($atributos));
        $values = implode("','", array_values($atributos));

        $query = self::$db->query(" INSERT INTO " .  static::$table_name . " ($keys) VALUES('$values')");
        if ($query) {
            header("Location:index.php");
        }
        return $query;
    }
    /*ACTUALIZA UN REGISTRO DE LA BD */
    public function update()
    {
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = " $key = '$value' ";
        }
        $string = implode(' , ', $valores);
        $query =  self::$db->query(" UPDATE " . static::$table_name . " SET $string  WHERE id = $this->id");
        if ($query) {
            header("Location:index.php");
        }
        return $query;
    }
    /*ELIMINA UN REGISTRO, PARA UTILIZARLO PRIMERO SE LLAMA EL METODO find  */
    public  function delete()
    {
        $query = self::$db->query(" DELETE FROM " . static::$table_name . " WHERE id = $this->id ");
        if ($query) {
            header("Location:index.php");
        }
        return $query;
    }

    /*DEVUELVE TODOS LOS REGISTROS DE UNA TABLA */
    public static function all()
    {
        $query = "SELECT * FROM " . static::$table_name;
        $resultado = static::consultDB($query);
        return $resultado;
    }
    /*BUSCA UN REGISTRO DEPENDIENDO DEL ID, SE UTILIZA ANTES DE ELIMINAR O ACTUALIZAR PORQUE LLENA LOS ATRIBUTOS DE LA CLASE CON LOS VALORES DEL REGISTRO. ENTONCES CUANDO SE DESEE ELIMINAR O ACTUALIZAR SOLO se pone el metodo save, o delete despues del find Y COMO YA LA CLASE TIENE UN REGISTRO EN MEMORIA, LA CONSULTA PUEDE DEBE TENER COMO CRITERIO A $this->id QUE TENDRA EL ID DEL REGISTRO DEVUELTO POR find Y SE ELIMINARA DEPENDIENDO DEL ID */
    public static  function find($id)
    {
        $query = "SELECT * FROM " . static::$table_name . " WHERE id = ${id} ";
        $resultado = static::consultDB($query);
        return array_shift($resultado);
    }

    /*RECORRE LOS ATRIBUTOS NO ESTATICOS DE LA CLASE Y CREA UN ARRAY CON EL NOMBRE Y EL VALOR DE CADA ATRIBUTO */
    public function atributos()
    {
        $v = [];
        foreach ($this as $key => $value) {
            if ($key == 'id' || $key == 'fecha') continue;
            $v[$key] = $this->$key;
        }

        return $v;
    }
    /*RECIBE DE ATRIBUTOS UN ARRAY CON TODOS LOS ATRIBUTOS Y SUS VALORES Y LOS SANITIZA PARA POSTERIORMENTE SER GUARDADO EN LA BD  */
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizando = [];

        foreach ($atributos as $key => $value) {
            $sanitizando[$key] = self::$db->escape_string($value);
        }

        return $sanitizando;
    }

    /* EJECUTA UNA CONSULTA LLAMA AL METODO createObject Y DEVUELVE UN ARRAY CON LOS OBJETOS */
    public static function consultDB($query)
    {
        $resultado = static::$db->query($query);
        $valores = [];
        while ($registro = $resultado->fetch_assoc()) {
            $valores[] = static::createObject($registro);
        }
        return $valores;
    }
    /*CREA UN OBJETO CON EL REGISTRO QUE SE LE PASE Y LO PONE EN MEMORIA */
    public static function createObject($registro)
    {
        $objeto = new static;
        foreach ($registro  as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    /*HACE LO MISMO QUE createObject */
    public  function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        return $this;
    }


    public function validar()
    {
        return static::$errores;
    }
}
