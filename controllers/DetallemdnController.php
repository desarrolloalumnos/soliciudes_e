<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use MVC\Router;

class DetallemdnController{
    public static function estadistica(Router $router){
            $router->render('mdn/estadistica', []);
        
    }

    
    public static function detalleApi()
    {

        $sql = "SELECT
                    SUM(CASE WHEN s.sol_situacion = 5 THEN 1 ELSE 0 END) AS autorizadas,
                    SUM(CASE WHEN s.sol_situacion = 6 THEN 1 ELSE 0 END) AS rechazadas
                FROM se_solicitudes s
                WHERE s.sol_situacion IN (5, 6) ";

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

        $sql = "SELECT
                    m.tse_descripcion AS motivo,
                    COUNT(*) AS cantidad
                FROM se_solicitudes s
                INNER JOIN se_tipo_solicitud m ON s.sol_tipo = m.tse_id
                WHERE s.sol_situacion = 1
                GROUP BY m.tse_descripcion ";

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