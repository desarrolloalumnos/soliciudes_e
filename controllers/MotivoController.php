<?php

namespace Controllers;

use Exception;
use Model\Motivos;
use MVC\Router;

class MotivoController{
    public static function index(Router $router)
    {
        $router->render('motivos/index', []);
    }

    public static function guardarAPI()
    {
        try {
            $motivo = new Motivos($_POST);
            $resultado = $motivo->crear();

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
            $motivo = new Motivos($_POST);
            $resultado = $motivo->actualizar();

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
            $motivo_id = $_POST['mot_id'];
            $motivo = Motivos::find($motivo_id);
            $motivo->mot_situacion = 0;
            $resultado = $motivo->actualizar();

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
        $motivo_descripcion = $_GET['mot_descripcion'] ?? '';

        $sql = "SELECT * FROM se_motivos WHERE mot_situacion = 1 ";
        if ($motivo_descripcion != '') {
            $motivo_descripcion = strtolower($motivo_descripcion);
            $sql .= " AND LOWER(mot_descripcion) LIKE '%$motivo_descripcion%' ";
        }

        try {
            $motivos = Motivos::fetchArray($sql);
            echo json_encode($motivos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
