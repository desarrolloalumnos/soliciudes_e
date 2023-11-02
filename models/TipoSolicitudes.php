<?php

namespace Model;

class Tiposolicitudes extends ActiveRecord {
    protected static $tabla = 'se_tipo_solicitud';
    protected static $columnasDB = ['tse_descripcion', 'tse_situacion'];
    protected static $idTabla = 'tse_id';
    
    public $tse_id;
    public $tse_descripcion;
    public $tse_situacion;

    public function __construct($args = []) {
        $this->tse_id = $args['tse_id'] ?? null;
        $this->tse_descripcion = $args['tse_descripcion'] ?? '';
        $this->tse_situacion = $args['tse_situacion'] ?? 1;
    }
}

