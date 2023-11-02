<?php

namespace Model;

class Protocolosol extends ActiveRecord {
    protected static $tabla = 'se_protocolo';
    public static $columnasDB = ['pco_autorizacion', 'pco_cmbv', 'pco_fechainicio', 'pco_fechafin', 'pco_dir', 'pco_just', 'pco_situacion'];
    protected static $idTabla = 'pco_id';
    
    public $pco_id;
    public $pco_autorizacion;
    public $pco_cmbv;
    public $pco_civil;
    public $pco_fechainicio;
    public $pco_fechafin;
    public $pco_dir;
    public $pco_just;
    public $pco_situacion;

    public function __construct($args = []) {
        $this->pco_id = $args['pco_id'] ?? null;
        $this->pco_autorizacion = $args['pco_autorizacion'] ?? '';
        $this->pco_cmbv = $args['pco_cmbv'] ?? '';
        $this->pco_civil = $args['pco_civil'] ?? '';
        $this->pco_fechainicio = $args['pco_fechainicio'] ?? '';
        $this->pco_fechafin = $args['pco_fechafin'] ?? '';
        $this->pco_dir = $args['pco_dir'] ?? '';
        $this->pco_just = $args['pco_just'] ?? '';
        $this->pco_situacion = $args['pco_situacion'] ?? 1;
    }
}