<?php

namespace Controllers;

use Exception;
use Model\Tiposolicitudes;
use MVC\Router;

class TiposolController{
    public static function index(Router $router)
    {
        $router->render('tiposol/index', []);
    }

    public static function guardarAPI()
    {
        try {
            $tiposolicitud = new Tiposolicitudes($_POST);
            $resultado = $tiposolicitud->crear();

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

    public static function modificarAPI()
    {
        try {
            $tiposolicitud = new Tiposolicitudes($_POST);
            $resultado = $tiposolicitud->actualizar();

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

    public static function eliminarAPI()
    {
        try {
            $tse_id = $_POST['tse_id'];
            $tiposolicitud = Tiposolicitudes::find($tse_id);
            $tiposolicitud->tse_situacion = 0;
            $resultado = $tiposolicitud->actualizar();

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

    public static function buscarAPI()
    {
        $tse_descripcion = $_GET['tse_descripcion'] ?? '';

        $sql = "SELECT * FROM se_tipo_solicitud WHERE tse_situacion = 1 ";
        if ($tse_descripcion != '') {
            $tse_descripcion = strtolower($tse_descripcion);
            $sql .= " AND LOWER(tse_descripcion) LIKE '%$tse_descripcion%' ";
        }

        try {
            $tiposolicitudes = Tiposolicitudes::fetchArray($sql);
            echo json_encode($tiposolicitudes);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}