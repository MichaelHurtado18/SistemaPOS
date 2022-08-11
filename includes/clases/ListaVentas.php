<?php

namespace App;

class ListaVentas extends ActiveRecord
{
    protected static $table_name = 'listaventas';
    protected static $columns = ['id', 'venta', 'producto', 'cantidad', 'precio'];
    public $id;
    public $venta;
    public $producto;
    public $cantidad;
    public $precio;


    public static function datosVentas()
    {
        $query = self::$db->query("SELECT   GROUP_CONCAT(producto.producto) as productos,GROUP_CONCAT(listaventas.cantidad) as cantidad, GROUP_CONCAT(listaventas.precio) as precios,  usuarios.nombre, fecha FROM listaventas INNER JOIN producto ON producto.id=listaventas.producto INNER JOIN ventas ON ventas.id=listaventas.venta INNER JOIN usuarios ON ventas.vendedor=usuarios.id GROUP BY(venta)");
        while ($rowQuery = $query->fetch_assoc()) {
            $valores = [
                "productos" => $rowQuery["productos"],
                "cantidad" => $rowQuery["cantidad"],
                "precios" => $rowQuery["precios"],
                "nombre" => $rowQuery["nombre"],
                "fecha" => $rowQuery["fecha"]
            ];
        }
        self::debug($valores);
        return $valores;
    }


    public static function VentaDia($dia)
    {
        $query = self::$db->query("SELECT SUM(precio)  as Totalventas FROM listaventas INNER JOIN ventas ON ventas.id=listaventas.venta WHERE DATE(fecha) = '$dia'")->fetch_assoc();
        return $query;
    }
 
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->venta = $args['venta'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}
