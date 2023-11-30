<?php

namespace Controllers;

use Model\Solicitud;
use Mpdf\Mpdf;
use Exception;
use Model\Autorizacion;
use MVC\Router;

class PdfSalidapaisController{
    public static function pdf(Router $router){

        // Obtener los parámetros de búsqueda desde la solicitud GET

        $id = $_GET['sol_id'];

        $sql = "SELECT 
        sol_id,
        ste_fecha,
        aut_solicitud,
        tse_descripcion, 
        sol_identificador,
            (SELECT dep_desc_md as depCorto FROM mdep  inner join morg on org_dependencia = dep_llave inner join mper on per_plaza = org_plaza where per_catalogo = ste_cat) AS ste_comando, 
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
            pai_desc_lg,
            dsal_ciudad,
            transporte_descripcion,
            sal_salida,
            sal_ingreso
        FROM se_solicitudes
        INNER JOIN se_tipo_solicitud ON sol_tipo = tse_id  
        INNER JOIN se_autorizacion ON aut_solicitud = sol_id
        INNER JOIN se_solicitante ON ste_id = sol_solicitante
        INNER JOIN se_salpais ON sal_autorizacion = aut_id
        INNER JOIN se_dsalpais ON dsal_sol_salida = sal_id
        INNER JOIN paises ON dsal_pais = pai_codigo
        INNER JOIN se_transporte ON dsal_transporte = transporte_id
        WHERE sol_id = $id and sol_situacion = 5";

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
                ste_fecha AS fecha,
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
                INNER JOIN se_solicitante ON sol_solicitante = ste_id
                WHERE sol_situacion = 5  AND aut_solicitud = $ids AND aut_situacion = 5  ";

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
                    'ste_fecha' => $value['ste_fecha'],
                    'tse_descripcion' => $value['tse_descripcion'],
                    'sol_identificador' => $value['sol_identificador'],
                    'aut_solicitud' => $value['aut_solicitud'],
                    'ste_comando' => $value['ste_comando'],
                    'grado_solicitante' => $value['grado_solicitante'],
                    'nombre_solicitante' => $value['nombre_solicitante'],
                    'ste_emp' => $value['ste_emp'],
                    'pai_desc_lg' => $value['pai_desc_lg'],
                    'dsal_ciudad' => $value['dsal_ciudad'],
                    'transporte_descripcion' => $value['transporte_descripcion'],
                    'sal_salida' => $value['sal_salida'],
                    'sal_ingresosal_ingreso' => $value['sal_ingreso'],
                    'autorizador' => $autorizador,
                    'dependencia' => $dependencia,
                    'fecha' => $fecha
                ];
            }

            $direccion = ['DIRECCION DE PERSONAL'];
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

            $html = $router->load('pdfsalidapais/pdf', [
                'direccion' => $direccion,
                'valores' => $valores,
                'enlace' => $enlace
            ]);
            $headerHtml = $router->load('pdfsalidapais/header', []);
            $footerHtml = $router->load('pdfsalidapais/footer');
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