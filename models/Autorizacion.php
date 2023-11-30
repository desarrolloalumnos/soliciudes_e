<?php

namespace Model;

class Autorizacion extends ActiveRecord {
    protected static $tabla = 'se_autorizacion';
    protected static $columnasDB = ['aut_solicitud', 'aut_comando', 'aut_cat', 'aut_gra', 'aut_arm', 'aut_emp', 'aut_fecha', 'aut_obs', 'aut_situacion'];
    protected static $idTabla = 'aut_id';
    
    public $aut_id;
    public $aut_solicitud;
    public $aut_comando;
    public $aut_cat;
    public $aut_gra;
    public $aut_arm;
    public $aut_emp;
    public $aut_fecha;
     public $aut_obs;
    
    public $aut_situacion;

    public function __construct($args = []) {
        $this->aut_id = $args['aut_id'] ?? null;
        $this->aut_solicitud = $args['aut_solicitud'] ?? '';
        $this->aut_comando = $args['aut_comando'] ?? '';
        $this->aut_cat = $args['aut_cat'] ?? '';
        $this->aut_gra = $args['aut_gra'] ?? '';
        $this->aut_arm = $args['aut_arm'] ?? '';
        $this->aut_emp = $args['aut_emp'] ?? '';
        $this->aut_fecha = $args['aut_fecha'] ?? '';
         $this->aut_obs = $args['aut_obs'] ?? '';
        $this->aut_situacion = $args['aut_situacion'] ?? 1;
    }
}