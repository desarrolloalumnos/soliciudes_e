<?php

namespace Controllers;

use Exception;
use Model\Articulos;
use Model\Autorizacion;
use Model\Dependencia;
use Model\Licenciatemporal;
use Model\Matrimonio;
use Model\Motivos;
use Model\Organizacion;
use Model\Paises;
use Model\ParejaCivil;
use Model\ParejaMilitar;
use Model\Pdf;
use Model\Personal;
use Model\Protocolo;
use Model\Protocolosol;
use Model\Saldetpaises;
use Model\Salidapais;
use Model\Solicitante;
use Model\Solicitud;
use Model\Tiposolicitud;
use Model\Transportes;
use MVC\Router;

class CasamientoController {
    public static function index(Router $router){
        $motivos = static::motivos();

        $router->render('casamientos/index', [
            'motivos' => $motivos
        ]);
    }


    public static function guardarApi(){
     
        try {
            $protocolo = new  Protocolo ($_POST);


            // echo json_encode($protocolo);
            // exit;
            $resultado = $protocolo->crear();

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
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogoApi() {
        $validarCatalogo = $_GET['per_catalogo'];
                              
        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo ";
        
                     
        try {
            $resultado = Personal::fetchArray($sql);
            echo json_encode($resultado);
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogo2Api() {
        $validarCatalogo2 = $_GET['per_catalogo'];          
        
               
        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo2 ";
        
                     
        try {
            $resultado = Personal::fetchArray($sql);
            echo json_encode($resultado);
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogo3Api() {
        $validarCatalogo3 = $_GET['per_catalogo'];          
        
               
        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo3";
        
                     
        try {
            $resultado = Personal::fetchArray($sql);
            echo json_encode($resultado);
            
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