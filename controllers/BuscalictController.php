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

    public static function buscarApi(){
        
        $catalogo = $_GET['catalogo'];
        $fecha = $_GET['fecha'];

        $sql = " SELECT  
        ste_id,
        ste_cat,
        ste_telefono,
        gra_desc_lg,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombre_solicitante,
        lit_mes_consueldo,
        lit_mes_sinsueldo,
        pdf_solicitud,
        sol_id,
        pdf_id,
        pdf_solicitud,
        lit_fecha1,
        lit_fecha2,
        pdf_ruta
    FROM se_licencia_temporal
    INNER JOIN se_autorizacion ON aut_id = lit_autorizacion
    INNER JOIN se_solicitudes ON aut_solicitud = sol_id
    INNER JOIN se_solicitante ON sol_solicitante = ste_id
    LEFT JOIN mper ON ste_cat = per_catalogo
    INNER JOIN grados ON ste_gra = gra_codigo
    INNER JOIN se_pdf ON pdf_solicitud = sol_id 
    WHERE sol_situacion = 1 ";


                    if ($fecha != '') {
                        $sql .= " AND cast(ste_fecha as date) = '$fecha' ";
                    }
                    if ($catalogo != '') {
                        $sql .= " AND ste_cat = '$catalogo'";
                    }

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
    public static function buscarModalApi()
    {
        $id = $_GET ['id'];
                    $sql = "SELECT  
                    ste_id,
                    ste_cat,
                    sol_motivo,
                    lit_id,
                    lit_mes_consueldo,
                    lit_mes_sinsueldo,
                    lit_fecha1,
                    lit_fecha2,
                    ste_telefono,
                    gra_desc_lg AS grado_solicitante,      
                    TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombres_solicitante,
                    ste_telefono,
                    sol_id,
                    sol_obs,
                    (select t_oficial from tiempos where t_catalogo =  ste_cat) AS tiempo,
                    pdf_ruta
                FROM se_licencia_temporal
                INNER JOIN se_autorizacion ON aut_id = lit_autorizacion
                INNER JOIN se_solicitudes ON aut_solicitud = sol_id
                INNER JOIN se_solicitante ON sol_solicitante = ste_id
                INNER JOIN mper ON ste_cat = per_catalogo
                INNER JOIN grados ON ste_gra = gra_codigo
                INNER JOIN se_pdf ON pdf_solicitud = sol_id 
                where sol_situacion >= 1 AND ste_id = $id ";


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
                $id = $_POST['ste_id'];
                $solicitante = Solicitante::find($id);

                $solicitante->ste_telefono = $_POST['ste_telefono'];
                $resultado = $solicitante->actualizar();
                if ($resultado['resultado'] == 1) {
                    $modificacionExitosa = true;
                }
            } 

            if (isset($_POST['sol_id']) && !empty($_POST['sol_id'])) {
                $solicitud = Solicitud::find($_POST['sol_id']);
                $solicitud->sol_obs = $_POST['sol_obs'];
                $solicitud->sol_motivo = $_POST['sol_motivo'];
                $solicitudResultado = $solicitud->actualizar();
                if ($solicitudResultado['resultado'] == 1) {
                    $modificacionExitosa = true;
                }
            }


            if (isset($_POST['lit_id']) && !empty($_POST['lit_id'])) {
                $licencia = Licenciatemporal::find($_POST['lit_id']);
                $licencia->lit_mes_consueldo = $_POST['lit_mes_consueldo'];
                $licencia->lit_mes_sinsueldo = $_POST['lit_mes_sinsueldo'];
                $licencia->lit_fecha1 = $_POST['lit_fecha1'];
                $licencia->lit_fecha2 = $_POST['lit_fecha2'];
                $licenciaResultado = $licencia->actualizar();
                if ($licenciaResultado['resultado'] == 1) {
                    $modificacionExitosa = true;
                }
            }



            if ($modificacionExitosa) {
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
            $catalogo_doc = $_POST['ste_catalogo'];

            if (!empty($_FILES['pdf_ruta']['name'])) {
                // Obtener la ruta del archivo anterior desde la base de datos
                $pdf_id = $_POST['pdf_id'];
                $documentoExistente = Pdf::find($pdf_id);
                $rutaAnterior = $documentoExistente->pdf_ruta;

                // Generar la nueva ruta para el archivo PDF
                $archivo = $_FILES['pdf_ruta'];
                $rutaNueva = "../storage/matrimonio/$catalogo_doc" . uniqid() . ".pdf";

                // Mover el nuevo archivo
                $subido = move_uploaded_file($archivo['tmp_name'], $rutaNueva);

                if ($subido) {
                    $documentoExistente->pdf_solicitud = $_POST['pdf_solicitud'];
                    $documentoExistente->pdf_ruta = $rutaNueva;
                    $resultado = $documentoExistente->actualizar();


                    if ($resultado && file_exists($rutaAnterior)) {
                        unlink($rutaAnterior);
                    }
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
