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

class LictempController
{
    public static function index(Router $router)
    {
        $motivos = static::motivos();
        $articulos = static::articulos();

        $router->render('licencias/index', [
            'motivos' => $motivos,
            'articulos' => $articulos
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
            $catalogo_doc = $_POST['ste_cat'];
            $tiempo = $_POST['tiempo'];           
            
            $numeroEntero = intval($tiempo);
            
            if ($numeroEntero >= 10000 && $numeroEntero <= 50000) {
                $_POST['lit_mes_sinsueldo'] = min(3, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(0, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 50001 && $numeroEntero <= 100000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(0, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 100001 && $numeroEntero <= 200000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(1, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 200001 && $numeroEntero <= 280000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(2, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 280001 && $numeroEntero <= 330000) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(1, $_POST['lit_mes_consueldo']);
            } else if ($numeroEntero >= 33001) {
                $_POST['lit_mes_sinsueldo'] = min(6, $_POST['lit_mes_sinsueldo']);
                $_POST['lit_mes_consueldo'] = min(2, $_POST['lit_mes_consueldo']);
            } else {
                exit;
            }
       

            $fechaAutorizacion = $_POST['aut_fecha'];
            $fechaFormateadaAutorizacion = date('Y-m-d H:i', strtotime($fechaAutorizacion));
            $_POST['aut_fecha'] = $fechaFormateadaAutorizacion;

            $fechaSolicito = $_POST['ste_fecha'];
            $fechaFormateadaSolicito = date('Y-m-d H:i', strtotime($fechaSolicito));
            $_POST['ste_fecha'] = $fechaFormateadaSolicito;

            $fechaIncioLicencia = $_POST['lit_fecha1'];
            $fechaFormateadaIniLic = date('Y-m-d H:i', strtotime($fechaIncioLicencia));
            $_POST['lit_fecha1'] = $fechaFormateadaIniLic;

            $fechaFinLicencia = $_POST['lit_fecha2'];
            $fechaFormateadaFinLic = date('Y-m-d H:i', strtotime($fechaFinLicencia));
            $_POST['lit_fecha2'] = $fechaFormateadaFinLic;
            
            $_POST = array_map('strtoupper', $_POST);

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
                    $ruta = "../storage/licencia/$catalogo_doc" . uniqid() . ".pdf";
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
                                $licencia = new Licenciatemporal($_POST);
                                $licencia->lit_autorizacion = $autorizacionId;
                                $licenciaResultado = $licencia->crear();
                            } else {

                                exit;
                            }
                        } else {
                            exit;
                        }
                    } else {
                        exit;
                    }
                } else {
                    exit;
                }
            } else {
                exit;
            }

            if ($licenciaResultado['resultado'] == 1) {

                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            }
            // echo json_encode($resultado);
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

        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo ";


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

    public static function buscarTiempoApi()
    {
        $validarCatalogo = $_GET['t_catalogo'];


        $sql = "SELECT t_oficial FROM tiempos WHERE t_catalogo = $validarCatalogo ";


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
    public static function buscarCatalogo3Api()
    {
        $validarCatalogo3 = $_GET['per_catalogo'];


        $sql = "SELECT  dep_llave,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo3";


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

    public static function articulos()
    {
        $sql = "SELECT * FROM se_articulos WHERE art_situacion = 1";

        try {

            $articulos = Articulos::fetchArray($sql);

            if ($articulos) {

                return $articulos;
            } else {
                return 0;
            }
        } catch (Exception $e) {
        }
    }
}
