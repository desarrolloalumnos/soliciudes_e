<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use MVC\Router;

class HistorialController
{
    public static function index(Router $router)
    {
        

        $router->render('historiales/index', [
           
        ]);
    }

    public static function buscarApi()
    {
        $catalogo = $_GET['catalogo'];
        $fecha = $_GET['fecha'];
        $estado = $_GET['estado'];
        $tipo = $_GET['tipo'];


        $sql = " SELECT 
        s.sol_id,
        TRIM(grados_solicitante.gra_desc_md) || ' DE ' || TRIM(armas_solicitante.arm_desc_md) ||
        ' ' || TRIM(per_solicitante.per_nom1) || ' ' || TRIM(per_solicitante.per_nom2) || ' ' ||
        TRIM(per_solicitante.per_ape1) || ' ' || TRIM(per_solicitante.per_ape2) AS solicitante,
        ste.ste_telefono,
        t.tse_descripcion AS tipo,
        m.mot_descripcion AS motivo,
        TRIM(grados_autorizador.gra_desc_md) || ' DE ' || TRIM(armas_autorizador.arm_desc_md) ||
        ' ' || TRIM(per_autorizador.per_nom1) || ' ' || TRIM(per_autorizador.per_nom2) || ' ' ||
        TRIM(per_autorizador.per_ape1) || ' ' || TRIM(per_autorizador.per_ape2) AS autorizador,
        s.sol_situacion
    FROM
        se_solicitudes s
    INNER JOIN se_tipo_solicitud t ON s.sol_tipo = t.tse_id
    INNER JOIN se_motivos m ON s.sol_motivo = m.mot_id
    INNER JOIN se_solicitante ste ON s.sol_solicitante = ste.ste_id
    INNER JOIN se_autorizacion aut ON aut.aut_solicitud = s.sol_id
    INNER JOIN mper per_solicitante ON per_solicitante.per_catalogo = ste.ste_cat
    INNER JOIN grados grados_solicitante ON per_solicitante.per_grado = grados_solicitante.gra_codigo
    INNER JOIN armas armas_solicitante ON per_solicitante.per_arma = armas_solicitante.arm_codigo
    INNER  JOIN mper per_autorizador ON per_autorizador.per_catalogo = aut.aut_cat
    INNER JOIN grados grados_autorizador ON per_autorizador.per_grado = grados_autorizador.gra_codigo
    INNER  JOIN armas armas_autorizador ON per_autorizador.per_arma = armas_autorizador.arm_codigo
    WHERE
        s.sol_situacion IN (5,6) and aut.aut_situacion IN (5,6)";
        
    if ($fecha != '') {
        $sql .= " AND cast(ste_fecha as date) = '$fecha' ";
    }
    if ($catalogo != '') {
        $sql .= " AND ste_cat = '$catalogo' ";
    }
    if ($estado != '') {
        $sql .= " AND sol_situacion = '$estado' ";
    }
    if ($tipo != '') {
        $sql .= " AND tse_id = '$tipo' ";
    }
    $sql.=" AND ste.ste_fecha BETWEEN (CURRENT YEAR TO MONTH) - 2 UNITS MONTH AND CURRENT";
    $sql .= " ORDER BY ste_fecha DESC ";


        try {
            $resultado = Solicitud::fetchArray($sql);
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
