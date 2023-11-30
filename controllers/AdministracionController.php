<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use Model\Motivos;
use Model\Paises;
use Model\Transportes;
use Model\Protocolo;
use Model\Protocolosol;
use MVC\Router;

class AdministracionController
{
    public static function index(Router $router)
    {
        $motivos = static::motivos();
        $paises = static::paises();
        $combo = static::Protocolo();
        $transportes = static::transportes();
       
        
        $router->render('administraciones/index', [
            'motivos' => $motivos,
            'paises' => $paises,
            'combos' => $combo,
            'transportes' => $transportes
        ]);
    }

    public static function direccionGeneral(Router $router)
    {
        
        $router->render('administraciones/direcciongeneral', [
            
        ]);
    }

    public static function buscarApi()
    {
        $catalogo = $_GET['catalogo'];
        $fecha = $_GET['fecha'];
        $estado = $_GET['estado'];
        $tipo = $_GET['tipo'];

        $sql = "SELECT
                    s.sol_id,
                    ste.ste_id,
                    t.tse_id,
                    ste.ste_cat,
                    s.sol_tipo,
                    pdf_id,
                    pdf_solicitud,
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste.ste_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = ste.ste_cat) AS solicitante,
                    ste.ste_telefono,
                    t.tse_descripcion AS tipo,
                    m.mot_descripcion AS motivo,
                    (select dep_desc_lg from mper, morg, mdep where per_plaza = org_plaza and org_dependencia = dep_llave and per_catalogo = ste.ste_cat) as dependencia_solicitante,
                    s.sol_situacion    
                FROM se_solicitudes s
                INNER JOIN se_tipo_solicitud t  ON s.sol_tipo = t.tse_id
                INNER JOIN se_motivos m  ON s.sol_motivo = m.mot_id
                INNER JOIN se_solicitante ste  ON s.sol_solicitante = ste.ste_id
                INNER JOIN se_pdf ON pdf_solicitud = s.sol_id
                WHERE s.sol_situacion >= 1 
                AND ste_comando = (select org_dependencia from mper inner join morg on per_plaza = org_plaza where per_catalogo = user)";
                

                if ($fecha != '') {
                    $sql .= " AND cast(ste_fecha as date) = '$fecha' ";
                }
                if ($catalogo != '') {
                    $sql .= " AND ste_cat = '$catalogo' ";
                }
                if ($estado != '') {
                    $sql .= " AND sol_situacion = '$estado' ";
                }
                if ($tipo != '') {
                    $sql .= " AND tse_id = '$tipo' ";
                }
                $sql.=" AND ste.ste_fecha BETWEEN (CURRENT YEAR TO MONTH) - 2 UNITS MONTH AND CURRENT";
                $sql.=" ORDER BY ste_fecha DESC ";


        try {
            $resultado = Solicitud::fetchArray($sql);
            echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    
    public static function buscarDireccionApi()
    {
        $catalogo = $_GET['catalogo'];
        $fecha = $_GET['fecha'];
        $tipo = $_GET['tipo'];

        $sql = "SELECT
                    s.sol_id,
                    ste.ste_id,
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste.ste_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = ste.ste_cat) AS solicitante,
                    ste.ste_telefono,
                    t.tse_descripcion AS tipo,
                    m.mot_descripcion AS motivo,
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                    FROM mper 
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = aut.aut_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                    FROM mper 
                    WHERE per_catalogo = aut.aut_cat) AS autorizador,
                    s.sol_situacion    
                FROM se_solicitudes s
                INNER JOIN se_tipo_solicitud t  ON s.sol_tipo = t.tse_id
                INNER JOIN se_motivos m  ON s.sol_motivo = m.mot_id
                INNER JOIN se_solicitante ste  ON s.sol_solicitante = ste.ste_id
                INNER JOIN se_autorizacion aut ON aut.aut_solicitud = s.sol_id
                WHERE s.sol_situacion = 2";
                 if ($fecha != '') {
                    $sql .= " AND cast(ste_fecha as date) = '$fecha' ";
                }
                if ($catalogo != '') {
                    $sql .= " AND ste_cat = '$catalogo' ";
                }
                if ($tipo != '') {
                    $sql .= " AND tse_id = '$tipo' ";
                }

