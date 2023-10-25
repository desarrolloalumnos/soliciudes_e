<?php

namespace Controllers;

use Exception;
use Model\Articulos;
use MVC\Router;

class ArticuloController {
    public static function index(Router $router) {
        $router->render('articulos/index', []);
    }

    public static function guardarAPI() {
        try {
            $articulo = new Articulos($_POST);
            $resultado = $articulo->crear();

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
            $articulo = new Articulos($_POST);
            $resultado = $articulo->actualizar();

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
        }catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI() {
        try {
            $articulo_id = $_POST['art_id'];
            $articulo = Articulos::find($articulo_id);
            $articulo->art_situacion = 0;
            $resultado = $articulo->actualizar();

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
        $art_descripcion = $_GET['art_descripcion'] ?? '';

        $sql = "SELECT * FROM se_articulos WHERE art_situacion = 1 ";
        if ($art_descripcion != '') {
            $art_descripcion = strtolower($art_descripcion);
            $sql .= " AND LOWER(art_descripcion) LIKE '%$art_descripcion%' ";
        }

        try {
            $articulos = Articulos::fetchArray($sql);
            echo json_encode($articulos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
