<?php

namespace App;

class Producto extends ActiveRecord
{
    public $id;
    public $referencia;
    public $producto;
    public $precio;
    public $cantidad;
    protected static $table_name = 'producto';
    protected static $columns = ['id', 'referencia', 'producto', 'precio', 'cantidad'];


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->referencia = $args['referencia'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = number_format(intval(str_replace(".", "", $args['precio'] ?? '')), 0, '', '.');
    }

    /*BUSCA UN REGISTRO POR REFERENCIA Y LO PONE EN MEMORIA */
    public static function findReference($producto)
    {
        $query = ("SELECT id,referencia,producto,precio,cantidad FROM producto WHERE referencia = '$producto'");
        $resultado = static::consultDB($query);
        return json_encode(array_shift($resultado));
    }

    /*ESTA FUNCION CAMBIA EL STOCK EN LA BD  */
    public static function changeStcok($carrito)
    {
        foreach ($carrito as $producto) {
            $idCarri = $producto['id'];
            $cantidadCarri = $producto['cantidad'];
            $query1 = self::$db->query("SELECT * FROM producto WHERE id = '$idCarri'");
            while ($rowQuery = $query1->fetch_assoc()) {
                $cantidadNueva = $rowQuery["cantidad"] - $cantidadCarri;
            }
            $query2 = self::$db->query("UPDATE producto  SET cantidad = '$cantidadNueva' WHERE id = '$idCarri' ");
        }
    }
    /*DEVUELVE LOS PRODUCTOS QUE SE HAN VENDIDO EN UNA FECHA ESPECIFICAS */
    public static function Masvendidos($dia)
    {
        $query = self::$db->query("SELECT  producto.producto, SUM(listaventas.cantidad) as totalCantida, DATE(fecha) as fecha  FROM listaventas  INNER JOIN producto ON producto.id=listaventas.producto  INNER JOIN ventas ON ventas.id=listaventas.venta  WHERE DATE(fecha) = '$dia' GROUP BY(producto) ");
        $valores = [];
        while ($rowQuery = $query->fetch_assoc()) {
            $valores[] = $rowQuery;
        }

        return $valores;
    }
    public function validacion()
    {

        if (!$this->referencia) {
            self::$errores[] = "La referencia no puede estar vacia";
        }
        if (!$this->producto) {
            self::$errores[] = "El producto no puede estar vacio";
        }
        if (!$this->precio) {
            self::$errores[] = "El precio no puede estar vacio";
        }
        if (!$this->cantidad) {
            self::$errores[] = "La cantidad debe ser mayor a 1";
        }

        return self::$errores;
    }
}
