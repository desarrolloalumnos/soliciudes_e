<?php 
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AdministracionController;
use Controllers\BuscalictController;
use Controllers\LoginController;
use Controllers\AppController;
use Controllers\ProtocoloController;
use Controllers\ProtocolosolController;
use Controllers\CasamientoController;
use Controllers\MotivoController;
use Controllers\ArticuloController;
use Controllers\TransporteController;
use Controllers\TiposolController;
use Controllers\BuscasController;
use Controllers\HistorialController;
use Controllers\HistorialdpController;
use Controllers\HistorialmdnController;
use Controllers\LictempController;
use Controllers\SalidapaisController;
use Controllers\DetalleController;
use Controllers\DetalledpController;
use Controllers\DetallemdnController;
use Controllers\BuscasalpaisController;
use Controllers\BuscaprotoController;
use Controllers\DireccionpersonalController;
use Controllers\ReporteController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [LoginController::class,'index']);
$router->post('/API/login', [LoginController::class,'login']);
$router->get('/logout', [LoginController::class,'logout']);


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
$router->get('/API/busquedasc/buscarModal', [BuscasController::class,'buscarModalApi']);
$router->post('/API/busquedasc/modificar', [BuscasController::class,'modificarApi']);
$router->post('/API/busquedasc/modificarPdf', [BuscasController::class,'modificarPdfApi']);
$router->post('/API/busquedasc/eliminar', [BuscasController::class,'eliminarApi']);
$router->post('/API/busquedasc/corregir', [BuscasController::class,'corregirApi']);
$router->get('/API/busquedasc/pdf', [BuscasController::class,'VerPdf']);


$router->get('/licencias', [LictempController::class,'index']);
$router->get('/API/licencias/buscarCatalogo', [LictempController::class,'buscarCatalogoApi']);
$router->get('/API/licencias/buscarTiempo', [LictempController::class,'buscarTiempoApi']);
$router->get('/API/licencias/buscarCatalogo2', [LictempController::class,'buscarCatalogo2Api']);
$router->post('/API/licencias/guardar', [LictempController::class,'guardarApi']);


$router->get('/busquedaslict', [BuscalictController::class,'index']);
$router->get('/API/busquedaslict/buscar', [BuscalictController::class,'buscarApi']);
$router->get('/API/busquedaslict/buscarModal', [BuscalictController::class,'buscarModalApi']);
$router->post('/API/busquedaslict/modificar', [BuscalictController::class,'modificarApi']);
$router->post('/API/busquedaslict/modificarPdf', [BuscalictController::class,'modificarPdfApi']);
$router->post('/API/busquedaslict/eliminar', [BuscalictController::class,'eliminarApi']);
$router->get('/API/busquedaslict/pdf', [BuscalictController::class,'VerPdf']);


$router->get('/busquedasalpais', [BuscasalpaisController::class,'index']);
$router->get('/API/busquedasalpais/buscar', [BuscasalpaisController::class,'buscarApi']);
$router->get('/API/busquedasalpais/buscarModal', [BuscasalpaisController::class,'buscarModalApi']);
$router->post('/API/busquedasalpais/modificar', [BuscasalpaisController::class,'modificarApi']);
$router->post('/API/busquedasalpais/modificarPdf', [BuscasalpaisController::class,'modificarPdfApi']);
$router->post('/API/busquedasalpais/eliminar', [BuscasalpaisController::class,'eliminarApi']);
$router->get('/API/busquedasalpais/pdf', [BuscasalpaisController::class,'VerPdf']);


$router->get('/busquedasproto', [BuscaprotoController::class,'index']);
$router->get('/API/busquedasproto/buscar', [BuscaprotoController::class,'buscarApi']);
$router->get('/API/busquedasproto/buscarModal', [BuscaprotoController::class,'buscarModalApi']);
$router->get('/API/busquedasproto/buscarCalender', [BuscaprotoController::class,'buscarCalender']);
$router->get('/API/busquedasproto/buscarEventos', [BuscaprotoController::class,'buscarEventos']);
$router->post('/API/busquedasproto/modificar', [BuscaprotoController::class,'modificarApi']);
$router->post('/API/busquedasproto/modificarPdf', [BuscaprotoController::class,'modificarPdfApi']);
$router->post('/API/busquedasproto/eliminar', [BuscaprotoController::class,'eliminarApi']);
$router->get('/API/busquedasproto/pdf', [BuscaprotoController::class,'VerPdf']);


