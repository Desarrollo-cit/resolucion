<?php

namespace Model;

class Asignacion extends ActiveRecord{
    public static $tabla = 'asignacion';
    public static $columnasDB = ['asi_usuario','asi_rol', 'asi_situacion'];
    public static $idTabla = 'asi_id';

    public $asi_id;
    public $asi_usuario;
    public $asi_rol;
    public $asi_situacion;

    public function __construct($args =[])
    {
        $this->asi_id = $args['asi_id'] ?? null;
        $this->asi_usuario = $args['asi_usuario'] ?? '';
        $this->asi_rol = $args['asi_rol'] ?? '';
        $this->asi_situacion = $args['asi_situacion'] ?? '1';
    }
}