<?php

namespace Controllers;

use Model\Solicitud;
use Mpdf\Mpdf;
use Exception;
use Model\Autorizacion;
use MVC\Router;

class PdfProtocoloController{
    public static function pdf(Router $router)
    {

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
            cmv_tip,
            dep_desc_lg,
            pco_dir,
            pco_fechainicio,
            pco_fechafin
        FROM se_solicitudes
        INNER JOIN se_tipo_solicitud ON sol_tipo = tse_id  
        INNER JOIN se_autorizacion ON aut_solicitud = sol_id
        INNER JOIN se_solicitante ON ste_id = sol_solicitante
        INNER JOIN se_protocolo ON pco_autorizacion = aut_id
        INNER JOIN se_combos_marimbas_vallas ON pco_cmbv = cmv_id
        INNER JOIN mdep ON cmv_dependencia = dep_llave
        WHERE sol_id = $id and sol_situacion = 5";

        $valores = [];

        try {
            // Realiza la consulta a la base de datos
            $resultado = Solicitud::fetchArray($sql);

         
            if (!empty($resultado)) {
         
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
                    'cmv_tip' => $value['cmv_tip'],
                    'dep_desc_lg' => $value['dep_desc_lg'],
                    'pco_dir' => $value['pco_dir'],
                    'pco_fechainicio' => $value['pco_fechainicio'],
                    'pco_fechafin' => $value['pco_fechafin'],
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

            $html = $router->load('pdfproto/pdf', [
                'direccion' => $direccion,
                'valores' => $valores,
                'enlace' => $enlace
            ]);
            $headerHtml = $router->load('pdfproto/header', []);
            $footerHtml = $router->load('pdfproto/footer');
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