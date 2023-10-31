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

class BuscasController
{
    public static function index(Router $router)
    {
        // $motivos = static::motivos();

        $router->render('busquedasc/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi()
    {
        // $cmv_dependencia = $_GET['cmv_dependencia'];
        // $cmv_tip = $_GET['cmv_tip'];



        $sql = "SELECT
                    se_matrimonio.mat_id,
                    se_matrimonio.mat_autorizacion,
                    se_matrimonio.mat_lugar_civil,
                    DATE(se_matrimonio.mat_fecha_bodac) AS mat_fecha_bodac,
                    se_matrimonio.mat_lugar_religioso,
                    DATE(se_matrimonio.mat_fecha_bodar) AS mat_fecha_bodar,
                    se_matrimonio.mat_per_civil,
                    TRIM(parejac_nombres) || ' ' || TRIM(parejac_apellidos) AS nombres,
                    se_matrimonio.mat_per_army,    
                    parejam_cat,
                    (SELECT TRIM(per_nom1) || ' ' ||TRIM(per_nom2) || ' ' ||TRIM(per_ape1) || ' ' || TRIM(per_ape2) FROM mper WHERE per_catalogo = se_pareja_militar.parejam_cat) AS nombres_pareja,
                    (SELECT trim(grados.gra_desc_md)||' de '||(armas.arm_desc_md) FROM mper INNER JOIN grados ON mper.per_grado = grados.gra_codigo INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = se_pareja_militar.parejam_cat) AS grado_pareja,
                    DATE(se_matrimonio.mat_fecha_lic_ini) AS mat_fecha_lic_ini,
                    DATE(se_matrimonio.mat_fecha_lic_fin) AS mat_fecha_lic_fin,
                    se_matrimonio.mat_situacion,    
                    (SELECT TRIM(per_nom1) || ' ' ||TRIM(per_nom2) || ' ' ||TRIM(per_ape1) || ' ' || TRIM(per_ape2) FROM mper WHERE per_catalogo = se_solicitante.ste_cat) AS nombres_solicitante,
                    (SELECT trim(grados.gra_desc_md)||' de '||(armas.arm_desc_md) FROM mper INNER JOIN grados ON mper.per_grado = grados.gra_codigo INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = se_solicitante.ste_cat) AS grado_solicitante,
                    se_solicitante.ste_cat,  
                    (SELECT TRIM(per_nom1) || ' ' ||TRIM(per_nom2) || ' ' ||TRIM(per_ape1) || ' ' || TRIM(per_ape2) FROM mper WHERE per_catalogo = se_autorizacion.aut_cat) AS nombres_autorizacion,
                    (SELECT trim(grados.gra_desc_md)||' de '||(armas.arm_desc_md) FROM mper INNER JOIN grados ON mper.per_grado = grados.gra_codigo INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = se_autorizacion.aut_cat) AS grado_autorizacion,
                    se_autorizacion.aut_cat
                FROM
                    se_matrimonio
                LEFT JOIN
                    se_pareja_civil ON se_matrimonio.mat_per_civil = se_pareja_civil.parejac_id
                LEFT JOIN
                    se_pareja_militar ON se_matrimonio.mat_per_army = se_pareja_militar.parejam_id
                LEFT JOIN
                    se_autorizacion ON se_matrimonio.mat_autorizacion = se_autorizacion.aut_id
                LEFT JOIN
                    se_solicitudes ON se_autorizacion.aut_solicitud = se_solicitudes.sol_id
                LEFT JOIN
                    se_solicitante ON se_solicitudes.sol_solicitante = se_solicitante.ste_id
                WHERE mat_situacion = 1";

        // if ($cmv_dependencia != 0) {
        //     $sql .= " AND cmv_dependencia = $cmv_dependencia ";
        // }

        // if (!empty($cmv_tip)) {
        //     $sql .= " AND cmv_tip = '$cmv_tip' ";
        // }

        try {
            $resultado = Matrimonio::fetchArray($sql);
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
