<?php

namespace Controllers;

use Exception;
use Model\Salidapais;
use Model\Saldetpaises;
use Model\Paises;
use Model\Transportes;
use Model\Solicitante;
use Model\Solicitud;
use Model\Motivos;
use Model\Pdf;
use MVC\Router;

class BuscasalpaisController
{
    public static function index(Router $router)
    {

        $motivos = static::motivos();
        $paises = static::paises();
        $transportes = static::transportes();

        $router->render('busquedasalpais/index', [
            'motivos' => $motivos,
            'paises' => $paises,
            'transportes' => $transportes
        ]);
    }

    public static function buscarApi()
    {
        
        $catalogo = $_GET['catalogo'];
        $fecha = $_GET['fecha'];

        $sql = "SELECT  
        ste_id,
        sal_id,
        ste_cat,
        gra_desc_lg,
        sol_situacion,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) nombre,
        sal_salida,
        sal_ingreso, 
        pdf_id,
        pdf_solicitud,
        sol_id,
        pdf_ruta
        FROM se_salpais
        inner join se_autorizacion on aut_id = sal_autorizacion
        inner join se_solicitudes on aut_solicitud = sol_id
        inner join se_solicitante on sol_solicitante=ste_id
        inner join mper on ste_cat = per_catalogo
        inner join grados on ste_gra = gra_codigo
        inner join se_pdf on pdf_solicitud = sol_id 

        AND sol_situacion = 1";

         if ($fecha != '') {
            $sql .= " AND cast(ste_fecha as date) = '$fecha' ";
        }
        if ($catalogo != '') {
            $sql .= " AND ste_cat = '$catalogo'";
        }
        $sql .= " ORDER BY ste_fecha DESC";

        $sql.=" ORDER BY ste_fecha DESC ";

        $valores = [];

