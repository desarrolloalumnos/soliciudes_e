<?php

namespace Model;

class Articulo extends ActiveRecord {
    protected static $tabla = 'se_articulos';
    protected static $columnasDB = ['art_descripcion', 'art_situacion'];
    protected static $idTabla = 'art_id';
    
    public $art_id;
    public $art_descripcion;
    public $art_situacion;

    public function __construct($args = []) {
        $this->art_id = $args['art_id'] ?? null;
        $this->art_descripcion = $args['art_descripcion'] ?? '';
        $this->art_situacion = $args['art_situacion'] ?? 1;
    }
}
