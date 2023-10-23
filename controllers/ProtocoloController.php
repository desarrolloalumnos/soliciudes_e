<?php

namespace Controllers;

use Exception;
use Model\Protocolo;
use Model\Dependencia;
use MVC\Router;

class ProtocoloController {
    public static function index(Router $router){
        $dependencias = static::dependencias();
        $router->render('protocolos/index', [
            'dependencias' => $dependencias
        ]);
    }



    public static function dependencias()
    {
        $sql = "SELECT dep_llave, dep_desc_md FROM mdep";
        
        
        
        try {
            
            $dependencias = Dependencia::fetchArray($sql);
 
            if ($dependencias){
                
                return $dependencias; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
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


 public static function buscarAPI() {
        $cmv_dependencia = $_GET['cmv_dependencia'];
        $cmv_tip = $_GET['cmv_tip'];
        
        
        
        $sql = " SELECT 
                        se_combos_marimbas_vallas.cmv_id,
                        mdep.dep_desc_md AS cmv_dependencia,
                        mdep.dep_llave,
                        se_combos_marimbas_vallas.cmv_tip,
                        se_combos_marimbas_vallas.cmv_situacion
                FROM se_combos_marimbas_vallas
                JOIN mdep ON se_combos_marimbas_vallas.cmv_dependencia = mdep.dep_llave WHERE cmv_situacion = 1";
        
        if ($cmv_dependencia != 0) {           
            $sql .= " AND cmv_dependencia = $cmv_dependencia ";
        }
        
        if ($cmv_tip != 'undefined') {           
            $sql .= " AND cmv_tip LIKE '%$cmv_tip%' ";
        }

 

   
        try {
            $protocolos = Protocolo::fetchArray($sql);
            echo json_encode($protocolos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function modificarAPI()
    {
        try {
            $protocolo = new Protocolo($_POST);
       
         
            $resultado = $protocolo->actualizar();
            
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI()
    {
        try {
            $cmv_id = $_POST['cmv_id'];
         
            $protocolo = Protocolo::find($cmv_id);
            $protocolo->cmv_situacion = 0;
            $resultado = $protocolo->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
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
 }