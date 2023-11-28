<?php

namespace Controllers;

use Model\Solicitud;
use Mpdf\Mpdf;
use Exception;
use Model\Autorizacion;
use MVC\Router;

class ReporteController
{
    public static function pdf(Router $router)
    {
        // Obtener los parámetros de búsqueda desde la solicitud GET
        $id = $_GET['sol_id'];
        $sql = "SELECT DISTINCT sol_id, sol_tipo, aut_solicitud, tse_descripcion, sol_situacion,sol_identificador 
        FROM se_solicitudes
        INNER JOIN se_tipo_solicitud ON sol_tipo = tse_id  
        INNER JOIN se_autorizacion ON aut_solicitud = sol_id
        WHERE sol_id = $id";

        $valores = [];

        try {
            // Realiza la consulta a la base de datos
            $resultado = Solicitud::fetchArray($sql);

            // Verifica si hay algún resultado antes de continuar
            if (!empty($resultado)) {
                // Obtén el primer resultado, ya que debería ser único debido a la consulta por ID
                $value = $resultado[0];

                $autorizador = '';
                $obs = '';
                $dependencia = '';
                $ids = $value['sol_id'];

                $sql1 = "SELECT FIRST 1 aut_obs AS obs,
                         (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                          FROM mper 
                          INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                          INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                          WHERE per_catalogo = aut_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                          FROM mper 
                          WHERE per_catalogo = aut_cat) AS autorizador,                 
                         (SELECT dep_desc_lg 
                          FROM mper, morg, mdep 
                          WHERE per_plaza = org_plaza 
                          AND org_dependencia = dep_llave 
                          AND per_catalogo = aut_cat) AS dependencia  
                 FROM se_autorizacion
                 INNER JOIN se_solicitudes ON aut_solicitud = sol_id                                       
                 WHERE sol_situacion >= 4 AND aut_solicitud = $ids AND aut_situacion = 4";

                $resultado1 = Autorizacion::fetchArray($sql1);

                foreach ($resultado1 as $key => $value1) {
                    $autorizador .= ($autorizador != '' && $value1['autorizador'] != null) ? ', ' : '';
                    $autorizador .= trim($value1['autorizador']);

                    $obs .= ($obs != '' && $value1['obs'] != null) ? ', ' : '';
                    $obs .= trim($value1['obs']);

                    $dependencia .= ($dependencia != '' && $value1['dependencia'] != null) ? ', ' : '';
                    $dependencia .= trim($value1['dependencia']);
                }

                $valores[] = [
                    'sol_id' => $value['sol_id'],
                    'tse_descripcion' => $value['tse_descripcion'],
                    'sol_tipo' => $value['sol_tipo'],
                    'aut_solicitud' => $value['aut_solicitud'],
                    'sol_situacion' => $value['sol_situacion'],
                    'sol_identificador' => $value['sol_identificador'],
                    'obs' => $obs,
                    'autorizador' => $autorizador,
                    'dependencia' => $dependencia
                ];
            }

            // Crear el PDF
            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "letter",
                "mode" => 'utf-8'
            ]);

            $mpdf->SetMargins(30, 35, 25);
            $imgPath = './images/estadoMayor.png';

            $info = getimagesize($imgPath);

            $enlace = '<div style="text-align: center;"><a href="/soliciudes_e/" style="display: inline-block;"><img src="' . $imgPath . '" style="max-width: 8%; max-height: 8%;"></a></div>';

            $html = $router->load('reporte/pdf', [
                'direccion' => ['DIRECCION DE PERSONAL'],
                'valores' => $valores,
                'enlace' => $enlace
            ]);
            $headerHtml = $router->load('reporte/header', []);
            $footerHtml = $router->load('reporte/footer');
            $mpdf->SetHTMLHeader($headerHtml);
            $mpdf->SetHTMLFooter($footerHtml);
            $mpdf->AddPage();

            $mpdf->WriteHTML($html);

