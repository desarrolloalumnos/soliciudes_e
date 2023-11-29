<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use MVC\Router;

class DetalledpController{
    public static function estadistica(Router $router){
            $router->render('direccionpersonal/estadistica', []);
        
    }

    

    public static function detalleApi()
    {
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];
        $sql = "SELECT
                    SUM(CASE WHEN s.sol_situacion = 5 THEN 1 ELSE 0 END) AS autorizadas,
                    SUM(CASE WHEN s.sol_situacion = 6 THEN 1 ELSE 0 END) AS rechazadas,
                    SUM(CASE WHEN s.sol_situacion = 2 THEN 1 ELSE 0 END) AS enviadas
                FROM se_solicitudes s
                INNER JOIN se_solicitante ste ON s.sol_solicitante=ste.ste_id and ste.ste_situacion=1 and ste.ste_fecha is not null
                WHERE s.sol_situacion IN (5,2, 6) ";
        if ($fechaInicio != '' and $fechaFin != '') {
            $sql .= " AND cast(ste.ste_fecha as date) between '$fechaInicio' and '$fechaFin' ";
        } elseif ($fechaInicio != '') {
            $sql .= " AND cast(ste.ste_fecha as date) >= '$fechaInicio' ";
        } elseif ($fechaFin != '') {
            $sql .= " AND cast(ste.ste_fecha as date) <= '$fechaFin' ";
        }


        try {

            $productos = Solicitud::fetchArray($sql);

            echo json_encode($productos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function detalleConcurrenciaApi()
    {
     
        $sql = "SELECT
                            se_tipo_solicitud.tse_descripcion AS tipo,
                            COUNT(*) AS cantidad
                        FROM
                            se_solicitudes
                        INNER JOIN
                            se_solicitante ON se_solicitudes.sol_solicitante = se_solicitante.ste_id
                        INNER JOIN
                            se_tipo_solicitud ON se_solicitudes.sol_tipo = se_tipo_solicitud.tse_id
                        WHERE
                            se_solicitante.ste_fecha >= (CURRENT YEAR TO MONTH - 3 UNITS MONTH)
                        GROUP BY
                            tipo
                        ORDER BY
                            cantidad DESC";



        try {

            $productos = Solicitud::fetchArray($sql);

            echo json_encode($productos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function detalle2Api()
    {
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];
        $sql = "SELECT
                    m.tse_descripcion AS motivo,
                    COUNT(*) AS cantidad
                FROM se_solicitudes s
                INNER JOIN se_tipo_solicitud m ON s.sol_tipo = m.tse_id                
                INNER JOIN se_solicitante ste ON s.sol_solicitante=ste.ste_id and ste.ste_situacion=1
                WHERE s.sol_situacion = 1 ";


        if ($fechaInicio != '' and $fechaFin != '') {
            $sql .= " AND cast(ste.ste_fecha as date) between '$fechaInicio' and '$fechaFin' ";
        } elseif ($fechaInicio != '') {
            $sql .= " AND cast(ste.ste_fecha as date) >= '$fechaInicio' ";
        } elseif ($fechaFin != '') {
            $sql .= " AND cast(ste.ste_fecha as date) <= '$fechaFin' ";
        }

        $sql .= " GROUP BY m.tse_descripcion ";
        try {

            $productos = Solicitud::fetchArray($sql);

            echo json_encode($productos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function detallePaisesApi()
    {
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];
        $sql = "SELECT p.pai_desc_lg AS pais, COUNT(*) AS cantidad_visitas 
        FROM se_dsalpais s 
        INNER JOIN paises p ON s.dsal_pais = p.pai_codigo 
        INNER JOIN se_salpais ON dsal_sol_salida = sal_id 
        INNER JOIN se_autorizacion ON sal_autorizacion = aut_id 
        INNER JOIN se_solicitudes ON aut_solicitud = sol_id
        INNER JOIN se_solicitante ON sol_solicitante = ste_id
         WHERE sol_situacion >= 1 ";

                if ($fechaInicio != '' and $fechaFin != '') {
                    $sql .= " AND cast(ste.ste_fecha as date) between '$fechaInicio' and '$fechaFin' ";
                } elseif ($fechaInicio != '') {
                    $sql .= " AND cast(ste.ste_fecha as date) >= '$fechaInicio' ";

                } elseif ($fechaFin != '') {
                    $sql .= " AND cast(ste.ste_fecha as date) <= '$fechaFin' ";
                }

                $sql .= " GROUP BY pais ";
                $sql .= " ORDER BY cantidad_visitas DESC";

        try {

            $productos = Solicitud::fetchArray($sql);

            echo json_encode($productos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function detalleOficialApi()
    {
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];
        $sql = "SELECT 
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste_cat) || ' ' || 
                    (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = ste_cat) AS solicitante,
                    COUNT(*) AS cantidad
                FROM se_solicitudes  
                INNER JOIN se_solicitante ON sol_solicitante = ste_id ";
      
      if ($fechaInicio != '' and $fechaFin != '') {
        $sql .= " WHERE ste.ste_fecha between EXTEND('$fechaInicio', YEAR TO DAY) AND EXTEND('$fechaFin', YEAR TO DAY)";
      } elseif ($fechaInicio != '') {
        $sql .= " WHERE ste.ste_fecha >= EXTEND('$fechaInicio', YEAR TO DAY)";
      } elseif ($fechaFin != '') {
        $sql .= " WHERE ste.ste_fecha <= EXTEND('$fechaFin', YEAR TO DAY)";
      }
   
      $sql .= " GROUP BY solicitante ";
      $sql .= " ORDER BY cantidad DESC";
      
        try {

            $productos = Solicitud::fetchArray($sql);

            echo json_encode($productos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}