<?php

namespace Controllers;

use Exception;
use Model\Motivo;
use Model\Autorizacion;
use Model\Protocolo;
use Model\Pdf;
use Model\Personal;
use Model\Motivos;
use Model\Solicitante;
use Model\Solicitud;
use MVC\Router;

class ProtocolosolController {
    public static function index(Router $router){
        $motivos = static::motivos();

        $router->render('protocolosol/index', [
            'motivos' => $motivos
        ]);
    }

    public static function buscarCatalogoApi() {
        $validarCatalogo = $_GET['per_catalogo'];
        
        $sql = " select  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo";
             
        try {
            $motivos = Personal::fetchArray($sql);
            echo json_encode($motivos);
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function motivos()
    {
        $sql = "SELECT * FROM se_motivos where mot_situacion = 1";
        
        try {
            
            $motivos = Motivos::fetchArray($sql);
 
            if ($motivos){
                
                return $motivos; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }





}