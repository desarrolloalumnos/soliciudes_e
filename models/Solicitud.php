<?php

namespace Model;

class Solicitud extends ActiveRecord {
    protected static $tabla = 'se_solicitudes';
    protected static $columnasDB = ['sol_tipo', 'sol_solicitante', 'sol_obs', 'sol_motivo', 'sol_situacion','sol_identificador'];
    protected static $idTabla = 'sol_id';
    
    public $sol_id;
    public $sol_tipo;
    public $sol_solicitante;
    public $sol_obs;
    public $sol_motivo;
    public $sol_situacion;
    public $sol_identificador;

    public function __construct($args = []) {
        $this->sol_id = $args['sol_id'] ?? null;
        $this->sol_tipo = $args['sol_tipo'] ?? '';
        $this->sol_solicitante = $args['sol_solicitante'] ?? '';
        $this->sol_obs = $args['sol_obs'] ?? '';
        $this->sol_motivo = $args['sol_motivo'] ?? '';
        $this->sol_identificador = $args['sol_identificador'] ?? '';
        $this->sol_situacion = $args['sol_situacion'] ?? 1;
    }
}