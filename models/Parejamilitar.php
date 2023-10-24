<?php
namespace Model;

class ParejaMilitar extends ActiveRecord {
    protected static $tabla = 'se_pareja_militar';
    protected static $columnasDB = ['pareja_cat', 'pareja_comando', 'pareja_gra', 'pareja_arm', 'pareja_emp', 'pareja_situacion'];
    protected static $idTabla = 'pareja_id';

    public $pareja_id;
    public $pareja_cat;
    public $pareja_comando;
    public $pareja_gra;
    public $pareja_arm;
    public $pareja_emp;
    public $pareja_situacion;

    public function __construct($args = []) {
        $this->pareja_id = $args['pareja_id'] ?? null;
        $this->pareja_cat = $args['pareja_cat'] ?? null;
        $this->pareja_comando = $args['pareja_comando'] ?? null;
        $this->pareja_gra = $args['pareja_gra'] ?? null;
        $this->pareja_arm = $args['pareja_arm'] ?? null;
        $this->pareja_emp = $args['pareja_emp'] ?? '';
        $this->pareja_situacion = $args['pareja_situacion'] ?? 1;
    }
}
