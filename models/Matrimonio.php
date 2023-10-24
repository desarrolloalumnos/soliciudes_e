<?php

namespace Model;

class Matrimonio extends ActiveRecord {
    protected static $tabla = 'se_matrimonio';
    protected static $columnasDB = ['mat_autorizacion', 'mat_lugar_civil', 'mat_fecha_bodac',
                                    'mat_lugar_religioso', 'mat_fecha_bodar', 'mat_per_civil', 'mat_per_army',
                                    'mat_fecha_lic_ini', 'mat_fecha_lic_fin', 'mat_situacion'];
    protected static $idTabla = 'mat_id';
    
    public $mat_id;
    public $mat_autorizacion;
    public $mat_lugar_civil;
    public $mat_fecha_bodac;
    public $mat_lugar_religioso;
    public $mat_fecha_bodar;
    public $mat_per_civil;
    public $mat_per_army;
    public $mat_fecha_lic_ini;
    public $mat_fecha_lic_fin;
    public $mat_situacion;

    public function __construct($args = []) {
        $this->mat_id = $args['mat_id'] ?? null;
        $this->mat_autorizacion = $args['mat_autorizacion'] ?? '';
        $this->mat_lugar_civil = $args['mat_lugar_civil'] ?? '';
        $this->mat_fecha_bodac = $args['mat_fecha_bodac'] ?? '';
        $this->mat_lugar_religioso = $args['mat_lugar_religioso'] ?? '';
        $this->mat_fecha_bodar = $args['mat_fecha_bodar'] ?? '';
        $this->mat_per_civil = $args['mat_per_civil'] ?? '';
        $this->mat_per_army = $args['mat_per_army'] ?? '';
        $this->mat_fecha_lic_ini = $args['mat_fecha_lic_ini'] ?? '';
        $this->mat_fecha_lic_fin = $args['mat_fecha_lic_fin'] ?? '';
        $this->mat_situacion = $args['mat_situacion'] ?? 1;
    }
}