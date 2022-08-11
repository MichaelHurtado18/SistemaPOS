<?php


namespace App;


class Rol extends ActiveRecord
{
    protected static $table_name = 'roles';
    protected static $columns = ['id', 'rol'];
    public $id;
    public $rol;
}
