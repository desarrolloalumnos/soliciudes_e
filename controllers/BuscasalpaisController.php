<?php

namespace Controllers;

use Exception;
use Model\Salidapais;
use MVC\Router;

class BuscasalpaisController{
    public static function index(Router $router){
        // $motivos = static::motivos();

        $router->render('busquedasalpais/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi(){

        $sql = "";

        try {
            $resultado = Salidapais::fetchArray($sql);
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