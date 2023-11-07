<?php

namespace Controllers;

use Exception;
use Model\Salidapais;
use MVC\Router;

class BuscasalpaisController{
    public static function index(Router $router){
        // $motivos = static::motivos();

        $router->render('busquedasalpais/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi(){

        $sql = "SELECT  
        ste_cat,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) nombre,
        sal_salida,
        sal_ingreso, 
        pai_desc_lg,
        dsal_ciudad,
        pdf_ruta
        FROM se_salpais
        inner join se_dsalpais on dsal_sol_salida = sal_id
        inner join se_autorizacion on aut_id = sal_autorizacion
        inner join se_solicitudes on aut_solicitud = sol_id
        inner join se_solicitante on sol_solicitante=ste_id
        inner join mper on ste_cat = per_catalogo
        inner join paises on dsal_pais = pai_codigo
        inner join se_pdf on pdf_solicitud = sol_id";

        try {
            $resultado = Salidapais::fetchArray($sql);
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