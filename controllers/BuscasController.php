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
        // $router->verPdf('matrimonio/634576.653b7cfdb545b', []);
    }

    public static function buscarApi()
    {
        // $cmv_dependencia = $_GET['cmv_dependencia'];
        // $cmv_tip = $_GET['cmv_tip'];



        $sql = "SELECT 
                    mat.mat_id,
                    (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = parm.parejam_cat) AS nombres_pareja,
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = parm.parejam_cat) AS grado_pareja,     
                    (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = ste.ste_cat) AS nombres_solicitante,
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste.ste_cat) AS grado_solicitante,
                    sol.sol_id,	
                    ste.ste_id,
                    ste.ste_cat, 
                    ste.ste_fecha,                            	
                    ste.ste_telefono,   
                    mat.mat_lugar_civil,
                    mat.mat_fecha_bodac,
                    mat.mat_lugar_religioso,
                    mat.mat_fecha_bodar,
                    parc.parejac_id, 			
                    TRIM(parc.parejac_nombres)||' '||TRIM(parc.parejac_apellidos) AS nombres,
                    parc.parejac_direccion,    
                    parc.parejac_dpi,                  
                    parm.parejam_id,			
                    parm.parejam_cat,
                    pdf.pdf_id, 			
                    pdf.pdf_ruta,		
                    pdf.pdf_solicitud, 
                    pdf_ruta, 
                    mat.mat_fecha_lic_ini,
                    mat.mat_fecha_lic_fin
                FROM 
                    se_matrimonio mat
                LEFT JOIN
                    se_autorizacion auth
                ON
                    mat.mat_autorizacion = auth.aut_id
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
                    se_motivos  mot
                ON 
                    sol.sol_motivo = mot.mot_id
                LEFT JOIN
                    se_solicitante  ste
                ON 
                    sol.sol_solicitante = ste.ste_id
                LEFT JOIN
                    se_pareja_civil parc
                ON 
                    mat.mat_per_civil = parc.parejac_id
                LEFT JOIN
                    se_pareja_militar parm
                ON 
                    mat.mat_per_army = parm.parejam_id
                WHERE mat.mat_situacion = 1 AND sol.sol_situacion = 1";

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



    public static function modificarApi()
    {

        try {



            $catalogo_doc = $_POST['ste_cat'];

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

            $archivo = $_FILES['pdf_ruta'];
            $ruta = "../storage/matrimonio/$catalogo_doc" . uniqid() . ".pdf";
            $subido = move_uploaded_file($archivo['tmp_name'], $ruta);
            if ($subido) {
                $nuevoDocumento = Pdf::find($_POST['pdf_id']);
                $nuevoDocumento->pdf_ruta = $ruta;
                $resultado5 = $nuevoDocumento->actualizar();

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
                   
                    return;
                } else {
                    
                }
            }

            
            if (isset($_POST['parejam_id']) && !empty($_POST['parejam_id'])) {
                $parejamId = $_POST['parejam_id'];
                $parejaMilitar = ParejaMilitar::find($parejamId);

                
                if ($parejaMilitar) {
                    $parejaMilitar->parejam_cat = $_POST['parejam_cat'];
                    $parejaMilitar->parejam_comando = $_POST['parejam_comando'];
                    $parejaMilitar->parejam_gra = $_POST['parejam_gra'];
                    $parejaMilitar->parejam_arm = $_POST['parejam_arm'];
                    $parejaMilitar->parejam_emp = $_POST['parejam_emp'];
                    $parejaMilitarResultado = $parejaMilitar->actualizar();
                   
                } else {
                   
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
            } else {
                echo json_encode([
                    'mensaje' => 'No se pudo modificar el registro',
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

    public static function VerPdf(Router $router)
    {

        $ruta = base64_decode(base64_decode(base64_decode($_GET['ruta'])));

        $router->printPDF($ruta);
    }

    // public static function eliminarAPI()
    // {
    //     try {
    //         $motivo_id = $_POST['mot_id'];
    //         $motivo = Motivos::find($motivo_id);
    //         $motivo->mot_situacion = 0;
    //         $resultado = $motivo->actualizar();

    //         if ($resultado['resultado'] == 1) {
    //             echo json_encode([
    //                 'mensaje' => 'Registro eliminado correctamente',
    //                 'codigo' => 1
    //             ]);
    //         } else {
    //             echo json_encode([
    //                 'mensaje' => 'Ocurrió un error',
    //                 'codigo' => 0
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
}
