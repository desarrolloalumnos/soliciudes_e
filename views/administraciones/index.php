<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<form class="border bg-light p-4 mt-4 mx-auto w-75" id="formularioAdministracion" name="formularioAdminitracion" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Solicitudes Realizadas</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"> <i class="bi bi-universal-access"></i>Catalogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
            <input  id="ste_fecha" name="ste_fecha" class="form-control" type="date" placeholder="Fecha de la solicitud" >
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="sol_situacion"><i class="bi bi-body-text"></i>Estado de la solicitud</label>
            <select id="sol_situacion" name="sol_situacion" class="form-control">
                <option value="">SELECCIONE..</option>
                <option value="1">COMANDO/BRIGADA</option>
                <option value="2">DGAEMDN</option>
                <option value="3">DPEMDN</option>
                <option value="4">MDN</option>
                <option value="5">AUTORIZADAS</option>
                <option value="6">RECHAZADAS</option>
                <option value="7">CORRECIONES</option>
                <option value="8">CORREGIDO</option>
            </select>
        </div>
        <div class="col-lg-6">
            <label for="tse_id"><i class="bi bi-body-text"></i>Tipo de Solicitud</label>
            <select id="tse_id" name="tse_id" class="form-control">
                <option value="">SELECCIONE..</option>
                <option value="1">Matrimonio</option>
                <option value="2">Licencia Temporal</option>
                <option value="3">Salida del Pais</option>
                <option value="4">Protocolo</option>
            </select>  
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-4">
            <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-info w-100">Buscar</button>
        </div>

    <!-- FULL CALENDAR -->
    <div class="col-lg-4">
        <button type="button" id="btnCalendario" name="btnCalendario" class="btn btn-info w-100">
            Ver Calendario
        </button>
    </div>


    <!-- Modal para el evento del FullCalendar -->
    <div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info text-white text-center">
                    <h4 class="modal-title" id="eventoModalLabel">Detalles del Evento</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido específico del evento -->
                    <div id="detalleEvento">
                        <h6 class="mb-3">Tipo de solicitud: <span id="detalleCombo" class="fw-bold"></span></h6>
                        <h6 class="mb-3">Fecha de Inicio de la actividad: <span id="detalleFechaInicio" class="fw-bold"></span></h6>
                        <h6 class="mb-3">Fecha de finalización de la actividad: <span id="detalleFechaFin" class="fw-bold"></span></h6>
                        <h6  class="mb-3">Lugar de la actividad: <span id="detalleLugar" class="fw-bold"></span></h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    </div>
</form>


<div class="row justify-content-center">
    <div id="dataTabla" class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaAdministracion" class="table table-bordered table-hover">
        </table>
    </div>
</div>


    <div id="calendario" class="">
        <div id='calendar'> 
        </div>
        <div style="max-width: 1000px; margin:auto" id='calendar'>
        </div>
    </div>

