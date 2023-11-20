<?php

namespace Controllers;

use Exception;
use Model\Protocolosol;
use Model\Motivos;
use Model\Pdf;
use Model\Protocolo;
use Model\Solicitud;
use Model\Solicitante;
use MVC\Router;

class BuscaprotoController
{
    public static function index(Router $router)
    {
        $motivos = static::motivos();
        $combo = static::Protocolo();

        $router->render('busquedasproto/index', [
            'motivos' => $motivos,
            'combos' => $combo
        ]);
    }

    public static function buscarApi()
    {

        $catalogo = $_GET['catalogo'];
        $fecha = $_GET['fecha'];

        $sql = "SELECT
                    ste_id,
                    pco_id,
                    ste_cat,
                    sol_id,
                    gra_desc_lg,
                    TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) nombre,
                    cmv_tip,
                    dep_desc_lg,
                    pco_fechainicio,
                    pco_fechafin,
                    pco_dir,
                    pdf_id,
                    pdf_solicitud,
                    pdf_ruta
                FROM se_protocolo
                INNER JOIN se_combos_marimbas_vallas ON pco_cmbv = cmv_id  
                inner join mdep on cmv_dependencia = dep_llave
                inner join se_autorizacion on aut_id = pco_autorizacion
                inner join se_solicitudes on aut_solicitud = sol_id
                inner join se_solicitante on sol_solicitante= ste_id
                inner join mper on ste_cat = per_catalogo
                inner join grados on ste_gra = gra_codigo
                inner join se_pdf on pdf_solicitud = sol_id
                WHERE pco_situacion = 1  
                AND sol_situacion = 1           
                ";
        if ($fecha != '') {
            $sql .= " AND cast(ste_fecha as date) = '$fecha' ";
        }
        if ($catalogo != '') {
            $sql .= " AND ste_cat = '$catalogo'";
        }


        try {
            $resultado = Protocolosol::fetchArray($sql);
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

        $id = $_GET['id'];
        $sql = " SELECT
        ste_id,
        pco_id,
        pco_autorizacion,
        ste_cat,
        gra_desc_lg,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombre,
        ste_fecha,
        ste_telefono,
        cmv_id,
        pco_fechainicio,
        sol_motivo,
        sol_obs,
        pco_just,
        pco_fechafin,
        pco_dir,
        pdf_ruta
        FROM se_protocolo
        INNER JOIN se_combos_marimbas_vallas ON pco_cmbv = cmv_id  
        inner join mdep on cmv_dependencia = dep_llave
        inner join se_autorizacion on aut_id = pco_autorizacion
        inner join se_solicitudes on aut_solicitud = sol_id
        inner join se_solicitante on sol_solicitante= ste_id
        inner join mper on ste_cat = per_catalogo
        inner join se_pdf on pdf_solicitud = sol_id
        inner join grados on ste_gra = gra_codigo
        WHERE pco_situacion = 1  AND ste_id = $id";


        try {
            $resultado = Protocolosol::fetchArray($sql);
            echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }

    }

    public static function buscarCalender()
    {

        try {
            $sql = "SELECT 
            c.cmv_tip || ' - ' || m.dep_desc_lg AS title,
            p.pco_fechainicio AS start,
            p.pco_fechafin AS end
        FROM 
            se_protocolo p
        JOIN 
            se_combos_marimbas_vallas c ON p.pco_cmbv = c.cmv_id
        JOIN 
            mdep m ON c.cmv_dependencia = m.dep_llave
        WHERE 
            p.pco_situacion = 1";


            $resultado = Protocolosol::fetchArray($sql);



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

            $fechaInicioActividad = $_POST['pco_fechainicio'];
            $fechaFormateadaIni = date('Y-m-d H:i', strtotime($fechaInicioActividad));
            $_POST['pco_fechainicio'] = $fechaFormateadaIni;


            $fechaFinActividad = $_POST['pco_fechafin'];
            $fechaFormateadaFin = date('Y-m-d H:i', strtotime($fechaFinActividad));
            $_POST['pco_fechafin'] = $fechaFormateadaFin;

            // $Solicitud = new Protocolosol($_POST);
            // $resultado = $Solicitud->actualizar();

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

            if (isset($_POST['cmv_id']) && !empty($_POST['cmv_id'])) {
                $comboId = $_POST['cmv_id'];
                $combo = Protocolo::find($comboId);
                $combo->cmv_tip = $_POST['cmv_tip'];
                $comboResultado = $combo->actualizar();

            }

            if (isset($_POST['pco_id']) && !empty($_POST['pco_id'])) {
                $protocolo = Protocolosol::find($_POST['pco_id']);
                $protocolo->pco_cmbv = $_POST['pco_cmbv'];
                $protocolo->pco_dir = $_POST['pco_dir'];
                $protocolo->pco_just = $_POST['pco_just'];
                $protocolo->pco_fechainicio = ($_POST['pco_fechainicio']);
                $protocolo->pco_fechafin = ($_POST['pco_fechafin']);
                $protocoloResultado = $protocolo->actualizar();

            } else {
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
                $rutaNueva = "../storage/protocolos/$catalogo_doc" . uniqid() . ".pdf";

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


    public static function Protocolo()
    {
        $sql = "SELECT 
        cmv_id,
        c.cmv_tip || ' - ' || m.dep_desc_lg AS tipo
    FROM 
        se_protocolo p
    JOIN 
        se_combos_marimbas_vallas c ON p.pco_cmbv = c.cmv_id
    JOIN 
        mdep m ON c.cmv_dependencia = m.dep_llave
    WHERE 
        c.cmv_situacion = 1";

        try {
            $combosMarimbasVallas = Protocolo::fetchArray($sql);

            if ($combosMarimbasVallas) {
                return $combosMarimbasVallas;
            } else {
                return 0;
            }
        } catch (Exception $e) {

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
