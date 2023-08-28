<?php

namespace Model;

class Usuario extends ActiveRecord{
    public static $tabla = 'usuario';
    public static $columnasDB = ['usu_catalogo','usu_password','usu_situacion', 'usu_fecha_registro'];
    public static $idTabla = 'usu_id';

    public $usu_id;
    public $usu_catalogo;
    public $usu_password;
    public $usu_situacion;
    public $usu_fecha_registro;

    public function __construct($args =[])
    {
        $this->usu_id = $args['usu_id'] ?? null;
        $this->usu_catalogo = $args['usu_catalogo'] ?? '';
        $this->usu_password = $args['usu_password'] ?? '';
        $this->usu_situacion = $args['usu_situacion'] ?? '1';
        $this->usu_fecha_registro = $args['usu_fecha_registro'] ??  date('Y-m-d H:i');
    }
}