<?php

namespace Controllers;

use Exception;
use Model\Solicitud;
use MVC\Router;

class AdministracionController
{
    public static function index(Router $router)
    {
        // $motivos = static::motivos();

        $router->render('administraciones/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi()
    {



        // $cmv_dependencia = $_GET['cmv_dependencia'];
        // $cmv_tip = $_GET['cmv_tip'];



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
                    WHERE s.sol_situacion >= 1";

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
            $solicitud->sol_situacion = 5;
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
}
