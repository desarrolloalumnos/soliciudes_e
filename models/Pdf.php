<?php
namespace Model;

class Pdf extends ActiveRecord {
    protected static $tabla = 'se_pdf';
    protected static $columnasDB = ['pdf_ruta', 'pdf_solicitud', 'pdf_situacion'];
    protected static $idTabla = 'pdf_id';

    public $pdf_id;
    public $pdf_ruta;
    public $pdf_solicitud;
    public $pdf_situacion;

    public function __construct($args = []) {
        $this->pdf_id = $args['pdf_id'] ?? null;
        $this->pdf_ruta = $args['pdf_ruta'] ?? '';
        $this->pdf_solicitud = $args['pdf_solicitud'] ?? null;
        $this->pdf_situacion = $args['pdf_situacion'] ?? 1;
    }
}
