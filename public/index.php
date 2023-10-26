<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProtocoloController;
use Controllers\ProtocolosolController;
use Controllers\CasamientoController;
use Controllers\MotivoController;
use Controllers\ArticuloController;
use Controllers\TransporteController;
use Controllers\TiposolController;



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

$router->get('/articulos', [ArticuloController::class,'index']);
$router->get('/API/articulos/buscar', [ArticuloController::class,'buscarApi']);
$router->post('/API/articulos/guardar', [ArticuloController::class,'guardarApi']);
$router->post('/API/articulos/modificar', [ArticuloController::class,'modificarApi']);
$router->post('/API/articulos/eliminar', [ArticuloController::class,'eliminarApi']);

$router->get('/transportes', [TransporteController::class,'index']);
$router->get('/API/transportes/buscar', [TransporteController::class,'buscarApi']);
$router->post('/API/transportes/guardar', [TransporteController::class,'guardarApi']);
$router->post('/API/transportes/modificar', [TransporteController::class,'modificarApi']);
$router->post('/API/transportes/eliminar', [TransporteController::class,'eliminarApi']);

$router->get('/tiposol', [TiposolController::class,'index']);
$router->get('/API/tiposol/buscar', [TiposolController::class,'buscarApi']);
$router->post('/API/tiposol/guardar', [TiposolController::class,'guardarApi']);
$router->post('/API/tiposol/modificar', [TiposolController::class,'modificarApi']);
$router->post('/API/tiposol/eliminar', [TiposolController::class,'eliminarApi']);


$router->get('/casamientos', [CasamientoController::class,'index']);
$router->get('/API/casamientos/buscarCatalogo', [CasamientoController::class,'buscarCatalogoApi']);
$router->get('/API/casamientos/buscarCatalogo2', [CasamientoController::class,'buscarCatalogo2Api']);
$router->get('/API/casamientos/buscarCatalogo3', [CasamientoController::class,'buscarCatalogo3Api']);

$router->get('/protocolosol', [ProtocolosolController::class,'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
