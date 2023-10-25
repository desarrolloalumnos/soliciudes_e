<?php

namespace Model;

class Motivos extends ActiveRecord {
    protected static $tabla = 'se_motivos';
    protected static $columnasDB = ['mot_id', 'mot_descripcion', 'mot_situacion'];
    protected static $idTabla = 'mot_id';
    
    public $mot_id;
    public $mot_descripcion;
    public $mot_situacion;

    public function __construct($args = []) {
        $this->mot_id = $args['mot_id'] ?? null;
        $this->mot_descripcion = $args['mot_descripcion'] ?? '';
        $this->mot_situacion = $args['mot_situacion'] ?? 1;
    }
}