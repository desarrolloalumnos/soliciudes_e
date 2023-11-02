<?php 
require_once __DIR__ . '/../includes/app.php';


use Controllers\BuscalictController;
use MVC\Router;
use Controllers\AppController;
use Controllers\ProtocoloController;
use Controllers\ProtocolosolController;
use Controllers\CasamientoController;
use Controllers\MotivoController;
use Controllers\ArticuloController;
use Controllers\TransporteController;
use Controllers\TiposolController;
use Controllers\BuscasController;
use Controllers\LictempController;

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
$router->post('/API/casamientos/guardar', [CasamientoController::class,'guardarApi']);

$router->get('/busquedasc', [BuscasController::class,'index']);
$router->get('/API/busquedasc/buscar', [BuscasController::class,'buscarApi']);
$router->post('/API/busquedasc/enviar', [BuscasController::class,'enviarApi']);

$router->get('/licencias', [LictempController::class,'index']);
$router->get('/API/licencias/buscarCatalogo', [LictempController::class,'buscarCatalogoApi']);
$router->get('/API/licencias/buscarTiempo', [LictempController::class,'buscarTiempoApi']);
$router->get('/API/licencias/buscarCatalogo2', [LictempController::class,'buscarCatalogo2Api']);
$router->post('/API/licencias/guardar', [LictempController::class,'guardarApi']);

$router->get('/busquedaslict', [BuscalictController::class,'index']);
$router->get('/API/busquedaslict/buscar', [BuscalictController::class,'buscarApi']);

$router->get('/protocolosol', [ProtocolosolController::class,'index']);
$router->get('/API/protocolosol/buscar', [ProtocolosolController::class,'buscarApi']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
