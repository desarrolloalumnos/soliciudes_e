<?php

namespace Controllers;

use Exception;
use Model\Transportes;
use MVC\Router;

class TransporteController {
    public static function index(Router $router) {
        $router->render('transportes/index', []);
    }

    public static function guardarAPI() {
        try {
            $transporte = new Transportes($_POST);
            $resultado = $transporte->crear();

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
            $transporte = new Transportes($_POST);
            $resultado = $transporte->actualizar();

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
            $transporte_id = $_POST['transporte_id'];
            $transporte = Transportes::find($transporte_id);
            $transporte->transporte_situacion = 0;
            $resultado = $transporte->actualizar();

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
        $transporte_descripcion = $_GET['transporte_descripcion'] ?? '';

        $sql = "SELECT * FROM se_transporte WHERE transporte_situacion = 1 ";
        if ($transporte_descripcion != '') {
            $transporte_descripcion = strtolower($transporte_descripcion);
            $sql .= " AND LOWER(transporte_descripcion) LIKE '%$transporte_descripcion%' ";
        }

        try {
            $transportes = Transportes::fetchArray($sql);
            echo json_encode($transportes);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}