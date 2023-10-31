<?php

namespace Controllers;

use Exception;
use Model\Autorizacion;
use Model\Dependencia;
use Model\Motivos;
use Model\Organizacion;
use Model\Paises;
use Model\Pdf;
use Model\Personal;
use Model\Saldetpaises;
use Model\Salidapais;
use Model\Solicitante;
use Model\Solicitud;
use Model\Tiposolicitud;
use Model\Transportes;
use MVC\Router;

class SalidapaisController {
    public static function index(Router $router){

        $motivos = static::motivos();

        $router->render('salidapaises/index', [
            'motivos' => $motivos
        ]);   
    }

    public static function guardarApi(){

        try {
            $catalogo_doc = $_POST['ste_cat'];


            $fechaAutorizacion = $_POST['aut_fecha'];
            $fechaFormateadaAutorizacion = date('Y-m-d H:i', strtotime($fechaAutorizacion));
            $_POST['aut_fecha'] = $fechaFormateadaAutorizacion;

            $fechaSolicito = $_POST['ste_fecha'];
            $fechaFormateadaSolicito = date('Y-m-d H:i', strtotime($fechaSolicito));
            $_POST['ste_fecha'] = $fechaFormateadaSolicito;

            $fechaSalidaPais = $_POST['sal_salida'];
            $fechaFormateadaIniSal = date('Y-m-d H:i', strtotime($fechaSalidaPais));
            $_POST['sal_salida'] = $fechaFormateadaIniSal;

            $fechaIngresoPais = $_POST['sal_ingreso'];
            $fechaFormateadaFinLic = date('Y-m-d H:i', strtotime($fechaIngresoPais));
            $_POST['sal_ingreso'] = $fechaFormateadaFinLic;


            $solicitante = new Solicitante($_POST);
            $solicitanteResultado = $solicitante->crear();

            if ($solicitanteResultado['resultado'] == 1) {
                $solicitanteId = $solicitanteResultado['id'];

                $solicitud = new Solicitud($_POST);
                $solicitud->sol_solicitante = $solicitanteId;
                $solicitudResultado = $solicitud->crear();

                if ($solicitudResultado['resultado'] == 1) {
                    $solicitudId = $solicitudResultado['id'];

                    $archivo = $_FILES['pdf_ruta'];
                    $ruta = "../storage/$catalogo_doc" . "." . uniqid() . ".pdf";
                    $subido = move_uploaded_file($archivo['tmp_name'], $ruta);

                    if ($subido) {
                        $pdf = new Pdf([
                            'pdf_solicitud' => $solicitudId,
                            'pdf_ruta' => $ruta
                        ]);
                        $pdfResultado = $pdf->crear();


                        if ($pdfResultado['resultado'] == 1) {
                            $autorizacion = new Autorizacion($_POST);
                            $autorizacion->aut_solicitud = $solicitudId;
                            $autorizacionResultado = $autorizacion->crear();
                    }

                }
            }
        }


    }

}
}
