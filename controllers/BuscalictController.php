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



        $sql = " SELECT 
                    lit.lit_id,
                    TRIM(per.per_nom1) || ' ' || TRIM(per.per_nom2) || ' ' || TRIM(per.per_ape1) || ' ' || TRIM(per.per_ape2) AS nombres_solicitante,
                    TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) AS grado_solicitante,
                    tiempos.t_oficial AS tiempo,
                    sol.sol_id,
                    sol.sol_solicitante,
                    ste.ste_id,
                    ste.ste_cat,
                    ste.ste_telefono,
                    sol.sol_obs,
                    sol.sol_motivo,
                    mot.mot_id,
                    sol.sol_situacion,
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
                    lit.lit_situacion = 1 ";

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