        try {
            $resultado = Salidapais::fetchArray($sql);

            foreach ($resultado as $key => $value) {
                $paises = '';
                $ciudad = '';

                $id = $value['sal_id'];

                $sql1 = "SELECT 
                dsal_sol_salida,
                pai_desc_lg as nombre_pais, 
                dsal_ciudad as ciudad
            FROM se_dsalpais
            INNER JOIN se_salpais ON dsal_sol_salida = sal_id
            INNER JOIN paises ON dsal_pais = pai_codigo
            where dsal_sol_salida = $id";

                $resultado1 = Salidapais::fetchArray($sql1);

                foreach ($resultado1 as $key1 => $value1) {


                    $paises .= ($paises != '' && $value1['nombre_pais'] != null) ? ', ' : '';
                    $paises .= trim($value1['nombre_pais']);

                    $ciudad .= ($ciudad != '' && $value1['ciudad'] != null) ? ', ' : '';
                    $ciudad .= trim($value1['ciudad']);
                }
                $valores[] = [
                    'sal_id' => $value['sal_id'],
                    'gra_desc_lg' => $value['gra_desc_lg'],
                    'nombre' => $value['nombre'],
                    'sal_salida' => $value['sal_salida'],
                    'sal_ingreso' => $value['sal_ingreso'],
                    'pdf_ruta' => $value['pdf_ruta'],
                    'pdf_id' => $value['pdf_id'],
                    'pdf_solicitud' => $value['pdf_solicitud'],
                    'ste_id' => $value['ste_id'],
                    'sol_id' => $value['sol_id'],
                    'sol_situacion' => $value['sol_situacion'],
                    'paises' => $paises,
                    'ciudad' => $ciudad
                ];
            }
        
            echo json_encode($valores);
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarModalApi()
    {
        $id = $_GET['id'];
        $sql = "SELECT  
        ste_id,
        ste_cat,
        ste_fecha,
        ste_telefono,
        TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombre,
        sol_id,
        sol_obs,
        sol_motivo,
        sal_id,
        sal_salida,
        sal_ingreso,
        dsal_id,
        pdf_ruta
        FROM se_dsalpais
        inner join se_salpais on dsal_sol_salida = sal_id
          inner join se_autorizacion on aut_id = sal_autorizacion
          inner join se_solicitudes on aut_solicitud = sol_id
          inner join se_solicitante on sol_solicitante=ste_id
          inner join se_pdf on pdf_solicitud=sol_id
          inner join mper on ste_cat = per_catalogo
       WHERE sol_situacion >= 1 AND ste_id = $id";

        $valores = [];

        try {
            $resultado = Salidapais::fetchArray($sql);

            foreach ($resultado as $key => $value) {
                $paises = [];
                $ciudad = [];
                $transporte = [];

                $id = $value['sal_id'];

                $sql1 = "SELECT 
                dsal_sol_salida,
                pai_codigo as nombre_pais, 
                dsal_ciudad as ciudad,
                transporte_id as transporte
            FROM se_dsalpais
            INNER JOIN se_salpais ON dsal_sol_salida = sal_id
            INNER JOIN paises ON dsal_pais = pai_codigo
            INNER JOIN se_transporte on dsal_transporte = transporte_id
            where dsal_sol_salida = $id";
                $resultado1 = Salidapais::fetchArray($sql1);

                foreach ($resultado1 as $key1 => $value1) {

                    $paises[] = trim($value1['nombre_pais']);

                    $ciudad[] =  trim($value1['ciudad']);

                    $transporte[] = trim($value1['transporte']);
                }
                $valores[] = [
                    'sal_id' => $value['sal_id'],
                    'ste_id' => $value['ste_id'],
                    'ste_cat' => $value['ste_cat'],
                    'ste_fecha' => $value['ste_fecha'],
                    'ste_telefono' => $value['ste_telefono'],
                    'nombre' => $value['nombre'],
                    'sol_id' => $value['sol_id'],
                    'sol_obs' => $value['sol_obs'],
                    'sol_motivo' => $value['sol_motivo'],
                    'sal_salida' => $value['sal_salida'],
                    'sal_ingreso' => $value['sal_ingreso'],
                    'dsal_id' => $value['dsal_id'],
                    'pdf_ruta' => $value['pdf_ruta'],
                    'paises' => $paises,
                    'ciudad' => $ciudad,
                    'transporte' => $transporte
                ];
            }
            echo json_encode($valores);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function modificarApi()
    {
        try {
            $modificacionExitosa = false;

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
                if ($resultado['resultado'] == 1) {
                    $modificacionExitosa = true;
                }
            }

            if (isset($_POST['pai_codigo']) && !empty($_POST['pai_codigo'])) {
                $paisId = $_POST['pai_codigo'];
                $pais = Paises::find($paisId);
                $pais->pai_codigo = $_POST['pai_codigo'];
                $paisResultado = $pais->actualizar();
                if ($paisResultado['resultado'] == 1) {
                    $modificacionExitosa = true;
                }
            }

            if (isset($_POST['sal_id']) && !empty($_POST['sal_id'])) {
                $salId = $_POST['sal_id'];
                $salidaPais = Salidapais::find($salId);
                $salidaPais->sal_salida = $_POST['sal_salida'];
                $salidaPais->sal_ingreso = $_POST['sal_ingreso'];
                $salidaPaisResultado = $salidaPais->actualizar();
                if ($salidaPaisResultado['resultado'] == 1) {
                    $modificacionExitosa = true;
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
                    if ($detalleSalidaPaisResultado['resultado'] == 1) {
                        $modificacionExitosa = true;
                    }
                }
            }

            if (isset($_POST['sol_id']) && !empty($_POST['sol_id'])) {
                $sol_id = $_POST['sol_id'];
                $detalleSolicitud = Solicitud::find($sol_id);
                if ($detalleSolicitud) {
                    $detalleSolicitud->sol_motivo = $_POST['sol_motivo'];
                    $detalleSolicitud->sol_obs = $_POST['sol_obs'];
                    $detalleSolicitudResultado = $detalleSolicitud->actualizar();
                    if ($detalleSolicitudResultado['resultado'] == 1) {
                        $modificacionExitosa = true;
                    }
                }
            }

            if ($modificacionExitosa) {
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



    public static function VerPdf(Router $router)
    {

        $ruta = base64_decode(base64_decode(base64_decode($_GET['ruta'])));

        $router->printPDF($ruta);
    }

    public static function modificarPdfApi()
    {
        try {
            
            $catalogo_doc = $_POST['ste_cat2'];

            if (!empty($_FILES['pdf_ruta']['name'])) {
                // Obtener la ruta del archivo anterior desde la base de datos
                $pdf_id = $_POST['pdf_id'];
                $documentoExistente = Pdf::find($pdf_id);
                $rutaAnterior = $documentoExistente->pdf_ruta;

                // Generar la nueva ruta para el archivo PDF
                $archivo = $_FILES['pdf_ruta'];
                $rutaNueva = "../storage/salidapais/$catalogo_doc" . uniqid() . ".pdf";

                // Mover el nuevo archivo
                $subido = move_uploaded_file($archivo['tmp_name'], $rutaNueva);

                if ($subido) {
                    $documentoExistente->pdf_solicitud = $_POST['pdf_solicitud'];
                    $documentoExistente->pdf_ruta = $rutaNueva;
                    $resultado = $documentoExistente->actualizar();


                    if ($resultado && file_exists($rutaAnterior)) {
                        unlink($rutaAnterior);
                    }
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
}
