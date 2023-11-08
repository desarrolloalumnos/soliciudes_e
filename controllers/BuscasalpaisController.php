<?php

namespace Controllers;

use Exception;
use Model\Salidapais;
use Model\Saldetpaises;
use Model\Paises;
use Model\Transportes;
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
        ste_cat,
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
                $catalogo_doc = $_POST['ste_cat'];

                $fechaSalida = $_POST['sal_salida'];
                $fechaFormateadaSalida = date('Y-m-d H:i', strtotime($fechaSalida));
                $_POST['sal_salida'] = $fechaFormateadaSalida;

                $fechaIngreso = $_POST['sal_ingreso'];
                $fechaFormateadaIngreso = date('Y-m-d H:i', strtotime($fechaIngreso));
                $_POST['sal_ingreso'] = $fechaFormateadaIngreso;

                $solicitudId = $_POST['sol_id'];

                if (!empty($_FILES['pdf_ruta']['name'])) {
                    $archivo = $_FILES['pdf_ruta'];
                    $ruta = "../storage/salidapais/$catalogo_doc" . uniqid() . ".pdf";
                    $subido = move_uploaded_file($archivo['tmp_name'], $ruta);

                    if ($subido) {
                        $pdf = new Pdf([
                            'pdf_solicitud' => $solicitudId,
                            'pdf_ruta' => $ruta
                        ]);
                        $pdf = $pdf->crear();
                    }
                }

                $salidapais = new Salidapais($_POST); 
                $salidaPaisResultado = $salidapais->actualizar();

                if ($salidaPaisResultado !== null) {
                    echo json_encode([
                        'mensaje' => 'Registro modificado correctamente',
                        'codigo' => 1
                    ]);
                } else {
                    echo json_encode([
                        'mensaje' => 'No se pudo modificar el registro',
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
    }
           