            $mpdf->Output();
        } catch (Exception $e) {

            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function pdfCorreccion(Router $router)
    {
        // Obtener los parámetros de búsqueda desde la solicitud GET
        $id = $_GET['sol_id'];
        $sql = "SELECT DISTINCT sol_id, sol_tipo, aut_solicitud, tse_descripcion, sol_situacion,sol_identificador 
        FROM se_solicitudes
        INNER JOIN se_tipo_solicitud ON sol_tipo = tse_id  
        INNER JOIN se_autorizacion ON aut_solicitud = sol_id
        WHERE sol_id = $id";

        $valores = [];

        try {
            // Realiza la consulta a la base de datos
            $resultado = Solicitud::fetchArray($sql);

            // Verifica si hay algún resultado antes de continuar
            if (!empty($resultado)) {
                // Obtén el primer resultado, ya que debería ser único debido a la consulta por ID
                $value = $resultado[0];

                $autorizador = '';
                $obs = '';
                $dependencia = '';
                $ids = $value['sol_id'];

                $sql1 = "SELECT FIRST 1 aut_obs AS obs,
                         (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                          FROM mper 
                          INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                          INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                          WHERE per_catalogo = aut_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                          FROM mper 
                          WHERE per_catalogo = aut_cat) AS autorizador,                 
                         (SELECT dep_desc_lg 
                          FROM mper, morg, mdep 
                          WHERE per_plaza = org_plaza 
                          AND org_dependencia = dep_llave 
                          AND per_catalogo = aut_cat) AS dependencia,
                          aut_situacion 
                 FROM se_autorizacion
                 INNER JOIN se_solicitudes ON aut_solicitud = sol_id                                       
                 WHERE sol_situacion >= 4 AND aut_solicitud = $ids AND aut_situacion = 3";

                $resultado1 = Autorizacion::fetchArray($sql1);

                foreach ($resultado1 as $key => $value1) {
                    $autorizador .= ($autorizador != '' && $value1['autorizador'] != null) ? ', ' : '';
                    $autorizador .= trim($value1['autorizador']);

                    $obs .= ($obs != '' && $value1['obs'] != null) ? ', ' : '';
                    $obs .= trim($value1['obs']);

                    $dependencia .= ($dependencia != '' && $value1['dependencia'] != null) ? ', ' : '';
                    $dependencia .= trim($value1['dependencia']);
                }

                $valores[] = [
                    'sol_id' => $value['sol_id'],
                    'tse_descripcion' => $value['tse_descripcion'],
                    'sol_tipo' => $value['sol_tipo'],
                    'aut_solicitud' => $value['aut_solicitud'],
                    'sol_situacion' => $value['sol_situacion'],
                    'sol_identificador' => $value['sol_identificador'],
                    'obs' => $obs,
                    'autorizador' => $autorizador,
                    'dependencia' => $dependencia
                ];
            }

            // Crear el PDF
            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "letter",
                "mode" => 'utf-8'
            ]);

            $mpdf->SetMargins(30, 35, 25);
            $imgPath = './images/estadoMayor.png';

            $info = getimagesize($imgPath);

            $enlace = '<div style="text-align: center;"><a href="/soliciudes_e/" style="display: inline-block;"><img src="' . $imgPath . '" style="max-width: 8%; max-height: 8%;"></a></div>';

            $html = $router->load('reporte/pdf', [
                'direccion' => ['DIRECCION DE PERSONAL'],
                'valores' => $valores,
                'enlace' => $enlace
            ]);
            $headerHtml = $router->load('reporte/header', []);
            $footerHtml = $router->load('reporte/footer');
            $mpdf->SetHTMLHeader($headerHtml);
            $mpdf->SetHTMLFooter($footerHtml);
            $mpdf->AddPage();

            $mpdf->WriteHTML($html);

            $mpdf->Output();
        } catch (Exception $e) {

            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function pdfMinisterio(Router $router)
    {
        // Obtener los parámetros de búsqueda desde la solicitud GET
        $id = $_GET['sol_id'];
        $sql = "SELECT sol_id, sol_tipo, aut_solicitud, tse_descripcion, sol_situacion,sol_identificador 
        FROM se_solicitudes
        INNER JOIN se_tipo_solicitud ON sol_tipo = tse_id  
        INNER JOIN se_autorizacion ON aut_solicitud = sol_id
        WHERE sol_id = $id";

        $valores = [];

        try {
            // Realiza la consulta a la base de datos
            $resultado = Solicitud::fetchArray($sql);

            // Verifica si hay algún resultado antes de continuar
            if (!empty($resultado)) {
                // Obtén el primer resultado, ya que debería ser único debido a la consulta por ID
                $value = $resultado[0];

                $autorizador = '';
                $obs = '';
                $dependencia = '';
                $ids = $value['sol_id'];

                $sql1 = "SELECT FIRST 1 aut_obs AS obs,
                         (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                          FROM mper 
                          INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                          INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                          WHERE per_catalogo = aut_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                          FROM mper 
                          WHERE per_catalogo = aut_cat) AS autorizador,                 
                         (SELECT dep_desc_lg 
                          FROM mper, morg, mdep 
                          WHERE per_plaza = org_plaza 
                          AND org_dependencia = dep_llave 
                          AND per_catalogo = aut_cat) AS dependencia  
                 FROM se_autorizacion
                 INNER JOIN se_solicitudes ON aut_solicitud = sol_id                                       
                 WHERE sol_situacion >= 5 AND aut_solicitud = $ids AND aut_situacion = 5 ";

                $resultado1 = Autorizacion::fetchArray($sql1);

                foreach ($resultado1 as $key => $value1) {
                    $autorizador .= ($autorizador != '' && $value1['autorizador'] != null) ? ', ' : '';
                    $autorizador .= trim($value1['autorizador']);

                    $obs .= ($obs != '' && $value1['obs'] != null) ? ', ' : '';
                    $obs .= trim($value1['obs']);

                    $dependencia .= ($dependencia != '' && $value1['dependencia'] != null) ? ', ' : '';
                    $dependencia .= trim($value1['dependencia']);
                }

                $valores[] = [
                    'sol_id' => $value['sol_id'],
                    'tse_descripcion' => $value['tse_descripcion'],
                    'sol_tipo' => $value['sol_tipo'],
                    'aut_solicitud' => $value['aut_solicitud'],
                    'sol_situacion' => $value['sol_situacion'],
                    'sol_identificador' => $value['sol_identificador'],
                    'obs' => $obs,
                    'autorizador' => $autorizador,
                    'dependencia' => $dependencia
                ];
            }
            if ($value['sol_tipo'] == 1) {
                $direccion = ['DIRECCION GENERAL ADMINISTRATIVA'];
            } else if ($value['sol_tipo'] == 2) {
                $direccion = ['DIRECCION GENERAL ADMINISTRATIVA'];
            } else if ($value['sol_tipo'] == 3) {
                $direccion = ['DIRECCION GENERAL ADMINISTRATIVA'];
            } else if ($value['sol_tipo'] == 4) {
                $direccion = ['DIRECCION GENERAL ADMINISTRATIVA'];
            } else {
                exit;
            }

            // Crear el PDF
            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "letter",
                "mode" => 'utf-8'
            ]);

            $mpdf->SetMargins(30, 35, 25);
            $imgPath = './images/mdn.png';

            $info = getimagesize($imgPath);

            $enlace = '<div style="text-align: center;"><a href="/soliciudes_e/" style="display: inline-block;"><img src="' . $imgPath . '" style="max-width: 17%; max-height: 17%;"></a></div>';

            $html = $router->load('reporte/pdf', [
                'direccion' => $direccion,
                'valores' => $valores,
                'enlace' => $enlace
            ]);
            $headerHtml = $router->load('reporte/header', []);
            $footerHtml = $router->load('reporte/footer');
            $mpdf->SetHTMLHeader($headerHtml);
            $mpdf->SetHTMLFooter($footerHtml);
            $mpdf->AddPage();

            $mpdf->WriteHTML($html);

            $mpdf->Output();
        } catch (Exception $e) {

            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function pdfMatrimonio(Router $router)
    {
        $id = $_GET['sol_id'];

        $sql = "SELECT    
                sol_id,     
                tse_descripcion, 
                sol_identificador,
                (SELECT dep_desc_md FROM mdep INNER JOIN morg ON org_dependencia = dep_llave INNER JOIN mper ON per_plaza = org_plaza WHERE per_catalogo = ste_cat) AS ste_comando, 
                (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md)
                    FROM mper
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste_cat
                ) AS grado_solicitante,
                (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2)
                    FROM mper WHERE per_catalogo = ste_cat
                ) AS nombre_solicitante, 
                ste_emp,
                (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md)
                    FROM mper
                    INNER JOIN grados ON mper.per_grado = grados.gra_codigo
                    INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                    WHERE per_catalogo = ste_cat
                ) || ' ' || (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2)
                    FROM mper WHERE per_catalogo = parejam_cat
                ) AS nombre_conyuge, 
                TRIM(parejac_nombres) || '' || TRIM(parejac_apellidos) AS pareja_civil,
                mat_lugar_civil,
                mat_fecha_bodac,
                mat_lugar_religioso,
                mat_fecha_bodar,
                mat_fecha_lic_ini,
                mat_fecha_lic_fin
            FROM se_solicitudes
            INNER JOIN se_tipo_solicitud ON sol_tipo = tse_id  
            INNER JOIN se_autorizacion ON aut_solicitud = sol_id
            INNER JOIN se_solicitante ON ste_id = sol_solicitante
            INNER JOIN se_matrimonio ON mat_autorizacion = aut_id
            LEFT JOIN se_pareja_militar ON mat_per_army = parejam_id
            LEFT JOIN se_pareja_civil ON mat_per_civil = parejac_id
            WHERE sol_id = $id AND sol_situacion = 5";
        
        $valores = [];
        
        try {
            // Realiza la consulta a la base de datos
            $resultado = Solicitud::fetchArray($sql);
        
            // Verifica si hay algún resultado antes de continuar
            if (!empty($resultado)) {
                // Obtén el primer resultado, ya que debería ser único debido a la consulta por ID
                $value = $resultado[0];
        
                $autorizador = '';
                $fecha = '';
                $dependencia = '';
                $ids = $value['sol_id'];
        
                $sql1 = "SELECT 
                            aut_fecha AS fecha,
                            (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                            FROM mper 
                            INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                            INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                            WHERE per_catalogo = aut_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                            FROM mper 
                            WHERE per_catalogo = aut_cat) AS autorizador,                 
                            (SELECT dep_desc_lg 
                            FROM mper, morg, mdep 
                            WHERE per_plaza = org_plaza 
                            AND org_dependencia = dep_llave 
                            AND per_catalogo = aut_cat) AS dependencia  
                            FROM se_autorizacion
                            INNER JOIN se_solicitudes ON aut_solicitud = sol_id                                       
                            WHERE sol_situacion = 5 AND aut_solicitud = $ids AND aut_situacion = 5 ";
        
                $resultado1 = Autorizacion::fetchArray($sql1);
        
                foreach ($resultado1 as $key => $value1) {
                    $autorizador .= ($autorizador != '' && $value1['autorizador'] != null) ? ', ' : '';
                    $autorizador .= trim($value1['autorizador']);
        
                    $dependencia .= ($dependencia != '' && $value1['dependencia'] != null) ? ', ' : '';
                    $dependencia .= trim($value1['dependencia']);
                       
        
                    $fecha .= ($fecha != '' && $value1['fecha'] != null) ? ', ' : '';
                    $fecha .= trim($value1['fecha']);
                }
        
                $valores[] = [
                    'tse_descripcion' => $value['tse_descripcion'],
                    'sol_identificador' => $value['sol_identificador'],
                    'ste_comando' => $value['ste_comando'],
                    'grado_solicitante' => $value['grado_solicitante'],
                    'nombre_solicitante' => $value['nombre_solicitante'],
                    'ste_emp' => $value['ste_emp'],
                    'nombre_conyuge' => $value['nombre_conyuge'],
                    'pareja_civil' => $value['pareja_civil'],
                    'mat_lugar_civil' => $value['mat_lugar_civil'],
                    'mat_fecha_bodac' => $value['mat_fecha_bodac'],
                    'mat_lugar_religioso' => $value['mat_lugar_religioso'],
                    'mat_fecha_bodar' => $value['mat_fecha_bodar'],
                    'mat_fecha_lic_ini' => $value['mat_fecha_lic_ini'],
                    'mat_fecha_lic_fin' => $value['mat_fecha_lic_fin'],
                    'fecha' => $fecha,
                    'autorizador' => $autorizador,
                    'dependencia' => $dependencia
                ];
            }
            // Crear el PDF
            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "letter",
                "mode" => 'utf-8'
            ]);

             $mpdf->SetMargins(30, 35, 25);
             $imgPath = './images/estadoMayor.png';

             $info = getimagesize($imgPath);

            $enlace = '<div style="text-align: center;"><a href="/soliciudes_e/" style="display: inline-block;"><img src="' . $imgPath . '" style="max-width: 8%; max-height: 8%;"></a></div>';

            $html = $router->load('reporte/casamiento', [
                'direccion' => ['DIRECCION DE PERSONAL'],
                'valores' => $valores,
                'enlace' => $enlace
            ]);
            $headerHtml = $router->load('reporte/header', []);
            $footerHtml = $router->load('reporte/footer');
            $mpdf->SetHTMLHeader($headerHtml);
            $mpdf->SetHTMLFooter($footerHtml);
            $mpdf->AddPage();

            $mpdf->WriteHTML($html);

            $mpdf->Output();
        } catch (Exception $e) {

            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function pdfLicenciaTemporal(Router $router)
    {
        $id = $_GET['sol_id'];
     

        $sql = "SELECT    
                    sol_id,     
                    tse_descripcion, 
                    mot_descripcion,
                    sol_identificador,
                    (SELECT dep_desc_md FROM mdep INNER JOIN morg ON org_dependencia = dep_llave INNER JOIN mper ON per_plaza = org_plaza WHERE per_catalogo = ste_cat) AS ste_comando, 
                    (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md)
                        FROM mper
                        INNER JOIN grados ON mper.per_grado = grados.gra_codigo
                        INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                        WHERE per_catalogo = ste_cat
                    ) AS grado_solicitante,
                    (SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2)
                        FROM mper WHERE per_catalogo = ste_cat
                    ) AS nombre_solicitante, 
                    ste_emp,
                    lit_mes_consueldo,
                    lit_mes_sinsueldo,
                    lit_fecha1,
                    lit_fecha2
                FROM se_solicitudes
                INNER JOIN se_tipo_solicitud ON sol_tipo = tse_id  
                INNER JOIN se_autorizacion ON aut_solicitud = sol_id
                INNER JOIN se_solicitante ON ste_id = sol_solicitante
                INNER JOIN se_licencia_temporal ON lit_autorizacion = aut_id
                INNER JOIN se_motivos ON sol_motivo = mot_id
                WHERE sol_id = $id AND sol_situacion = 5";
          
        $valores = [];
        
        try {
            // Realiza la consulta a la base de datos
            $resultado = Solicitud::fetchArray($sql);
          
            
            // Verifica si hay algún resultado antes de continuar
            if (!empty($resultado)) {
                // Obtén el primer resultado, ya que debería ser único debido a la consulta por ID
                $value = $resultado[0];
        
                $autorizador = '';
                $fecha = '';
                $dependencia = '';
                $ids = $value['sol_id'];
        
                $sql1 = "SELECT 
                            aut_fecha AS fecha,
                            (SELECT TRIM(grados.gra_desc_md) || ' DE ' || TRIM(armas.arm_desc_md) 
                            FROM mper 
                            INNER JOIN grados ON mper.per_grado = grados.gra_codigo 
                            INNER JOIN armas ON mper.per_arma = armas.arm_codigo
                            WHERE per_catalogo = aut_cat) ||' '||(SELECT TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) 
                            FROM mper 
                            WHERE per_catalogo = aut_cat) AS autorizador,                 
                            (SELECT dep_desc_lg 
                            FROM mper, morg, mdep 
                            WHERE per_plaza = org_plaza 
                            AND org_dependencia = dep_llave 
                            AND per_catalogo = aut_cat) AS dependencia  
                            FROM se_autorizacion
                            INNER JOIN se_solicitudes ON aut_solicitud = sol_id                                       
                            WHERE sol_situacion = 5 AND aut_solicitud = $ids AND aut_situacion = 5 ";
        
                $resultado1 = Autorizacion::fetchArray($sql1);
        
                foreach ($resultado1 as $key => $value1) {
                    $autorizador .= ($autorizador != '' && $value1['autorizador'] != null) ? ', ' : '';
                    $autorizador .= trim($value1['autorizador']);
        
                    $dependencia .= ($dependencia != '' && $value1['dependencia'] != null) ? ', ' : '';
                    $dependencia .= trim($value1['dependencia']);
        
                    $fecha .= ($fecha != '' && $value1['fecha'] != null) ? ', ' : '';
                    $fecha .= trim($value1['fecha']);
                }
        
                $valores[] = [
                    'sol_id' => $value['sol_id'],
                    'tse_descripcion' => $value['tse_descripcion'],
                    'sol_descripcion' => $value['sol_descripcion'],
                    'sol_identificador' => $value['sol_identificador'],
                    'ste_comando' => $value['ste_comando'],
                    'grado_solicitante' => $value['grado_solicitante'],
                    'nombre_solicitante' => $value['nombre_solicitante'],
                    'ste_emp' => $value['ste_emp'],
                    'mot_descripcion' => $value['mot_descripcion'],
                    'lit_mes_consueldo' => $value['lit_mes_consueldo'],
                    'lit_mes_sinsueldo' => $value['lit_mes_sinsueldo'],
                    'lit_fecha1' => $value['lit_fecha1'],
                    'lit_fecha2' => $value['lit_fecha2'],
                    'fecha' => $fecha,
                    'autorizador' => $autorizador,
                    'dependencia' => $dependencia
                ];
            }
            
          
       
            // Crear el PDF
            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "letter",
                "mode" => 'utf-8'
            ]);

             $mpdf->SetMargins(30, 35, 25);
             $imgPath = './images/estadoMayor.png';

             $info = getimagesize($imgPath);

            $enlace = '<div style="text-align: center;"><a href="/soliciudes_e/" style="display: inline-block;"><img src="' . $imgPath . '" style="max-width: 8%; max-height: 8%;"></a></div>';

            $html = $router->load('reporte/licencia', [
                'direccion' => ['DIRECCION DE PERSONAL'],
                'valores' => $valores,
                'enlace' => $enlace
            ]);
            $headerHtml = $router->load('reporte/header', []);
            $footerHtml = $router->load('reporte/footer');
            $mpdf->SetHTMLHeader($headerHtml);
            $mpdf->SetHTMLFooter($footerHtml);
            $mpdf->AddPage();

            $mpdf->WriteHTML($html);

            $mpdf->Output();
        } catch (Exception $e) {

            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}