                $sql.=" ORDER BY ste_fecha DESC ";

        try {
            $resultado = Solicitud::fetchArray($sql);
            echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function enviarEmdnApi() {
        try {
            $solicitud_id = $_POST['sol_id'];
            $solicitud = Solicitud::find($solicitud_id);
            $solicitud->sol_situacion = 3;
            $resultado = $solicitud->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Solicitud enviada correctamente',
                    'codigo' => 1
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

    public static function enviarDgaApi() {
        try {
         
            $solicitud_id = $_POST['sol_id'];
            $solicitud = Solicitud::find($solicitud_id);
            $solicitud->sol_situacion = 2;
            $resultado = $solicitud->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Solicitud enviada correctamente',
                    'codigo' => 1
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

    public static function transportes()
    {
        $sql = "SELECT * FROM se_transporte WHERE transporte_situacion = 1";

        try {
            $transportes = Transportes::fetchArray($sql);

            if ($transportes) {
                return $transportes;
            } else {
                return 0;
            }
        } catch (Exception $e) {
        }
    }
    public static function paises()
    {
        $sql = "SELECT * FROM paises";

        try {
            $paises = Paises::fetchArray($sql);

            if ($paises) {
                return $paises;
            } else {
                return 0;
            }
        } catch (Exception $e) {
        }
    }
    public static function motivos()
    {
        $sql = "SELECT * FROM se_motivos where mot_situacion = 1";

        try {

            $motivos = Motivos::fetchArray($sql);

            if ($motivos) {

                return $motivos;
            } else {
                return 0;
            }
        } catch (Exception $e) {
        }
    }
    public static function Protocolo(){
        $sql = "SELECT 
        cmv_id,
        c.cmv_tip || ' - ' || m.dep_desc_lg AS tipo
    FROM 
        se_protocolo p
    JOIN 
        se_combos_marimbas_vallas c ON p.pco_cmbv = c.cmv_id
    JOIN 
        mdep m ON c.cmv_dependencia = m.dep_llave
    WHERE 
        c.cmv_situacion = 1";
    
        try {
            $combosMarimbasVallas = Protocolo::fetchArray($sql);
    
            if ($combosMarimbasVallas){
                return $combosMarimbasVallas;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }

    public static function buscarModalEventoApi(){

        $id = $_GET['id'];
        $sql = " SELECT
        ste_id,
        pco_id,
        pco_autorizacion,
        ste_cat,
        gra_desc_lg,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombre,
        ste_fecha,
        ste_telefono,
        cmv_id,
        pco_fechainicio,
        sol_motivo,
        sol_obs,
        pco_just,
        pco_fechafin,
        pco_dir,
        pdf_ruta
        FROM se_protocolo
        INNER JOIN se_combos_marimbas_vallas ON pco_cmbv = cmv_id  
        inner join mdep on cmv_dependencia = dep_llave
        inner join se_autorizacion on aut_id = pco_autorizacion
        inner join se_solicitudes on aut_solicitud = sol_id
        inner join se_solicitante on sol_solicitante= ste_id
        inner join mper on ste_cat = per_catalogo
        inner join se_pdf on pdf_solicitud = sol_id
        inner join grados on ste_gra = gra_codigo
        WHERE pco_situacion = 1  AND sol_id = $id";


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

    public static function buscarCalender()
    {

        try {
            $sql = "   SELECT 
            cmv_tip || ' - ' || dep_desc_lg AS title,
            pco_fechainicio AS start,
            pco_fechafin AS end,
            pco_dir AS lugar,
            sol_id
        FROM 
            se_protocolo p
        INNER JOIN 
            se_combos_marimbas_vallas c ON pco_cmbv = cmv_id
        INNER JOIN 
            mdep m ON cmv_dependencia = dep_llave
        INNER JOIN se_autorizacion ON pco_autorizacion = aut_id
        INNER JOIN se_solicitudes ON aut_solicitud = sol_id 
        WHERE 
            sol_situacion = 5";


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