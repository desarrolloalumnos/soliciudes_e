<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use Model\Paises;
use Model\Transportes;
use Model\Motivos;
use Model\Protocolo;
use MVC\Router;

class DireccionpersonalController
{
    public static function index(Router $router)
    {
        $motivos = static::motivos();
        $paises = static::paises();
        $combo = static::Protocolo();
        $transportes = static::transportes();
        $router->render('direccionpersonal/index', [
            'motivos' => $motivos,
            'paises' => $paises,
            'combos' => $combo,
            'transportes' => $transportes
        ]);
    }

    public static function mdn(Router $router)
    {

        $router->render('direccionpersonal/mdn', []);
    }
    public static function buscarApi()
    {

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
                    (select dep_desc_lg from mper, morg, mdep where per_plaza = org_plaza and org_dependencia = dep_llave and per_catalogo = ste.ste_cat) as dependencia_solicitante,
                    s.sol_situacion    
                FROM se_solicitudes s
                INNER JOIN se_tipo_solicitud t  ON s.sol_tipo = t.tse_id
                INNER JOIN se_motivos m  ON s.sol_motivo = m.mot_id
                INNER JOIN se_solicitante ste  ON s.sol_solicitante = ste.ste_id
                INNER JOIN se_autorizacion aut ON aut.aut_solicitud = s.sol_id
                WHERE s.sol_situacion = 3";

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

    public static function buscarMdnApi()
    {
        $sql = "SELECT
                        s.sol_id,
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
                    JOIN se_tipo_solicitud t
                    ON s.sol_tipo = t.tse_id
                    JOIN se_motivos m
                    ON s.sol_motivo = m.mot_id
                    JOIN se_solicitante ste
                    ON s.sol_solicitante = ste.ste_id
                    JOIN se_autorizacion aut
                    ON aut.aut_solicitud = s.sol_id
                    WHERE s.sol_situacion = 4";

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


    public static function enviarMdnApi()
    {
        try {
            $solicitud_id = $_POST['sol_id'];
            $solicitud = Solicitud::find($solicitud_id);
            $solicitud->sol_situacion = 4;
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


    public static function aprobarRechazarSolicitudApi()
    {
        try {
            $solicitud_id = $_POST['sol_id'];
            $accion = $_POST['accion'];

            $solicitud = Solicitud::find($solicitud_id);

            $nuevo_estado = ($accion === 'aprobar') ? 5 : 6;

            $solicitud->sol_situacion = $nuevo_estado;
            $resultado = $solicitud->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => "Solicitud $accion correctamente",
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
}
