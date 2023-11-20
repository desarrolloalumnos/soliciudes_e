<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use MVC\Router;

class DetalleController
{
    public static function estadistica(Router $router)
    {
        $router->render('administraciones/estadistica', []);

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
}