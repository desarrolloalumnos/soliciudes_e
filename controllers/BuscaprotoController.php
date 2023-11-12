<?php

namespace Controllers;

use Exception;
use Model\Protocolosol;
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
public static function buscarEventos(){

    $sql = "SELECT 
                pco_just,
                pco_fechainicio,
                pco_fechafin 
            FROM se_protocolo
            WHERE pco_situacion = 1";


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


}