<?php

namespace Controllers;

use Exception;
use Model\Autorizacion;
use Model\Dependencia;
use Model\Motivos;
use Model\Organizacion;
use Model\Paises;
use Model\Pdf;
use Model\Personal;
use Model\Saldetpaises;
use Model\Salidapais;
use Model\Solicitante;
use Model\Solicitud;
use Model\Tiposolicitud;
use Model\Transportes;
use MVC\Router;

class SalidapaisController
{
    public static function index(Router $router)
    {
        $motivos = static::motivos();
        $paises = static::paises();
        $transportes = static::transportes();

        $router->render('salidapaises/index', [
            'motivos' => $motivos,
            'paises' => $paises,
            'transportes' => $transportes
        ]);
    }
    public static function generaIdentificador()
    {

        $sql = "SELECT dep_desc_ct as depCorto FROM mdep  inner join morg on org_dependencia = dep_llave inner join mper on per_plaza = org_plaza where per_catalogo = user";
        $resultado =  Solicitante::fetchFirst($sql);
        $nombreDependencia = trim($resultado['depcorto']);
        
        
        $nombreComandante = static::getComandante();
        
        $nombreUsuario = static::nombre('user');
        $numero = static::getNumeroSolicitud();
        $numero = str_pad($numero, 3, "0", STR_PAD_LEFT);

        $nombreDependencia = strpos($nombreDependencia, '.') ? static::getIniciales($nombreDependencia, '.') : $nombreDependencia;
        $nombreComandante = static::getIniciales($nombreComandante, ' ');
        $nombreUsuario = strtolower(static::getIniciales($nombreUsuario, ' '));

        if (strpos($nombreDependencia, '.')) {
            $nombreDependencia = static::getIniciales($nombreDependencia);
        }
        $nombreDependencia = str_replace(".", "", $nombreDependencia);

        $identificador = "RR/OP-$nombreDependencia-OF-$numero-$nombreComandante-$nombreUsuario";
        return $identificador;
    }
   public static  function getIniciales($cadena = "", $separador = "")
    {
        $iniciales = '';
        $explode = explode($separador, $cadena);
        foreach ($explode as $x) {
            $iniciales .=  $x[0];
        }
        return $iniciales;
    }
    public static function  getComandante()
    {
        $sql = "SELECT trim(per_nom1) || ' ' || trim(per_nom2) || ' ' || trim(per_ape1) || ' ' || trim(per_ape2) as nombre  from mper where per_plaza = (select org_plaza from morg where org_dependencia in (select org_dependencia from mper inner join morg on per_plaza = org_plaza where per_catalogo = user) and org_ceom like '%90' and org_plaza_desc = 'COMANDANTE' and org_grado > 87)";
        $resultado = Solicitante::fetchArray($sql);
        // return $sql;
        return $resultado[0]['nombre']; 
    }
    public static function nombre($validarCatalogo)
    {
        $sql = "SELECT trim(per_nom1) || ' ' || trim(per_nom2) || ' ' || trim(per_ape1) || ' ' || trim(per_ape2) as nombre , per_catalogo as catalogo  FROM mper inner join grados on per_grado = gra_codigo  inner join morg on per_plaza = org_plaza where per_catalogo = $validarCatalogo";
        $resultado =  Autorizacion::fetchArray($sql);
        return $resultado[0]['nombre'];
    }
   public static  function getNumeroSolicitud()
    {
        $sql = "SELECT  nvl(count(sol_id),0)  + 1 as numero from se_solicitudes  inner join se_solicitante  on ste_id = sol_solicitante   where year(ste_fecha) = year(current) and ste_comando = (select org_dependencia from mper inner join morg on per_plaza = org_plaza where per_catalogo = user) and sol_situacion != 0 ";
        $resultado = Solicitud::fetchArray($sql);
        return $resultado[0]['numero'];
    }

