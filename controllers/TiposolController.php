<?php

namespace Controllers;

use Exception;
use Model\TipoSolicitudes;
use MVC\Router;

class TiposolController {
    public static function index(Router $router) {
        $router->render('tiposol/index', []);
    }

    public static function guardarAPI() {
        try {
            $tipoSolicitud = new TipoSolicitudes($_POST);
            $resultado = $tipoSolicitud->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarAPI() {
        try {
            $tipoSolicitud = new TipoSolicitudes($_POST);
            $resultado = $tipoSolicitud->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI() {
        try {
            $tipoSolicitud_id = $_POST['tse_id'];
            $tipoSolicitud = TipoSolicitudes::find($tipoSolicitud_id);
            $tipoSolicitud->tse_situacion = 0;
            $resultado = $tipoSolicitud->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarAPI() {
        $tipoSolicitud_descripcion = $_GET['tse_descripcion'] ?? '';

        $sql = "SELECT * FROM se_tipo_solicitud WHERE tse_situacion = 1 ";
        if ($tipoSolicitud_descripcion != '') {
            $tipoSolicitud_descripcion = strtolower($tipoSolicitud_descripcion);
            $sql .= " AND LOWER(tse_descripcion) LIKE '%$tipoSolicitud_descripcion%' ";
        }

        try {
            $tipoSolicitudes = TipoSolicitudes::fetchArray($sql);
            echo json_encode($tipoSolicitudes);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