<div class="modal fade modal-xl" id="modalSalCorrecciones" tabindroleex="-1" role="dialog" aria-labelledby="modalSalCorreccionesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioSalidapais" name="formularioSalidapais" style="min-height: 50vh;">
                    <div id="divSalidas">
                        <div class="text-center">
                            <input value="3" type="hidden" id="tse_id" name="tse_id">
                            <h1>Solicitud de Salida del País</h1>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Solicitante</h2>
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <input value="" id="aut_id" name="aut_id" class="form-control" type="hidden">
                                <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                                <label for="ste_cat2">Catálogo</label>
                                <input value="" id="ste_cat2" name="ste_cat2" class="form-control" type="text" placeholder="Número de catálogo">
                                <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                                <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                                <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                                <input value="" id="ste_comando" name="ste_comando" class="form-control" type="hidden">
                            </div>

                            <div class="col-lg-6">
                                <label for="nombre">Nombres</label>
                                <input value="" id="nombre" name="nombre" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="ste_fecha2">Fecha de Solicitud</label>
                                <input value="<?php echo date('Y/m/d H:i')?>" id="ste_fecha2" name="ste_fecha2" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>

                            </div>
                            <div class="col-lg-6">
                                <label for="ste_telefono">Teléfono</label>
                                <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                            </div>
                        </div>
                        <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                        <input value="3" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                        <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="sol_motivo"><i class="bi bi-journal-check"></i>Motivos</label>
                                <select name="sol_motivo" id="sol_motivo" class="form-select">
                                    <option value=" " selected>Seleccione...</option>
                                    <?php foreach ($motivos as $motivo) { ?>
                                        <option value="<?= $motivo['mot_id'] ?>">
                                            <?= $motivo['mot_descripcion'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label for="sol_obs"><i class="bi bi-body-text"></i> Observaciones</label>
                                <input class="form-control" type="text" id="sol_obs" name="sol_obs" placeholder="Observaciones del viaje">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
                                <input value="" id="sal_autorizacion" name="sal_autorizacion" class="form-control" type="hidden">
                                <h2>Solicitud</h2>
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="sal_salida"><i class="bi bi-calendar-date-fill"></i>Fecha de la salida del país</label>
                                <input value="" id="sal_salida" name="sal_salida" class="form-control" type="date">
                            </div>
                            <div class="col-lg-6">
                                <label for="sal_ingreso"><i class="bi bi-calendar-date-fill"></i>Fecha del ingreso al país</label>
                                <input value="" id="sal_ingreso" name="sal_ingreso" class="form-control" type="date">
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div id="seleccion" class="col-lg-12">
                                <div class="row justify-content-around mb-4">
                                    <div id="" class="col-lg-12">
                                        <div id="masInputs" class="row">

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-12">
                                <iframe id="pdfSalidaPais" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-2">
                                <button type="button" id="modificarSalidas" name="modificarSalidas" class="btn btn-outline-warning w-100 overflow-visible text-wrap">Modificar</button>
                            </div>
                        </div>
                    </div>
                    <div id="divPdf" style="width: 75%;" class="mx-auto">
                        <div class="row justify-content-around mb-4">

                            <div class="col-lg-12">
                                <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                                <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                                <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-6">
                                <button type="button" id="addPdf" name="addPdf" class="btn btn-outline-primary w-100 overflow-visible text-wrap">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" id="cerrarModal" class="btn btn-danger W-40" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-xl" id="modalProtoCorrecciones" tabindex="-1" role="dialog" aria-labelledby="modalProtoCorreccionesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioProto" name="formularioProto" style="min-height: 50vh;">
                    <div id="Protocolo">
                        <div class="text-center">
                            <input value="4" type="hidden" id="tse_id" name="tse_id">
                            <h1>Solicitud de banda o combo musical, marimba y valla</h1>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Datos del solicitante</h3>
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <input value="" id="aut_id" name="aut_id" class="form-control" type="hidden">
                                <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                                <label for="ste_cat2"><i class="bi bi-universal-access"></i>Catálogo</label>
                                <input value="" id="ste_cat2" name="ste_cat2" class="form-control" type="number" placeholder="Número de catálogo">
                                <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                                <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                                <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                                <input value="" id="ste_comando" name="ste_comando" class="form-control" type="hidden">
                            </div>
                            <div class="col-lg-6">
                                <label for="nombre"><i class="bi bi-clipboard-data-fill"></i>Nombres y Apellidos</label>
                                <input value="" id="nombre" name="nombre" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha de la Solicitud</label>
                                    <input value="<?php echo date('Y/m/d H:i')?>" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                                <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number" placeholder="Número telefónico">
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="sol_motivo"><i class="bi bi-journal-check"></i>Motivos</label>
                                <select name="sol_motivo" id="sol_motivo" class="form-select">
                                    <option value=" " selected>Seleccione...</option>
                                    <?php foreach ($motivos as $motivo) { ?>
                                        <option value="<?= $motivo['mot_id'] ?>">
                                            <?= $motivo['mot_descripcion'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                            <input value="4" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                            <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">


                            <div class="col-lg-6">
                                <label for="sol_obs2"><i class="bi bi-body-text"></i> Observaciones</label>
                                <textarea class="form-control" id="sol_obs2" name="sol_obs2"></textarea>
                            </div>
                        </div>


                        <!-- Detalle de la solicitud -->
                        <div class="row">
                            <div class="col-lg-12">
                                <input value="" id="pco_id" name="pco_id" class="form-control" type="hidden">
                                <input value="" id="pco_autorizacion" name="pco_autorizacion" class="form-control" type="hidden">
                                <h3>Detalle de la Solicitud</h3>
                            </div>
                        </div>


                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_cmbv">Seleccione el Combo o banda musical, Marimba o valla</label>
                                <select name="pco_cmbv" id="pco_cmbv" class="form-control">
                                    <option value="">SELECCIONE SU REQUERIMIENTO</option>
                                    <?php foreach ($combos as $combo) : ?>
                                        <option value="<?= $combo['cmv_id'] ?>">
                                            <?= $combo['tipo'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_just">Justificación de la actividad:</label>
                                <input type="text" name="pco_just" id="pco_just" class="form-control" placeholder="Escriba la justificación de su requerimiento">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_fechainicio"><i class="bi bi-calendar-date-fill"></i>Fecha de inicio</label>
                                <input value="" id="pco_fechainicio" name="pco_fechainicio" class="form-control" type="datetime">
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_fechafin"><i class="bi bi-calendar-date-fill"></i>Fecha de finalización</label>
                                <input value="<?php echo date('Y/m/d H:i')?>" id="pco_fechafin" name="pco_fechafin" class="form-control" type="datetime">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_dir">Dirección de actividad:</label>
                                <input type="text" name="pco_dir" id="pco_dir" class="form-control" placeholder="Escriba la dirección de la actividad">
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_civil"></label>
                                <input value="" id="pco_civil" name="pco_civil" class="form-control" type="hidden">
                            </div>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-12">
                                <iframe id="pdfSalida" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-2">
                                <button type="button" id="modificarProtocolo" name="modificarProtocolo" class="btn btn-outline-warning w-100 overflow-visible text-wrap">Modificar</button>
                            </div>
                        </div>
                    </div>


                    <div id="pdf">
                        <div class="row justify-content-around mb-4">

                            <div class="col-lg-12">
                                <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                                <input value="" id="ste_catalogo" name="ste_catalogo" class="form-control" type="hidden" placeholder="Número de catálogo">
                                <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                                <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-6">
                                <button type="button" id="pdfProtocolo" name="pdfProtocolo" class="btn btn-outline-primary w-100 overflow-visible text-wrap">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-xl" id="modalCorrecionLicencias" tabindex="-1" role="dialog" aria-labelledby="modalCorrecionLicenciasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioLicenciasB" name="formularioLicenciasB" style="min-height: 50vh;">
                    <div id="licencias">
                        <div class="text-center">
                            <h1>Solicitud de Licencia Temporal</h1>
                        </div>

                        <div class="row justify-content-around mb-4">


                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Datos del solicitante</h2>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                                    <label for="ste_cat"><i class="bi bi-universal-access"></i>Catalogo</label>
                                    <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="numero de catalogo">
                                    <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                                    <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                                    <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                                    <input value="" id="ste_comando" name="ste_comando" class="form-control" type="hidden">
                                </div>
                                <div class="col-lg-6">
                                    <label for="ste_cat"><i class="bi bi-clipboard-data-fill"></i>Nombres y Apellidos</label>
                                    <input value="" id="nombre" name="nombre" class="form-control" type="Text">
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="ste_fecha2"><i class="bi bi-calendar-date-fill"></i>Fecha de la Solicitud</label>
                                    <input value="<?php echo date('Y/m/d H:i')?>" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                                <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number" placeholder="Número telefónico">
                            </div>
                        </div>
                                <div class="col-lg-6">
                                    <label for="sol_motivo"><i class="bi bi-journal-check"></i>Motivos</label>
                                    <select name="sol_motivo" id="sol_motivo" class="form-select">
                                        <option value=" " selected>Seleccione...</option>
                                        <?php foreach ($motivos as $motivo) { ?>
                                            <option value="<?= $motivo['mot_id'] ?>"><?= $motivo['mot_descripcion'] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                            <input value="2" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                            <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="sol_obs"><i class="bi bi-body-text"></i> Observaciones</label>
                                    <textarea class="form-control" type="text" id="sol_obs" name="sol_obs"></textarea>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col flex-1">
                                    <input value="" id="lit_id" name="lit_id" class="form-control" type="hidden">
                                    <input value="" id="lit_autorizacion" name="lit_autorizacion" class="form-control" type="hidden">
                                    <input value="" id="lit_articulo" name="lit_articulo" class="form-control" type="hidden">
                                    <h3>Detalle de la Solicitud</h3>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="tiempo_servicio"><i class="bi bi-calendar-date-fill"></i>Tiempo de Servicio</label>
                                    <input value="" id="tiempo_servicio" name="tiempo_servicio" class="form-control" type="text">
                                    <input value="" id="tiempo" name="tiempo" class="form-control" type="hidden">
                                </div>
                                <div class="col-lg-6">
                                    <label for="lit_mes_consueldo"><i class="bi bi-body-text"></i>Meses con Sueldo </label>
                                    <input value="" id="lit_mes_consueldo" name="lit_mes_consueldo" class="form-control" type="number" min="0" max="0">
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="lit_mes_sinsueldo"><i class="bi bi-body-text"></i>Meses sin Sueldo</label>
                                    <input id="lit_mes_sinsueldo" name="lit_mes_sinsueldo" class="form-control" type="number" type="number" min="0" max="0">
                                </div>
                                <div class="col-lg-6">
                                    <label for="lit_fecha1"><i class="bi bi-calendar-date-fill"></i>Inicio de licencia Temporal</label>
                                    <input value="" id="lit_fecha1" name="lit_fecha1" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="lit_fecha2"><i class="bi bi-calendar-date-fill"></i>Fin de licencia Temporal</label>
                                    <input value="" id="lit_fecha2" name="lit_fecha2" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-12 mb-4">
                                <div class="col-lg-12">
                                    <iframe id="pdfLicencia" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                                <div class="col-lg-2">
                                    <button type="button" id="modificarLicencia" name="modificarLicencia" class="btn btn-outline-warning w-100 overflow-visible text-wrap">Modificar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="divPdfLicencia">
                        <div class="row justify-content-around mb-4">

                            <div class="col-lg-12">
                                <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                                <input value="" id="ste_catalogo" name="ste_catalogo" class="form-control" type="hidden" placeholder="Número de catálogo">
                                <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                                <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-6">
                                <button type="button" id="pdfLicencias" name="pdfLicencias" class="btn btn-outline-primary w-100 overflow-visible text-wrap">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" id="btnCancelar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-xl " id="modalCorreccionCasamiento" tabindex="-1" role="dialog" aria-labelledby="modalCorreccionCasamientoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioCasamiento" name="formularioCasamiento" style="min-height: 50vh;" enctype="multipart/form-data">

                    <div class="text-center">
                        <input value="1" type="hidden" id="tse_id" name="tse_id">
                        <h1>Matrimonio</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Solicitante</h2>
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                            <label for="ste_cat">Catalogo</label>
                            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="text" placeholder="numero de catalogo">
                            <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                            <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                            <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                            <input value="" id="ste_comando" name="ste_comando" class="form-control" type="hidden">
                        </div>
                        <div class="col-lg-6">
                            <label for="nombre">Nombres</label>
                            <input value="" id="nombre" name="nombre" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="ste_fecha2"><i class="bi bi-calendar-date-fill"></i>Fecha de la Solicitud</label>
                                    <input value="<?php echo date('Y/m/d H:i')?>" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                                <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number" placeholder="Número telefónico">
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <input value="" id="mat_id" name="mat_id" class="form-control" type="hidden">

                            <h2>Solicitud</h2>
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="mat_lugar_civil">Lugar de la boda Civil</label>
                            <input value="" id="mat_lugar_civil" name="mat_lugar_civil" class="form-control" type="text">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_bodac">Fecha de la boda Civil</label>
                            <input value="" id="mat_fecha_bodac" name="mat_fecha_bodac" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_lugar_religioso">Lugar de la boda Religiosa</label>
                            <input value="" id="mat_lugar_religioso" name="mat_lugar_religioso" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="mat_fecha_bodar">Fecha de la boda Religiosa</label>
                            <input value="" id="mat_fecha_bodar" name="mat_fecha_bodar" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_ini">Inicio de la licencia</label>
                            <input value="" id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_fin">Finalizacion de la licencia</label>
                            <input value="" id="mat_fecha_lic_fin" name="mat_fecha_lic_fin" class="form-control" type="date">
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">

                        <div id="parejaCivil" class="col-lg-6">
                            <h1>Pareja</h1>
                            <input value="" type="hidden" name="mat_per_civil" id="mat_per_civil" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Nombres</label>
                            <input value="" type="text" name="parejac_nombres" placeholder="nombres" id="parejac_nombres" class="form-control">
                            <input value="" type="hidden" name="parejac_id" id="parejac_id" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Apellidos</label>
                            <input value="" type="text" name="parejac_apellidos" placeholder="apellidos" id="parejac_apellidos" class="form-control">
                            <label><i class="bi bi-house-door-fill"></i>Direccion</label>
                            <input value="" type="text" name="parejac_direccion" placeholder="direccion" id="parejac_direccion" class="form-control">
                            <label><i class="bi bi-key"></i>DPI</label>
                            <input value="" type="text" name="parejac_dpi" placeholder="DPI" id="parejac_dpi" class="form-control">
                        </div>

                        <div id="parejaMilitar" class="col-lg-6">
                            <h1>Pareja</h1>
                            <input value="" type="hidden" name="parejam_emp" id="parejam_emp" class="form-control">
                            <input value="" type="hidden" name="mat_per_army" id="mat_per_army" class="form-control">
                            <input value="" type="hidden" name="parejam_id" id="parejac_id" class="form-control">
                            <label> <i class="bi bi-key"></i> Catalogo</label>
                            <input value="" type="text" name="parejam_cat" id="parejam_cat" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Nombres</label>
                            <input value="" type="text" name="parejaNombre" id="parejaNombre" class="form-control">
                            <input value="" type="hidden" name="parejam_comando" id="parejam_comando" class="form-control">
                            <input value="" type="hidden" name="parejam_gra" id="parejam_gra" class="form-control">
                            <input value="" type="hidden" name="parejam_arm" id="parejam_arm" class="form-control">
                        </div>
                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-12">
                            <iframe id="pdfIframe" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-4 mt-12 mb-4">
                            <button type="click" id="btnModificaCasamiento" name="btnModificaCasamiento" class="btn btn-outline-warning w-100">Modificar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-md" id="modalPdfCorreccionCasamiento" tabindex="-1" role="dialog" aria-labelledby="modalPdfCorreccionCasamientoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioPdf" name="formularioPdf" style="min-height: 50vh;">

                    <div class="row justify-content-around mb-4">

                        <div class="col-lg-12">
                            <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                            <input value="" id="catalogo" name="catalogo" class="form-control" type="text" placeholder="Número de catálogo">
                            <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                            <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                            <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                        </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-6">
                                <button type="button" id="modificarPdfCas" name="modificarPdfCas" class="btn btn-outline-primary w-100 overflow-visible text-wrap">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" id="btnCancelar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    const divInpust = document.getElementById('masInputs');
    var paisesData = <?php echo json_encode($paises); ?>;
    var transporteData = <?php echo json_encode($transportes); ?>;
    const borrarTodo = (e) => {
        e.preventDefault()
        divInpust.innerHTML = ''

    };
</script>

<script src="./build/js/administraciones/index.js"></script>