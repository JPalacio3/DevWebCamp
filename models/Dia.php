<?php

namespace Model;

require_once 'ActiveRecord.php';

class Dia extends ActiveRecord
{
    protected static $tabla = 'dias';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
}
