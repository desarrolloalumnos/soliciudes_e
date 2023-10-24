<?php

namespace Controllers;

use Exception;
use Model\Protocolo;
use Model\Dependencia;
use MVC\Router;

class CasamientoController {
    public static function index(Router $router){
        
        $router->render('casamientos/index', [
            
        ]);
    }

}