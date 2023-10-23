<?php

namespace Model;

class Salidapais extends ActiveRecord {
    protected static $tabla = 'se_salpais';
    protected static $columnasDB = ['sal_id', 'sal_autorizacion', 'sal_salida', 'sal_ingreso', 'sal_situacion'];
    protected static $idTabla = 'sal_id';
    
    public $sal_id;
    public $sal_autorizacion;
    public $sal_salida;
    public $sal_ingreso;
    public $sal_situacion;

    public function __construct($args = []) {
        $this->sal_id = $args['sal_id'] ?? null;
        $this->sal_autorizacion = $args['sal_autorizacion'] ?? '';
        $this->sal_salida = $args['sal_salida'] ?? '';
        $this->sal_ingreso = $args['sal_ingreso'] ?? '';
        $this->sal_situacion = $args['sal_situacion'] ?? 1;
    }
}