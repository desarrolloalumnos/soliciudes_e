<?php

namespace Controllers;

use Exception;
use Model\Autorizacion;
use Model\Protocolo;
use Model\Pdf;
use Model\Personal;
use Model\Motivos;
use Model\Solicitante;
use Model\Solicitud;
use MVC\Router;

class ProtocolosolController{
    public static function index(Router $router)
    {
        $motivos = static::motivos();

        $router->render('protocolosol/index', [
            'motivos' => $motivos
        ]);
    }

    public static function guardarApi(){
        try {
            $catalogo_doc = $_POST['ste_cat'];

            // Formatear fechas
            $fechaAutorizacion = $_POST['aut_fecha'];
            $fechaFormateadaAutorizacion = date('Y-m-d H:i', strtotime($fechaAutorizacion));
            $_POST['aut_fecha'] = $fechaFormateadaAutorizacion;

            $fechaSolicito = $_POST['ste_fecha'];
            $fechaFormateadaSolicito = date('Y-m-d H:i', strtotime($fechaSolicito));
            $_POST['ste_fecha'] = $fechaFormateadaSolicito;

            $fechaInicioActividad = $_POST['pco_fechainicio'];
            $fechaFormateadaIni = date('Y-m-d H:i', strtotime($fechaInicioActividad));
            $_POST['pco_fechainicio'] = $fechaFormateadaIni;

            $fechaFinActividad = $_POST['pco_fechafin'];
            $fechaFormateadaFin = date('Y-m-d H:i', strtotime($fechaFinActividad));
            $_POST['pco_fechafin'] = $fechaFormateadaFin;

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

                            if ($autorizacionResultado['resultado'] == 1) {
                                echo json_encode([
                                    'mensaje' => 'Registro guardado correctamente',
                                    'codigo' => 1
                                ]);
                            } else {
                                echo json_encode([
                                    'mensaje' => 'No se pudo crear la autorización',
                                    'codigo' => 0
                                ]);
                            }
                        } else {
                            echo json_encode([
                                'mensaje' => 'No se pudo crear el PDF',
                                'codigo' => 0
                            ]);
                        }
                    } else {
                        echo json_encode([
                            'mensaje' => 'No se pudo subir el archivo',
                            'codigo' => 0
                        ]);
                    }
                } else {
                    echo json_encode([
                        'mensaje' => 'No se pudo crear la solicitud',
                        'codigo' => 0
                    ]);
                }
            } else {
                echo json_encode([
                    'mensaje' => 'No se pudo crear el solicitante',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogoApi() {
        $validarCatalogo = $_GET['per_catalogo'];
        
        $sql = "select  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo, RTRIM(per_nom1) || ' ' || RTRIM(per_nom2) || ' ' || RTRIM( per_ape1)  ||  ' ' || RTRIM(per_ape2) nombre from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo";
             
        try {
            $motivos = Personal::fetchArray($sql);
            echo json_encode($motivos);
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogo2Api(){

        $validarCatalogo2 = $_GET['per_catalogo'];


        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo2 ";


        try {
            $resultado = Personal::fetchArray($sql);
            echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function motivos(){
        $sql = "SELECT * FROM se_motivos where mot_situacion = 1";
        
        try {
            
            $motivos = Motivos::fetchArray($sql);
 
            if ($motivos){
                
                return $motivos; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }



    public static function Protocolo(){
        $sql = "SELECT * FROM se_combos_marimbas_vallas WHERE cmv_situacion = 1";
    
        try {
            $combosMarimbasVallas = Protocolo::fetchArray($sql);
    
            if ($combosMarimbasVallas){
                return $combosMarimbasVallas;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }


}