<?php

namespace Model;

class Paises extends ActiveRecord {
    protected static $tabla = 'paises';
    protected static $columnasDB = ['pai_desc_lg'];
    protected static $idTabla = 'pai_codigo';
    
    public $pai_codigo;
    public $pai_desc_lg;

    public function __construct($args = []) {
        $this->pai_codigo = $args['pai_codigo'] ?? null;
        $this->pai_desc_lg = $args['pai_desc_lg'] ?? '';
    }
}