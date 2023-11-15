<?php

namespace Controllers;

use Exception;
use Model\Protocolosol;
use Model\Pdf;
use Model\Protocolo;
use Model\Solicitud;
use Model\Solicitante;
use MVC\Router;

class BuscaprotoController{
    public static function index(Router $router){
        // $motivos = static::motivos();

        $router->render('busquedasproto/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi(){

        $sql = "SELECT
        pco_id,
        ste_cat,
        gra_desc_lg,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) nombre,
        cmv_tip,
        pco_fechainicio,
        pco_fechafin,
        pco_dir,
        pco_just,
        pdf_id,
        pdf_ruta
        FROM se_protocolo
        INNER JOIN se_combos_marimbas_vallas ON pco_cmbv = cmv_id  
        inner join se_autorizacion on aut_id = pco_autorizacion
        inner join se_solicitudes on aut_solicitud = sol_id
        inner join se_solicitante on sol_solicitante= ste_id
        inner join mper on ste_cat = per_catalogo
        inner join grados on ste_gra = gra_codigo
        inner join se_pdf on pdf_solicitud = sol_id";
    

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
public static function buscarCalender(){
    
    try {
    $sql = "SELECT 
    pco_just as  title,
    pco_fechainicio as start,
    pco_fechafin as end
FROM se_protocolo
WHERE pco_situacion = 1";


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

public static function modificarApi(){

        try {

            $fechaSolicito = $_POST['ste_fecha'];
            $fechaFormateadaSolicito = date('Y-m-d H:i', strtotime($fechaSolicito));
            $_POST['ste_fecha'] = $fechaFormateadaSolicito;
            
            $fechaInicioSol = $_POST['pco_fechainicio'];
            $fechaFormateadaIniLic = date('Y-m-d H:i', strtotime($fechaInicioSol));
            $_POST['pco_fechainicio'] = $fechaFormateadaIniLic;

            $fechaFinSol= $_POST['pco_fechafin'];
            $fechaFormateadaFinLic = date('Y-m-d H:i', strtotime($fechaFinSol));
            $_POST['pco_fechafin'] = $fechaFormateadaFinLic;

            if (isset($_POST['ste_id']) && !empty($_POST['ste_id'])) {
                $id = $_POST['ste_id'];
                $solicitante = Solicitante::find($id);

                $solicitante->ste_telefono = $_POST['ste_telefono'];
                $resultado = $solicitante->actualizar();
            } else {
            }

            if (isset($_POST['cmv_id']) && !empty($_POST['cmv_id'])) {
                $comboId = $_POST['cmv_id'];
                $combo = Protocolo::find($comboId);


                if ($combo) {
                    $combo->cmv_dependencia = $_POST['cmv_dependencia'];
                    $combo->cmv_tip = $_POST['cmv_tip'];
                    $comboResultado = $combo->actualizar();
                }
            }

            $pcoId = $_POST['pco_id'];
            $protocolo = Protocolosol::find($pcoId);
            $protocolo->pco_civil = $_POST['pco_civil'];
            $protocolo->pco_fechainicio = $_POST['pco_fechainicio'];
            $protocolo->pco_dir = $_POST['pco_dir'];
            $protocolo->pco_just = $_POST['pco_just'];
            $protocolo->pco_fechainicio = strtotime($_POST['pco_fechainicio']); 
            $protocolo->pco_fechafin = strtotime($_POST['pco_fechafin']); 
            $protocoloResultado = $protocolo->actualizar();

            
            if ($protocoloResultado['resultado'] == 1) {
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

    public static function VerPdf(Router $router){

        $ruta = base64_decode(base64_decode(base64_decode($_GET['ruta'])));

        $router->printPDF($ruta);
    }

    public static function modificarPdfApi() {
        try {

            $catalogo_doc = $_POST['ste_cat2'];

            if (!empty($_FILES['pdf_ruta']['name'])) {
                $archivo = $_FILES['pdf_ruta'];
                $ruta = "../storage/protocolos/$catalogo_doc" . uniqid() . ".pdf";
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

    public static function eliminarApi(){
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
    
