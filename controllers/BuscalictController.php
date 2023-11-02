<?php

namespace Controllers;

use Exception;
use Model\Licenciatemporal;
use MVC\Router;

class BuscalictController
{
    public static function index(Router $router)
    {
        // $motivos = static::motivos();

        $router->render('busquedaslict/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi()
    {
        // $cmv_dependencia = $_GET['cmv_dependencia'];
        // $cmv_tip = $_GET['cmv_tip'];



        $sql = "SELECT 
                    lit.lit_id,    
                    (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = ste.ste_cat) AS nombres_solicitante,
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste.ste_cat) AS grado_solicitante,
                    lit.lit_autorizacion,
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
                    lit.lit_mes_consueldo,
                    lit.lit_mes_sinsueldo,
                    lit.lit_fecha1,
                    lit.lit_fecha2,
                    lit.lit_articulo,
                    art.art_id,
                    lit.lit_situacion
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
                    se_motivos  mot
                ON 
                    sol.sol_motivo = mot.mot_id
                LEFT JOIN
                    se_solicitante  ste
                ON 
                    sol.sol_solicitante = ste.ste_id
             
                LEFT JOIN
                    se_articulos art
                ON 
                    lit.lit_articulo = art.art_id
                WHERE lit.lit_situacion = 1";

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
}
