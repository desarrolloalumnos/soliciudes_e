<?php

namespace Model;

class Licenciatemporal extends ActiveRecord {
    protected static $tabla = 'se_licencia_temporal';
    protected static $columnasDB = ['lit_autorizacion', 'lit_mes_consueldo', 'lit_mes_sinsueldo', 'lit_fecha1', 'lit_fecha2', 'lit_articulo', 'lit_situacion'];
    protected static $idTabla = 'lit_id';
    
    public $lit_id;
    public $lit_autorizacion;
    public $lit_mes_consueldo;
    public $lit_mes_sinsueldo;
    public $lit_fecha1;
    public $lit_fecha2;
    public $lit_articulo;
    public $lit_situacion;

    public function __construct($args = []) {
        $this->lit_id = $args['lit_id'] ?? null;
        $this->lit_autorizacion = $args['lit_autorizacion'] ?? '';
        $this->lit_mes_consueldo = $args['lit_mes_consueldo'] ?? '';
        $this->lit_mes_sinsueldo = $args['lit_mes_sinsueldo'] ?? '';
        $this->lit_fecha1 = $args['lit_fecha1'] ?? '';
        $this->lit_fecha2 = $args['lit_fecha2'] ?? '';
        $this->lit_articulo = $args['lit_articulo'] ?? '';
        $this->lit_situacion = $args['lit_situacion'] ?? 1;
    }
}