$router->get('/protocolosol', [ProtocolosolController::class,'index']);
$router->get('/API/protocolosol/buscar', [ProtocolosolController::class,'buscarApi']);
$router->get('/API/protocolosol/buscarCatalogo', [ProtocolosolController::class,'buscarCatalogoApi']);
$router->get('/API/protocolosol/buscarCatalogo', [ProtocolosolController::class,'buscarCatalogo2Api']);
$router->post('/API/protocolosol/guardar', [ProtocolosolController::class,'guardarApi']);


$router->get('/salidapaises', [SalidapaisController::class,'index']);
$router->get('/API/salidapaises/buscar', [SalidapaisController::class,'buscarApi']);
$router->get('/API/salidapaises/buscarCatalogo', [SalidapaisController::class,'buscarCatalogoApi']);
$router->get('/API/salidapaises/buscarCatalogo2', [SalidapaisController::class,'buscarCatalogo2Api']);
$router->post('/API/salidapaises/guardar', [SalidapaisController::class,'guardarApi']);


$router->get('/administraciones', [AdministracionController::class,'index']);
$router->get('/API/administraciones/buscar', [AdministracionController::class,'buscarApi']);
$router->get('/API/administraciones/buscarDireccion', [AdministracionController::class,'buscarDireccionApi']);
$router->post('/API/administraciones/enviarEmdn', [AdministracionController::class,'enviarEmdnApi']);
$router->post('/API/administraciones/enviarDga', [AdministracionController::class,'enviarDgaApi']);
$router->get('/administraciones/direcciongeneral', [AdministracionController::class,'direccionGeneral']);


$router->get('/direccionpersonal', [DireccionpersonalController::class,'index']);
$router->get('/API/direccionpersonal/buscar', [DireccionpersonalController::class,'buscarApi']);
$router->post('/API/direccionpersonal/enviarMdn', [DireccionpersonalController::class,'enviarMdnApi']);
$router->get('/direccionpersonal/mdn', [DireccionpersonalController::class,'mdn']);
$router->get('/API/direccionpersonal/buscarMdn', [DireccionpersonalController::class,'buscarMdnApi']);
$router->post('/API/direccionpersonal/guardarAutorizador', [DireccionpersonalController::class,'guardarAtorizacionDirPerApi']);
$router->post('/API/direccionpersonal/guardarAutorizadorCorreccion', [DireccionpersonalController::class,'guardarCorreccionDirPerApi']);
$router->post('/API/direccionpersonal/guardarAtorizacionMdn', [DireccionpersonalController::class,'guardarAtorizacionMdnApi']);
$router->post('/API/direccionpersonal/guardaRechazarMdn', [DireccionpersonalController::class,'guardaRechazarMdnApi']);




$router->get('/historiales', [HistorialController::class,'index']);
$router->get('/API/historiales/buscar', [HistorialController::class,'buscarApi']);


$router->get('/historialdp', [HistorialdpController::class,'index']);
$router->get('/API/historialdp/buscar', [HistorialdpController::class,'buscarApi']);


$router->get('/historialmdn', [HistorialmdnController::class,'index']);
$router->get('/API/historialmdn/buscar', [HistorialmdnController::class,'buscarApi']);


$router->get('/administraciones/estadistica', [DetalleController::class,'estadistica']);
$router->get('/API/administraciones/estadistica', [DetalleController::class,'detalleApi']);
$router->get('/API/administraciones/estadistica2', [DetalleController::class,'detalle2Api']);


$router->get('/direccionpersonal/estadistica', [DetalledpController::class,'estadistica']);
$router->get('/API/direccionpersonal/estadistica', [DetalledpController::class,'detalleApi']);
$router->get('/API/direccionpersonal/estadistica2', [DetalledpController::class,'detalle2Api']);


$router->get('/mdn/estadistica', [DetallemdnController::class,'estadistica']);
$router->get('/API/mdn/estadistica', [DetallemdnController::class,'detalleApi']);
$router->get('/API/mdn/estadistica2', [DetallemdnController::class,'detalle2Api']);

$router->get('/pdf', [ReporteController::class,'pdf']);
$router->get('/pdf/buscar', [ReporteController::class,'pdf']);
$router->get('/pdf/pdfMinisterio', [ReporteController::class,'pdfMinisterio']);
$router->get('/pdf/pdfMatrimonio', [ReporteController::class,'pdfMatrimonio']);
$router->get('/pdf/pdfLicenciaTemporal', [ReporteController::class,'pdfLicenciaTemporal']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
