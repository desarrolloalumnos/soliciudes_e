<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/logo.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <title>Solicitudes electronicas</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark  fixed-top">
    
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/soliciudes_e/">
                <img src="<?= asset('./images/logo.png') ?>" width="35px'" alt="cit">
                S.E.
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/soliciudes_e/"><i class="bi bi-house-fill me-2"></i>Inicio</a>
                    </li>
                    <!-- div para ingreso de solicitudes -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/soliciudes_e/" role="button" data-bs-toggle="dropdown">
                            <i class="ms-lg-0 ms-2 bi bi-file-earmark-text me-2"></i>Llenar Solicitud
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdownSolicitudGestionar">
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/casamientos">
                                    <i class="bi bi-calendar-heart-fill me-2"></i>Matrimonio
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/salidapaises">
                                    <i class="bi bi-airplane-engines me-2"></i>Salida del Pais
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/licencias">
                                    <i class="bi bi-person-dash me-2"></i>Licencia Temporal
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/protocolosol">
                                    <i class="bi bi-music-note me-2"></i>Combos y Vallas
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- div para busqueda de solicitudes  -->
                 
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/soliciudes_e/" role="button" data-bs-toggle="dropdown">
                            <i class="ms-lg-0 ms-2 bi bi-search me-2"></i>Revisar Solicitud
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdownSolicitudGestionar">
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/busquedasc">
                                    <i class="bi bi-calendar-heart-fill me-2"></i>Matrimonio
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/busquedasalpais">
                                    <i class="bi bi-airplane-engines me-2"></i>Salida del Pais
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/busquedaslict">
                                    <i class="bi bi-person-dash me-2"></i>Licencia Temporal
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/busquedasproto">
                                    <i class="bi bi-music-note me-2"></i>Combos y Vallas
                                </a>
                            </li>
                        </ul>
                    </div>


                    <!-- MODULO DE ADMINISTRACION DE LAS OFICINAS DE PERSONAL COMANDOS Y BRIGADAS -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/soliciudes_e/administraciones" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-check2-square me-2"></i>Adminstracion
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdownSolicitudGestionar">
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/administraciones">
                                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Estado de la solicitud
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/historiales">
                                    <i class="ms-lg-0 ms-2 bi bi-clock-history me-2"></i>Historial
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/administraciones/estadistica">
                                    <i class="ms-lg-0 ms-2 bi bi-bar-chart me-2"></i>Estadísticas
                                </a>
                            </li>
                        </ul>
                    </div>


                    <!-- MODULO DE ADMINISTRACION DE LA DIRECCION GENERAL ADMINISTRATIVA DEL ESTADO MAYOR DE LA DEFENSA NACIONAL -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/soliciudes_e/" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-eye-fill me-2"></i>DGAEMDN
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdownSolicitudGestionar">
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/administraciones/direcciongeneral">
                                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Enviar
                                </a>
                            </li>
                        </ul>
                    </div>


                    <!-- MODULO DE ADMINISTRACION DE LA DIRECCION DE PERSONAL DEL ESTADO MAYOR DE LA DEFENSA NACIONAL -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/soliciudes_e/" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-p-square-fill me-2"></i>DPEMDN
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdownSolicitudGestionar">
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/direccionpersonal">
                                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Solicitudes Recibidas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/historialdp">
                                    <i class="ms-lg-0 ms-2 bi bi-clock-history me-2"></i>Historial
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/administraciones/estadistica">
                                    <i class="ms-lg-0 ms-2 bi bi-bar-chart me-2"></i>Estadísticas
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- MODULO DE ADMINISTRACION DEL MINISTERIO DE LA DEFENSA NACIONAL -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/soliciudes_e/" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-p-square-fill me-2"></i>MDN
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdownSolicitudGestionar">
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/direccionpersonal/mdn">
                                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Solicitudes Recibidas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/historialmdn">
                                    <i class="ms-lg-0 ms-2 bi bi-clock-history me-2"></i>Historial
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/administraciones/estadistica">
                                    <i class="ms-lg-0 ms-2 bi bi-bar-chart me-2"></i>Estadísticas
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- MODULO DE ADMINISTRACION DEL MINISTRO DE LA DEFENSA NACIONAL -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/soliciudes_e/" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-check2-square me-2"></i>MD
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdownSolicitudGestionar">
                            <li>
                                <a class="dropdown-item" href="/soliciudes_e/administraciones/estadistica">
                                    <i class="ms-lg-0 ms-2 bi bi-bar-chart me-2"></i>Estadísticas Solicitudes
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- MANTENIMIENTOS DE LAS TABLAS -->
                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i>Manttos
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <li>
                                <a class="nav-link" aria-current="page" href="/soliciudes_e/protocolos"><i class="bi bi-file-music-fill me-2"></i>Combos musicales/Vallas</a>
                            </li>
                            <li>
                                <a class="nav-link" aria-current="page" href="/soliciudes_e/motivos"><i class="bi bi-bookmark-star-fill me-2"></i>Motivos de las Solicitudes</a>
                            </li>
                            <li>
                                <a class="nav-link" aria-current="page" href="/soliciudes_e/articulos"><i class="bi bi-book-fill me-2"></i>Articulos Licencia Temporal</a>
                            </li>
                            <li>
                                <a class="nav-link" aria-current="page" href="/soliciudes_e/transportes"><i class="bi bi-airplane-fill me-2"></i>Tipos de transportes</a>
                            </li>
                            <li>
                                <a class="nav-link" aria-current="page" href="/soliciudes_e/tiposol"><i class="bi bi-file-earmark-text-fill me-2"></i>Tipos de solicitudes</a>
                            </li>
                        </ul>
                    </div>
                </ul>
                <div class="col-lg-1 d-grid mb-lg-0 mb-2">
                    <!-- Ruta relativa desde el archivo donde se incluye menu.php -->
                    <a href="/soliciudes_e/" class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>SALIR</a>
                </div>


            </div>
        </div>

    </nav>

    <div class="progress fixed-bottom" style="height: 6px;">
        <div class="progress-bar progress-bar-animated bg-danger" id="bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="container-fluid pt-5 mb-4" style="min-height: 85vh">

        <?php echo $contenido; ?>
    </div>
    <div class="container-fluid ">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <p style="font-size:xx-small; font-weight: bold;">
                    Comando de Informática y Tecnología,
                    <?= date('Y') ?> &copy;
                </p>
            </div>
        </div>
    </div>
</body>

</html>