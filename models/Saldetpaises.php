<?php

namespace Model;

class Saldetpaises extends ActiveRecord {
    protected static $tabla = 'se_dsalpais';
    protected static $columnasDB = ['dsal_sol_salida', 'dsal_ciudad', 'dsal_pais', 'dsal_transporte', 'dsal_situacion'];
    protected static $idTabla = 'dsal_id';
    
    public $dsal_id;
    public $dsal_sol_salida;
    public $dsal_ciudad;
    public $dsal_pais;
    public $dsal_transporte;
    public $dsal_situacion;

    public function __construct($args = []) {
        $this->dsal_id = $args['dsal_id'] ?? null;
        $this->dsal_sol_salida = $args['dsal_sol_salida'] ?? '';
        $this->dsal_ciudad = $args['dsal_ciudad'] ?? '';
        $this->dsal_pais = $args['dsal_pais'] ?? '';
        $this->dsal_transporte = $args['dsal_transporte'] ?? '';
        $this->dsal_situacion = $args['dsal_situacion'] ?? 1;
    }
}