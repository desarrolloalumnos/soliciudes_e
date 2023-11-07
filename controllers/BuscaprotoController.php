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
                    dsal.dsal_id,    
                    (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = ste.ste_cat) AS nombres_solicitante,
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste.ste_cat) AS grado_solicitante,
                    dsal.sol_salida,
                    auth.aut_id,
                    auth.aut_solicitud,
                    sol.sol_id,			
                    sol.sol_tipo, 
                    tipo.tse_id,
                    sol.sol_solicitante,
                    ste.ste_id, 				
                    ste.ste_comando,        	
                    ste.ste_cat,           
                    ste.ste_gra,           	
                    ste.ste_arm,           	
                    ste.ste_emp,           	
                    ste.ste_fecha,			
                    ste.ste_telefono,  
                    sol.sol_obs,			
                    sol.sol_motivo,	
                    mot.mot_id,	
                    sol_situacion,
                    auth.aut_comando,
                    auth.aut_cat,
                    auth.aut_gra,
                    auth.aut_arm,
                    auth.aut_emp,
                    auth.aut_fecha,    
                    pdf.pdf_id, 			
                    pdf.pdf_ruta,		
                    pdf.pdf_solicitud,
                    dsal.dsal_ciudad,
                    dsal.dsal_pais,
                    dsal.dsal_transporte,
                    dsal.dsal_situacion,
                    sal.sal_id,
                    sal.sal_autorizacion,
                    sal.sal_salida,
                    sal.sal_ingreso,
                    sal.sal_situacion
                    FROM 
                    se_dsalpais dsal
                    LEFT JOIN 
                        se_autorizacion auth
                    ON
                        sal.sal_autorización = auth.aut_id
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
                        se_salpais sal
                    ON 
                        dsal.dsal_sol_salida = sal.sal_id
                    WHERE dsal.dsal_situacion = 1";

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