    public static function guardarApi()
    {

        try {
         
            $identificador = static::generaIdentificador();  
            $paises_array = $_POST['dsal_pais_'];
            $transportes_array = $_POST['dsal_transporte_'];
            $ciudades_array = $_POST['dsal_ciudad_'];
            
            $num_elementos = count($paises_array);

            $catalogo_doc = $_POST['ste_cat'];

            $fechaAutorizacion = $_POST['aut_fecha'];
            $fechaFormateadaAutorizacion = date('Y-m-d H:i', strtotime($fechaAutorizacion));
            $_POST['aut_fecha'] = $fechaFormateadaAutorizacion;

            $fechaSolicito = $_POST['ste_fecha'];
            $fechaFormateadaSolicito = date('Y-m-d H:i', strtotime($fechaSolicito));
            $_POST['ste_fecha'] = $fechaFormateadaSolicito;

            $fechaSalidaPais = $_POST['sal_salida'];
            $fechaFormateadaIniSal = date('Y-m-d H:i', strtotime($fechaSalidaPais));
            $_POST['sal_salida'] = $fechaFormateadaIniSal;

            $fechaIngresoPais = $_POST['sal_ingreso'];
            $fechaFormateadaFinLic = date('Y-m-d H:i', strtotime($fechaIngresoPais));
            $_POST['sal_ingreso'] = $fechaFormateadaFinLic;


            $solicitante = new Solicitante($_POST);
            $solicitanteResultado = $solicitante->crear();

            if ($solicitanteResultado['resultado'] == 1) {
                $solicitanteId = $solicitanteResultado['id'];

                $solicitud = new Solicitud($_POST);
                $solicitud->sol_identificador = $identificador;
                $solicitud->sol_solicitante = $solicitanteId;
                $solicitudResultado = $solicitud->crear();

                if ($solicitudResultado['resultado'] == 1) {
                    $solicitudId = $solicitudResultado['id'];

                    $archivo = $_FILES['pdf_ruta'];
                    $ruta = "../storage/salidapais/$catalogo_doc" . "." . uniqid() . ".pdf";
                    $subido = move_uploaded_file($archivo['tmp_name'], $ruta);

                    if ($subido) {
                        $pdf = new Pdf([
                            'pdf_solicitud' => $solicitudId,
                            'pdf_ruta' => $ruta
                        ]);
                        $pdfResultado = $pdf->crear();


                        if ($pdfResultado['resultado'] == 1) {
                            $autorizacion = new Autorizacion($_POST);
                            $autorizacion->aut_solicitud = $solicitudId;
                            $autorizacionResultado = $autorizacion->crear();
                            if ($autorizacionResultado['resultado'] == 1) {
                                $autorizacionId = $autorizacionResultado['id'];

                                $salidapais = new Salidapais($_POST);
                                $salidapais->sal_autorizacion = $autorizacionId;
                                $salidapaisResultado = $salidapais->crear();

                                if ($salidapaisResultado['resultado'] == 1) {
                                    $salidapaisId = $salidapaisResultado['id'];

                                    for ($i = 0; $i < $num_elementos; $i++) {
                                        $valor_paises = $paises_array[$i];
                                        $valor_transportes = $transportes_array[$i];
                                        $valor_ciudades = $ciudades_array[$i];

                                        $salidadetpais = new Saldetpaises([
                                            'dsal_sol_salida' => $salidapaisId,
                                            'dsal_pais' => $valor_paises,
                                            'dsal_transporte' => $valor_transportes,
                                            'dsal_ciudad' => $valor_ciudades,
                                        ]);

                                        $salidadetpaisResultado = $salidadetpais->crear();
                                    }
                                } else {
                                    echo "No se pudo crear la solicitud de salida ";
                                    exit;
                                }
                            } else {
                                echo "No se pudo crear la autorización";
                                exit;
                            }
                        } else {
                            echo "No se pudo crear el PDF";
                            exit;
                        }
                    } else {
                        echo "No se pudo subir el archivo PDF";
                        exit;
                    }
                } else {
                    echo "No se pudo crear la solicitud";
                    exit;
                }
            } else {
                echo "No se pudo crear el solicitante";
                exit;
            }


            if ($salidadetpaisResultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
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

    public static function buscarCatalogoApi()
    {
        $validarCatalogo = $_GET['per_catalogo'];

        $sql = "select  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo, RTRIM(per_nom1) || ' ' || RTRIM(per_nom2) || ' ' || RTRIM( per_ape1)  ||  ' ' || RTRIM(per_ape2) nombre from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo";

        try {
            $motivos = Personal::fetchArray($sql);
            echo json_encode($motivos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogo2Api()
    {

        $validarCatalogo2 = $_GET['per_catalogo'];


        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo2 ";


        try {
            $resultado = Personal::fetchArray($sql);
            echo json_encode($resultado);
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
