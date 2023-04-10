<?php

namespace Model;

require_once 'ActiveRecord.php';

class Hora extends ActiveRecord
{
    protected static $tabla = 'horas';
    protected static $columnasDB = ['id', 'hora'];

    public $id;
    public $hora;
}
