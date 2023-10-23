<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProtocoloController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/protocolos', [ProtocoloController::class,'index']);
$router->get('/API/protocolos/buscar', [ProtocoloController::class,'buscarApi']);
$router->post('/API/protocolos/guardar', [ProtocoloController::class,'guardarApi']);
$router->post('/API/protocolos/modificar', [ProtocoloController::class,'modificarApi']);
$router->post('/API/protocolos/eliminar', [ProtocoloController::class,'eliminarApi']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
