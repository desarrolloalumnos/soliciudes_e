<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use Model\Tiposolicitudes;
use MVC\Router;

class ReportesolController{

    public static function index(Router $router){
        $router->render('reportesolicitudes/index', []);
    }

    public static function index2(Router $router){
        $router->render('reporterechazadas/index', []);
    }

    public static function index3(Router $router){
        $router->render('reporteaprobadas/index', []);
    }

    public static function reporteSolicitudesAPI(){

        $sql = "SELECT ts.tse_descripcion AS tipo_solicitud, COUNT(s.sol_id) AS cantidad
                FROM se_tipo_solicitud ts
                LEFT JOIN se_solicitudes s ON ts.tse_id = s.sol_tipo
                GROUP BY ts.tse_descripcion;";

        try {
            $Solicitudes = Solicitud::fetchArray($sql);
            echo json_encode($Solicitudes);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function AprobadasAPI(){

        $sql = "SELECT ts.tse_descripcion AS tipo_solicitud, COUNT(s.sol_id) AS cantidad, 'APROBADAS' AS estado
                FROM se_tipo_solicitud ts
                LEFT JOIN se_solicitudes s ON ts.tse_id = s.sol_tipo AND s.sol_situacion = 1
                GROUP BY ts.tse_descripcion;";

        try {
            $SolicitudesAprobadas = Solicitud::fetchArray($sql);
            echo json_encode($SolicitudesAprobadas);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function RechazadasAPI(){

        $sql = "SELECT ts.tse_descripcion AS tipo_solicitud, COUNT(s.sol_id) AS cantidad, 'RECHAZADAS' AS estado
                FROM se_tipo_solicitud ts
                LEFT JOIN se_solicitudes s ON ts.tse_id = s.sol_tipo AND s.sol_situacion = 2
                GROUP BY ts.tse_descripcion;";

        try {
            $SolicitudesRechazadas = Solicitud::fetchArray($sql);
            echo json_encode($SolicitudesRechazadas);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}



