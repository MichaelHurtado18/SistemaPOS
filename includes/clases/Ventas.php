<?php



namespace App;

class Ventas extends ActiveRecord
{

    protected static $table_name = 'ventas';
    protected static $columns = ['id', 'vendedor', 'fecha'];
    public $id;
    public $vendedor;
    public $fecha;

    public static  function ventasHoy()
    {
        $query = self::$db->query("SELECT SUM(precio)  as totalHoy FROM listaventas INNER JOIN ventas ON listaventas.venta = ventas.id WHERE DATE(ventas.fecha) = DATE(NOW());")->fetch_assoc();
        return $query;
    }


    public static function ventasHoy1()
    {
        $query = self::$db->query("SELECT COUNT(id) FROM ventas")->fetch_assoc();
        return $query;
    }


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->vendedor = $args['vendedor'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
    }
}
