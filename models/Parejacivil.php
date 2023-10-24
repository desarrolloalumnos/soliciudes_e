<?php

namespace Model;

class ParejaCivil extends ActiveRecord {
    protected static $tabla = 'se_pareja_civil';
    protected static $columnasDB = ['pareja_nombres', 'pareja_apellidos', 'pareja_direccion', 'pareja_dpi', 'pareja_situacion'];
    protected static $idTabla = 'pareja_id';

    public $pareja_id;
    public $pareja_nombres;
    public $pareja_apellidos;
    public $pareja_direccion;
    public $pareja_dpi;
    public $pareja_situacion;

    public function __construct($args = []) {
        $this->pareja_id = $args['pareja_id'] ?? null;
        $this->pareja_nombres = $args['pareja_nombres'] ?? '';
        $this->pareja_apellidos = $args['pareja_apellidos'] ?? '';
        $this->pareja_direccion = $args['pareja_direccion'] ?? '';
        $this->pareja_dpi = $args['pareja_dpi'] ?? '';
        $this->pareja_situacion = $args['pareja_situacion'] ?? 1;
    }
}


