<?php

namespace Model;

class ParejaCivil extends ActiveRecord {
    protected static $tabla = 'se_pareja_civil';
    protected static $columnasDB = ['parejac_nombres', 'parejac_apellidos', 'parejac_direccion', 'parejac_dpi', 'parejac_situacion'];
    protected static $idTabla = 'parejac_id';

    public $parejac_id;
    public $parejac_nombres;
    public $parejac_apellidos;
    public $parejac_direccion;
    public $parejac_dpi;
    public $parejac_situacion;

    public function __construct($args = []) {
        $this->parejac_id = $args['parejac_id'] ?? null;
        $this->parejac_nombres = $args['parejac_nombres'] ?? '';
        $this->parejac_apellidos = $args['parejac_apellidos'] ?? '';
        $this->parejac_direccion = $args['parejac_direccion'] ?? '';
        $this->parejac_dpi = $args['parejac_dpi'] ?? '';
        $this->parejac_situacion = $args['parejac_situacion'] ?? 1;
    }
}


