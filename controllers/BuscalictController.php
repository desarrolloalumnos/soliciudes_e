<?php

namespace Controllers;

use Exception;
use Model\Licenciatemporal;
use MVC\Router;

class BuscalictController
{
    public static function index(Router $router)
    {
        
        $router->render('busquedaslict/index', [
            
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


            $id = $_POST['ste_id'];
            $solicitante = Solicitante::find($id);
            $solicitante->ste_telefono = $_POST['ste_telefono'];
            $resultado = $solicitante->actualizar();


            if (isset($_POST['parejac_id']) && !empty($_POST['parejac_id'])) {
                $parejacId = $_POST['parejac_id'];
                $parejaCivil = ParejaCivil::find($parejacId);


                if ($parejaCivil) {
                    $parejaCivil->parejac_nombres = $_POST['parejac_nombres'];
                    $parejaCivil->parejac_apellidos = $_POST['parejac_apellidos'];
                    $parejaCivil->parejac_direccion = $_POST['parejac_direccion'];
                    $parejaCivil->parejac_dpi = $_POST['parejac_dpi'] ?? '';
                    $parejaCivilResultado = $parejaCivil->actualizar();
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
}
