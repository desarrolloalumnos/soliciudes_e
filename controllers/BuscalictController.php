<?php

namespace Controllers;

use Exception;
use Model\Licenciatemporal;
use Model\Motivos;
use Model\Pdf;
use Model\Solicitante;
use Model\Solicitud;
use MVC\Router;

class BuscalictController
{
    public static function index(Router $router)
    {
        $motivos = static::motivos();

        $router->render('busquedaslict/index', [
            'motivos' => $motivos,


        ]);
    }

    public static function buscarApi()
    {
        // $cmv_dependencia = $_GET['cmv_dependencia'];
        // $cmv_tip = $_GET['cmv_tip'];



        $sql = " SELECT 
                        lit.lit_id,
                        TRIM(per.per_nom1) || ' ' || TRIM(per.per_nom2) || ' ' || TRIM(per.per_ape1) || ' ' || TRIM(per.per_ape2) AS nombres_solicitante,
                        TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) AS grado_solicitante,
                        tiempos.t_oficial AS tiempo,
                        sol.sol_id,
                        ste.ste_id,
                        ste.ste_cat,
                        ste.ste_telefono,
                        sol.sol_obs,
                        mot.mot_id,
                        pdf.pdf_id,
                        pdf.pdf_ruta,
                        pdf.pdf_solicitud,
                        lit.lit_mes_consueldo,
                        lit.lit_mes_sinsueldo,
                        lit.lit_fecha1,
                        lit.lit_fecha2
                    FROM 
                        se_licencia_temporal lit
                    LEFT JOIN
                        se_autorizacion auth
                    ON 
                        lit.lit_autorizacion = auth.aut_id
                    LEFT JOIN 
                        se_solicitudes sol
                    ON 
                        auth.aut_solicitud = sol.sol_id
                    LEFT JOIN 
                        se_pdf pdf
                    ON 
                        pdf.pdf_solicitud = sol.sol_id
                    LEFT JOIN
                        se_tipo_solicitud tipo
                    ON 
                        sol.sol_tipo = tipo.tse_id
                    LEFT JOIN
                        se_motivos mot
                    ON 
                        sol.sol_motivo = mot.mot_id
                    LEFT JOIN
                        se_solicitante ste
                    ON 
                        sol.sol_solicitante = ste.ste_id
                    LEFT JOIN
                        mper per
                    ON
                        per.per_catalogo = ste.ste_cat
                    LEFT JOIN
                        grados
                    ON
                        per.per_grado = grados.gra_codigo
                    LEFT JOIN
                        armas
                    ON
                        per.per_arma = armas.arm_codigo
                    LEFT JOIN
                        tiempos
                    ON
                        tiempos.t_catalogo = ste.ste_cat
                    WHERE 
                        lit.lit_situacion = 1 and sol.sol_situacion = 1  ";

        // if ($cmv_dependencia != 0) {
        //     $sql .= " AND cmv_dependencia = $cmv_dependencia ";
        // }

        // if (!empty($cmv_tip)) {
        //     $sql .= " AND cmv_tip = '$cmv_tip' ";
        // }

        try {
            $resultado = Licenciatemporal::fetchArray($sql);
            echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function modificarApi()
    {

        try {
            // echo json_encode($_POST);
            // exit;
          
            $tiempo = $_POST['tiempo'];
            $numeroEntero = intval($tiempo);

            if ($numeroEntero >= 10000 && $numeroEntero <= 50000) {
                $_POST['lit_mes_sinsueldo'] = min(3, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(0, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 50001 && $numeroEntero <= 100000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(0, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 100001 && $numeroEntero <= 200000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(1, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 200001 && $numeroEntero <= 280000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(2, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 280001 && $numeroEntero <= 330000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(1, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 33001) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(2, $_POST['lit_mes_consueldo']);
            } else {
                exit;
            }

            $fechaIncioLicencia = $_POST['lit_fecha1'];
            $fechaFormateadaIniLic = date('Y-m-d H:i', strtotime($fechaIncioLicencia));
            $_POST['lit_fecha1'] = $fechaFormateadaIniLic;

            $fechaFinLicencia = $_POST['lit_fecha2'];
            $fechaFormateadaFinLic = date('Y-m-d H:i', strtotime($fechaFinLicencia));
            $_POST['lit_fecha2'] = $fechaFormateadaFinLic;


            if (isset($_POST['ste_id']) && !empty($_POST['ste_id'])) {
                $solicitante = Solicitante::find($_POST['ste_id']);
                $solicitante->ste_telefono = $_POST['ste_telefono'];
                $resultado = $solicitante->actualizar();
            } else {
            }

            if (isset($_POST['sol_id']) && !empty($_POST['sol_id'])) {
                $solicitud = Solicitud::find($_POST['sol_id']);
                $solicitud->sol_obs = $_POST['sol_obs'];
                $solicitud->sol_motivo = $_POST['sol_motivo'];
                $solicitudResultado = $solicitud->actualizar();
            } else {
            }


            if (isset($_POST['lit_id']) && !empty($_POST['lit_id'])) {
                $licencia = Licenciatemporal::find($_POST['lit_id']);
                $licencia->lit_mes_consueldo = $_POST['lit_mes_consueldo'];
                $licencia->lit_mes_sinsueldo = $_POST['lit_mes_sinsueldo'];
                $licencia->lit_fecha1 = $_POST['lit_fecha1'];
                $licencia->lit_fecha2 = $_POST['lit_fecha2'];
                $licenciaResultado = $licencia->actualizar();
            } else {
            }



            if ($licenciaResultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
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

    public static function modificarPdfApi()
    {
        try {

            $catalogo_doc = $_POST['ste_cat2'];

            if (!empty($_FILES['pdf_ruta']['name'])) {
                $archivo = $_FILES['pdf_ruta'];
                $ruta = "../storage/matrimonio/$catalogo_doc" . uniqid() . ".pdf";
                $subido = move_uploaded_file($archivo['tmp_name'], $ruta);

                if ($subido) {
                    $pdf_id = $_POST['pdf_id'];
                    $nuevoDocumento = Pdf::find($pdf_id);
                    $nuevoDocumento->pdf_solicitud = $_POST['pdf_solicitud'];
                    $nuevoDocumento->pdf_ruta = $ruta;
                    $resultado = $nuevoDocumento->actualizar();
                } else {
                }
            }

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
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
    public static function VerPdf(Router $router)
    {

        $ruta = base64_decode(base64_decode(base64_decode($_GET['ruta'])));

        $router->printPDF($ruta);
    }


    // public static function eliminarApi()
    // {
    //     try {

    //         $solicitud_id = $_POST['sol_id'];
    //         $solicitud = Solicitud::find($solicitud_id);
    //         $solicitud->sol_situacion = 0;
    //         $resultado = $solicitud->actualizar();

    //         if ($resultado['resultado'] == 1) {
    //             echo json_encode([
    //                 'mensaje' => 'Registro eliminado correctamente',
    //                 'codigo' => 1
    //             ]);
    //         }
    //     } catch (Exception $e) {
    //         echo json_encode([
    //             'detalle' => $e->getMessage(),
    //             'mensaje' => 'Ocurrió un error',
    //             'codigo' => 0
    //         ]);
    //     }
    // }

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
