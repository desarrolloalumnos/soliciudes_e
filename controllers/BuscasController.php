<?php

namespace Controllers;

use Exception;
use Model\Autorizacion;
use Model\Matrimonio;
use Model\Motivos;
use Model\ParejaCivil;
use Model\ParejaMilitar;
use Model\Pdf;
use Model\Solicitante;
use Model\Solicitud;
use MVC\Router;

class BuscasController
{
    public static function index(Router $router)
    {
        $router->render('busquedasc/index', []);
    }

    public static function buscarApi()
    {
        // $cmv_dependencia = $_GET['cmv_dependencia'];
        // $cmv_tip = $_GET['cmv_tip'];
        $catalogo = $_GET['catalogo'];
        $fecha = $_GET['fecha'];


        $sql = "SELECT 
        ste_id,
        ste_cat,
        ste_telefono,
        gra_desc_lg as grado_solicitante ,
        sol_situacion,
        TRIM(parejac_nombres) || '' || (parejac_apellidos) AS pareja_civil,
        (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) FROM mper 
        INNER JOIN grados ON mper.per_grado = grados.gra_codigo INNER JOIN armas ON mper.per_arma = armas.arm_codigo
        WHERE per_catalogo = parejam_cat) AS grado_pareja,
        (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) FROM mper 
        WHERE per_catalogo = parejam_cat) AS nombre_pareja,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombre_solicitante,
        mat_fecha_lic_ini,
        mat_fecha_lic_fin, 
        pdf_solicitud,
        sol_id,
        pdf_id,
        pdf_solicitud,
        pdf_ruta
    FROM se_matrimonio
    INNER JOIN se_autorizacion ON aut_id = mat_autorizacion
    INNER JOIN se_solicitudes ON aut_solicitud = sol_id
    INNER JOIN se_solicitante ON sol_solicitante = ste_id
    LEFT JOIN se_pareja_civil ON mat_per_civil = parejac_id
    LEFT JOIN se_pareja_militar ON mat_per_army = parejam_id
    LEFT JOIN mper ON ste_cat = per_catalogo OR parejam_cat = per_catalogo
    INNER JOIN grados ON ste_gra = gra_codigo
    INNER JOIN se_pdf ON pdf_solicitud = sol_id   
    AND (sol_situacion = 1 OR sol_situacion = 7)
    ORDER BY ste_fecha DESC";

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
            $resultado = Matrimonio::fetchArray($sql);

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
        mat_id,
        mat_lugar_civil,
        mat_fecha_bodac,
        mat_lugar_religioso,
        mat_fecha_bodar,
        mat_per_civil,
        parejac_id,
        parejac_direccion,
        parejac_dpi,
        mat_per_army,
        parejam_id,
        parejam_cat,    
        ste_telefono,
        gra_desc_lg AS grado_solicitante,
        TRIM(parejac_nombres) || ' ' || (parejac_apellidos) AS pareja_civil,
        (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) FROM mper 
        INNER JOIN grados ON mper.per_grado = grados.gra_codigo INNER JOIN armas ON mper.per_arma = armas.arm_codigo
        WHERE per_catalogo = parejam_cat) AS grado_pareja,
        (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) FROM mper 
        WHERE per_catalogo = parejam_cat) AS nombres_pareja,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombres_solicitante,
        mat_fecha_lic_ini,
        mat_fecha_lic_fin,
        ste_fecha,
        pdf_ruta
    FROM se_matrimonio
    INNER JOIN se_autorizacion ON aut_id = mat_autorizacion
    INNER JOIN se_solicitudes ON aut_solicitud = sol_id
    INNER JOIN se_solicitante ON sol_solicitante = ste_id
    LEFT JOIN se_pareja_civil ON mat_per_civil = parejac_id
    LEFT JOIN se_pareja_militar ON mat_per_army = parejam_id
    LEFT JOIN mper ON ste_cat = per_catalogo OR parejam_cat = per_catalogo
    INNER JOIN grados ON ste_gra = gra_codigo
    INNER JOIN se_pdf ON pdf_solicitud = sol_id 
    where sol_situacion >= 1 AND ste_id = $id ";


        try {
            $resultado = Matrimonio::fetchArray($sql);

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
            $_POST['mat_fecha_bodac'] = $fechaFormateadaBodaC;

            $fechaBodaR = $_POST['mat_fecha_bodar'];
            $fechaFormateadaBodaR = date('Y-m-d H:i', strtotime($fechaBodaR));
            $_POST['mat_fecha_bodar'] = $fechaFormateadaBodaR;

            if (isset($_POST['ste_id']) && !empty($_POST['ste_id'])) {
                $id = $_POST['ste_id'];
                $solicitante = Solicitante::find($id);

                $solicitante->ste_telefono = $_POST['ste_telefono'];
                $resultado = $solicitante->actualizar();
                if ($resultado['resultado'] == 1) {
                    $modificacionExitosa = true;
                }
            } 
            if (isset($_POST['parejac_id']) && !empty($_POST['parejac_id'])) {
                $parejacId = $_POST['parejac_id'];
                $parejaCivil = ParejaCivil::find($parejacId);
                if ($parejaCivil) {
                    $parejaCivil->parejac_nombres = $_POST['parejac_nombres'];
                    $parejaCivil->parejac_apellidos = $_POST['parejac_apellidos'];
                    $parejaCivil->parejac_direccion = $_POST['parejac_direccion'];
                    $parejaCivil->parejac_dpi = $_POST['parejac_dpi'] ?? '';
                    $parejaCivilResultado = $parejaCivil->actualizar();
                    if ($parejaCivilResultado['resultado'] == 1) {
                        $modificacionExitosa = true;
                    }
                }
            }
            if (isset($_POST['parejam_id']) && !empty($_POST['parejam_id']) && !empty($_POST['parejam_comando'])) {
                $parejamId = $_POST['parejam_id'];
                $parejaMilitar = ParejaMilitar::find($parejamId);
                if ($parejaMilitar) {
                    $parejaMilitar->parejam_cat = $_POST['parejam_cat'];
                    $parejaMilitar->parejam_comando = $_POST['parejam_comando'];
                    $parejaMilitar->parejam_gra = $_POST['parejam_gra'];
                    $parejaMilitar->parejam_arm = $_POST['parejam_arm'];
                    $parejaMilitar->parejam_emp = $_POST['parejam_emp'];
                    $parejaMilitarResultado = $parejaMilitar->actualizar();
                    if ($parejaMilitarResultado['resultado'] == 1) {
                        $modificacionExitosa = true;
                    }
                }
            }
            $matId = $_POST['mat_id'];
            $matrimonio = Matrimonio::find($matId);
            $matrimonio->mat_lugar_civil = $_POST['mat_lugar_civil'];
            $matrimonio->mat_fecha_bodac = $_POST['mat_fecha_bodac'];
            $matrimonio->mat_lugar_religioso = $_POST['mat_lugar_religioso'];
            $matrimonio->mat_fecha_bodar = $_POST['mat_fecha_bodar'];
            $matrimonio->mat_fecha_lic_ini = $_POST['mat_fecha_lic_ini'];
            $matrimonio->mat_fecha_lic_fin = $_POST['mat_fecha_lic_fin'];
            $matrimonioResultado = $matrimonio->actualizar();
            if ($matrimonioResultado['resultado'] == 1) {
                $modificacionExitosa = true;
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

    public static function VerPdf(Router $router)
    {

        $ruta = base64_decode(base64_decode(base64_decode($_GET['ruta'])));

        $router->printPDF($ruta);
    }

    public static function modificarPdfApi()
    {
        try {

            $catalogo_doc = $_POST['catalogo'];

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

    public static function eliminarApi()
    {
        try {

            $solicitud_id = $_POST['sol_id'];
            $solicitud = Solicitud::find($solicitud_id);
            $solicitud->sol_situacion = 0;
            $resultado = $solicitud->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
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

    public static function corregirApi()
    {
        try {
            $solicitud_id = $_POST['sol_id'];
            $solicitud = Solicitud::find($solicitud_id);
            $solicitud->sol_situacion = 8;
            $resultado = $solicitud->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro corregido correctamente',
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
}
