<?php

namespace Controllers;

use Exception;
use Model\Salidapais;
use Model\Saldetpaises;
use Model\Paises;
use Model\Transportes;
use Model\Solicitante;
use Model\Solicitud;
use Model\Pdf;
use MVC\Router;

class BuscasalpaisController{
    public static function index(Router $router){
        // $motivos = static::motivos();

        $router->render('busquedasalpais/index', [
            // 'motivos' => $motivos
        ]);
    }

    public static function buscarApi(){

        $sql = "SELECT  
        sal_id,
        ste_cat,
        gra_desc_lg,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) nombre,
        sal_salida,
        sal_ingreso, 
        pai_desc_lg,
        dsal_ciudad,
        pdf_ruta
        FROM se_salpais
        inner join se_dsalpais on dsal_sol_salida = sal_id
        inner join se_autorizacion on aut_id = sal_autorizacion
        inner join se_solicitudes on aut_solicitud = sol_id
        inner join se_solicitante on sol_solicitante=ste_id
        inner join mper on ste_cat = per_catalogo
        inner join grados on ste_gra = gra_codigo
        inner join paises on dsal_pais = pai_codigo
        inner join se_pdf on pdf_solicitud = sol_id";

        try {
            $resultado = Salidapais::fetchArray($sql);
            echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarApi(){

        try {
                    
                $fechaSolicito = $_POST['ste_fecha'];
                $fechaFormateadaSolicito = date('Y-m-d H:i', strtotime($fechaSolicito));
                $_POST['ste_fecha'] = $fechaFormateadaSolicito;
                
                $fechaSalida = $_POST['sal_salida'];
                $fechaFormateadaSalida = date('Y-m-d H:i', strtotime($fechaSalida));
                $_POST['sal_salida'] = $fechaFormateadaSalida;

                $fechaIngreso = $_POST['sal_ingreso'];
                $fechaFormateadaIngreso = date('Y-m-d H:i', strtotime($fechaIngreso));
                $_POST['sal_ingreso'] = $fechaFormateadaIngreso;

                if (isset($_POST['ste_id']) && !empty($_POST['ste_id'])) {
                    $id = $_POST['ste_id'];
                    $solicitante = Solicitante::find($id);
    
                    $solicitante->ste_telefono = $_POST['ste_telefono'];
                    $resultado = $solicitante->actualizar();
                } else {
                }
    
                if (isset($_POST['pai_codigo']) && !empty($_POST['pai_codigo'])) {
                    $paisId = $_POST['pai_codigo'];
                    $pais = Paises::find($paisId);
    
    
                    if ($pais) {
                        $pais->pai_desc_lg = $_POST['pai_desc_lg'];
                        $paisResultado = $pais->actualizar();
                    }
                } 

                if (isset($_POST['transporte_id']) && !empty($_POST['transporte_id'])) {
                    $transporteId = $_POST['transporte_id'];
                    $transporte = Transportes::find($transporteId);
        
                    if ($transporte) {
                        $transporte->transporte_descripcion = $_POST['transporte_descripcion'];
                        $transporteResultado = $transporte->actualizar();
                    }
                }

                if (isset($_POST['dsal_id']) && !empty($_POST['dsal_id'])) {
                    $dsalId = $_POST['dsal_id'];
                    $detalleSalidaPais = Saldetpaises::find($dsalId);
                
                    if ($detalleSalidaPais) {
                        $detalleSalidaPais->dsal_ciudad = $_POST['dsal_ciudad'];
                        $detalleSalidaPais->dsal_pais = $_POST['dsal_pais'];
                        $detalleSalidaPais->dsal_transporte = $_POST['dsal_transporte'];
                        $detalleSalidaPaisResultado = $detalleSalidaPais->actualizar();
                    }
                }

                $salId = $_POST['sal_id'];
                $salidaPais = Salidapais::find($salId);
                $salidaPais->sal_autorizacion = $_POST['sal_autorizacion'];
                $salidaPais->sal_salida = $_POST['sal_salida'];
                $salidaPais->sal_ingreso = $_POST['sal_ingreso'];
                $salidaPaisResultado = $salidaPais->actualizar();

                if ($salidaPaisResultado['resultado'] == 1) {
                    echo json_encode([
                        'mensaje' => 'Registro de salida de país modificado correctamente',
                        'codigo' => 1
                    ]);
                } else {
                    echo json_encode([
                        'mensaje' => 'Error al modificar el registro de salida de país',
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
    
    
    public static function VerPdf(Router $router){

        $ruta = base64_decode(base64_decode(base64_decode($_GET['ruta'])));

        $router->printPDF($ruta);
    }

    public static function modificarPdfApi() {
        try {

            $catalogo_doc = $_POST['ste_cat'];

            if (!empty($_FILES['pdf_ruta']['name'])) {
                $archivo = $_FILES['pdf_ruta'];
                $ruta = "../storage/salidapais/$catalogo_doc" . uniqid() . ".pdf";
                $subido = move_uploaded_file($archivo['tmp_name'], $ruta);

                if ($subido) {
                    $pdf_id = $_POST['pdf_id'];
                    $nuevoDocumento = Pdf::find($pdf_id);
                    $nuevoDocumento->pdf_solicitud = $_POST['pdf_solicitud'];
                    $nuevoDocumento->pdf_ruta = $ruta;
                    $resultado = $nuevoDocumento->actualizar();
                } else {
                }
            }

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
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

    public static function eliminarApi(){
    try {
            $solicitud_id = $_POST['sol_id'];
            $solicitud = Solicitud::find($solicitud_id);
            $solicitud->sol_situacion = 0;
            $resultado = $solicitud->actualizar();


            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro de salida de país eliminado correctamente',
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
