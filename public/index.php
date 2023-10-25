<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProtocoloController;
use Controllers\CasamientoController;
use Controllers\MotivoController;


$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/protocolos', [ProtocoloController::class,'index']);
$router->get('/API/protocolos/buscar', [ProtocoloController::class,'buscarApi']);
$router->post('/API/protocolos/guardar', [ProtocoloController::class,'guardarApi']);
$router->post('/API/protocolos/modificar', [ProtocoloController::class,'modificarApi']);
$router->post('/API/protocolos/eliminar', [ProtocoloController::class,'eliminarApi']);


$router->get('/motivos', [MotivoController::class,'index']);
$router->get('/API/motivos/buscar', [MotivoController::class,'buscarApi']);
$router->post('/API/motivos/guardar', [MotivoController::class,'guardarApi']);
$router->post('/API/motivos/modificar', [MotivoController::class,'modificarApi']);
$router->post('/API/motivos/eliminar', [MotivoController::class,'eliminarApi']);





$router->get('/casamientos', [CasamientoController::class,'index']);
$router->get('/API/casamientos/buscarCatalogo', [CasamientoController::class,'buscarCatalogoApi']);
$router->get('/API/casamientos/buscarCatalogo2', [CasamientoController::class,'buscarCatalogo2Api']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
