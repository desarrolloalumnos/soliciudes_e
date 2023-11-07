<?php

namespace Controllers;

use Exception;
use Model\Autorizacion;
use Model\Matrimonio;
use Model\Motivos;
use Model\ParejaCivil;
use Model\ParejaMilitar;
use Model\Pdf;
use Model\Personal;
use Model\Solicitante;
use Model\Solicitud;

use MVC\Router;

class CasamientoController
{
    public static function index(Router $router)
    {
        $motivos = static::motivos();

        $router->render('casamientos/index', [
            'motivos' => $motivos
        ]);
    }


    public static function guardarApi()
    {

        try {

            $catalogo_doc = $_POST['ste_cat'];


            $fechaAutorizacion = $_POST['aut_fecha'];
            $fechaFormateadaAutorizacion = date('Y-m-d H:i', strtotime($fechaAutorizacion));
            $_POST['aut_fecha'] = $fechaFormateadaAutorizacion;

            $fechaSolicito = $_POST['ste_fecha'];
            $fechaFormateadaSolicito = date('Y-m-d H:i', strtotime($fechaSolicito));
            $_POST['ste_fecha'] = $fechaFormateadaSolicito;

            $fechaIncioLicencia = $_POST['mat_fecha_lic_ini'];
            $fechaFormateadaIniLic = date('Y-m-d H:i', strtotime($fechaIncioLicencia));
            $_POST['mat_fecha_lic_ini'] = $fechaFormateadaIniLic;

            $fechaFinLicencia = $_POST['mat_fecha_lic_fin'];
            $fechaFormateadaFinLic = date('Y-m-d H:i', strtotime($fechaFinLicencia));
            $_POST['mat_fecha_lic_fin'] = $fechaFormateadaFinLic;

            $fechaBodaC = $_POST['mat_fecha_bodac'];
            $fechaFormateadaBodaC = date('Y-m-d H:i', strtotime($fechaBodaC));
            $_POST['mat_fecha_bodac'] =  $fechaFormateadaBodaC;

            $fechaBodaR = $_POST['mat_fecha_bodar'];
            $fechaFormateadaBodaR = date('Y-m-d H:i', strtotime($fechaBodaR));
            $_POST['mat_fecha_bodar'] =  $fechaFormateadaBodaR;

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
                    $ruta = "../storage/matrimonio/$catalogo_doc" . uniqid() . ".pdf";
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
                                if (!empty($_POST['parejac_nombres']) && !empty($_POST['parejac_apellidos']) && !empty($_POST['parejac_dpi'])) {
                                    $parejaCivil = new ParejaCivil($_POST);
                                    $parejaCivilResultado = $parejaCivil->crear();
                                } else {
                                    $parejaCivilResultado = ['resultado' => 0];
                                }

                                if (!empty($_POST['nombre4']) && !empty($_POST['parejam_cat'])) {
                                    $parejaMilitar = new ParejaMilitar($_POST);
                                    $parejaMilitarResultado = $parejaMilitar->crear();
                                } else {
                                    $parejaMilitarResultado = ['resultado' => 0];
                                }

                                if ($parejaCivilResultado['resultado'] == 1) {
                                    $matrimonio = new Matrimonio($_POST);
                                    $matrimonio->mat_autorizacion = $autorizacionResultado['id'];
                                    $matrimonio->mat_per_civil = $parejaCivilResultado['id'];
                                    $matrimonioResultado = $matrimonio->crear();
                                } elseif ($parejaMilitarResultado['resultado'] == 1) {
                                    $matrimonio = new Matrimonio($_POST);
                                    $matrimonio->mat_autorizacion = $autorizacionResultado['id'];
                                    $matrimonio->mat_per_army = $parejaMilitarResultado['id'];
                                    $matrimonioResultado = $matrimonio->crear();
                                } else {
                               
                                    exit;
                                }
                            } else {
                               
                                exit;
                            }
                        } else {
                           
                            exit;
                        }
                    } else {
                      
                        exit;
                    }
                } else {
                 
                    exit;
                }
            } else {
             
                exit;
            }

            if ($matrimonioResultado['resultado'] == 1) {

                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogoApi()
    {
        $validarCatalogo = $_GET['per_catalogo'];

        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo ";


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

    public static function buscarCatalogo2Api()
    {
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

    public static function buscarCatalogo3Api()
    {
        $validarCatalogo3 = $_GET['per_catalogo'];


        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo3";


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
    public static function motivos()
    {
        $sql = "SELECT * FROM se_motivos where mot_situacion = 1";



        try {

            $motivos = Motivos::fetchArray($sql);

            if ($motivos) {

                return $motivos;
            } else {
                return 0;
            }
        } catch (Exception $e) {
        }
    }
}
