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
        $sql = "SELECT sol_id, sol_tipo, aut_solicitud, tse_descripcion, sol_situacion
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

        $sql1 = "SELECT aut_obs AS obs,
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
                  WHERE sol_situacion >= 4  AND aut_solicitud = $ids";

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
            'obs' => $obs,
            'autorizador' => $autorizador, 
            'dependencia' => $dependencia
        ];
    }
            
            $direccion = ['DIRECCION DE PERSONAL'];
            // Crear el PDF
            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "Letter",
                "mode" => 'utf-8'
            ]);

            $mpdf->SetMargins(30, 35, 25);

            // Ruta de la imagen relativa al directorio donde se encuentra este script PHP
            $imgPath = './images/logo.png';

            // Obtén las dimensiones de la imagen
            $info = getimagesize($imgPath);

            // Construye el enlace y la etiqueta de la imagen
            $enlace = '<div style="text-align: center;"><a href="/soliciudes_e/" style="display: inline-block;"><img src="' . $imgPath . '" style="max-width: 20%; max-height: 20%;"></a></div>';

            // Cargar la vista PDF con los datos
            $html = $router->load('reporte/pdf', [
                'direccion' => $direccion,
                'valores' => $valores
            ]);
            $headerHtml = $router->load('reporte/header', []);
            $footerHtml = $router->load('reporte/footer');
            $mpdf->SetHTMLHeader($headerHtml);
            $mpdf->SetHTMLFooter($footerHtml);
            $mpdf->AddPage();
            // Insertar el enlace e imagen en el PDF
            $mpdf->WriteHTML($enlace);
            // Agregar el contenido HTML
            $mpdf->WriteHTML($html);
            // Generar el PDF y enviarlo como respuesta
            $mpdf->Output();
        } catch (Exception $e) {
            // Manejar errores si es necesario
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
