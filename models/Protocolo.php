<?php

namespace Model;

class Protocolo extends ActiveRecord{
    public static $tabla = 'se_combos_marimbas_vallas';
    public static $columnasDB = ['cmv_dependencia','cmv_tip','cmv_situacion'];
    public static $idTabla = 'cmv_id';

    public $cmv_id ;
    public $cmv_dependencia;
    public $cmv_tip;
      
    public $cmv_situacion;

    public function __construct($args =[])
    {
        $this->cmv_id  = $args['cmv_id'] ?? null;
        $this->cmv_dependencia = $args['cmv_dependencia'] ?? '';
        $this->cmv_tip = $args['cmv_tip'] ?? '';
        $this->cmv_situacion = $args['cmv_situacion'] ?? '1';
    }
}