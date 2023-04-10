<?php

namespace Model;

require_once 'ActiveRecord.php';

class Categoria extends ActiveRecord
{
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
}
