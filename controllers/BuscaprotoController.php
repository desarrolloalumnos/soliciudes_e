<?php

namespace Controllers;

use Exception;
use Model\Protocolosol;
use MVC\Router;

class BuscaprotoController{
    public static function index(Router $router){
        // $motivos = static::motivos();

        $router->render('busquedasproto/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi(){

        $sql = "";

        try {
            $resultado = Protocolosol::fetchArray($sql);
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