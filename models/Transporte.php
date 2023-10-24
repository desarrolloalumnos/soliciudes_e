<?php

namespace Model;

class Transporte extends ActiveRecord {
    protected static $tabla = 'se_transporte';
    protected static $columnasDB = ['transporte_id', 'transporte_descripcion', 'transporte_situacion'];
    protected static $idTabla = 'transporte_id';
    
    public $transporte_id;
    public $transporte_descripcion;
    public $transporte_situacion;

    public function __construct($args = []) {
        $this->transporte_id = $args['transporte_id'] ?? null;
        $this->transporte_descripcion = $args['transporte_descripcion'] ?? '';
        $this->transporte_situacion = $args['transporte_situacion'] ?? 1;
    }
}