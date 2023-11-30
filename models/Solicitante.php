<?php

namespace Model;

class Solicitante extends ActiveRecord{
    public static $tabla = 'se_solicitante';
    public static $columnasDB = ['ste_comando','ste_cat','ste_gra','ste_arm','ste_emp','ste_fecha','ste_telefono','ste_situacion'];
    public static $idTabla = 'ste_id';

    public $ste_id ;
    public $ste_comando;
    public $ste_cat;
    public $ste_gra; 
    public $ste_arm; 
    public $ste_emp;    
    public $ste_fecha;  
    public $ste_telefono;  
    
    public $ste_situacion;

    public function __construct($args =[])
    {
        $this->ste_id  = $args['ste_id'] ?? null;
        $this->ste_comando = $args['ste_comando'] ?? '';
        $this->ste_cat = $args['ste_cat'] ?? '';
        $this->ste_gra = $args['ste_gra'] ?? '';
        $this->ste_arm = $args['ste_arm'] ?? '';
        $this->ste_emp = $args['ste_emp'] ?? '';
        $this->ste_fecha = $args['ste_fecha'] ?? '';
        $this->ste_telefono = $args['ste_telefono'] ?? '';
        $this->ste_situacion = $args['ste_situacion'] ?? '1';
    }
}