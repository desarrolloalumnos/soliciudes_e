<?php
namespace Model;

class ParejaMilitar extends ActiveRecord {
    protected static $tabla = 'se_pareja_militar';
    protected static $columnasDB = ['parejam_cat', 'parejam_comando', 'parejam_gra', 'parejam_arm', 'parejam_emp', 'parejam_situacion'];
    protected static $idTabla = 'parejam_id';

    public $parejam_id;
    public $parejam_cat;
    public $parejam_comando;
    public $parejam_gra;
    public $parejam_arm;
    public $parejam_emp;
    public $parejam_situacion;

    public function __construct($args = []) {
        $this->parejam_id = $args['parejam_id'] ?? null;
        $this->parejam_cat = $args['parejam_cat'] ?? null;
        $this->parejam_comando = $args['parejam_comando'] ?? null;
        $this->parejam_gra = $args['parejam_gra'] ?? null;
        $this->parejam_arm = $args['parejam_arm'] ?? null;
        $this->parejam_emp = $args['parejam_emp'] ?? '';
        $this->parejam_situacion = $args['parejam_situacion'] ?? 1;
    }
}
