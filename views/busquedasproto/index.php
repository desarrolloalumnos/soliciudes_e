<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<form class="border bg-light p-4 mt-4 mx-auto w-75" id="formularioProtocolo" name="formularioProtocolo"
    style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Solicitud de banda o combo musical, marimba y valla</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat" class="form-label"><i class="bi bi-universal-access"></i> Catálogo</label>
            <input id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo"
                required>
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha" class="form-label"><i class="bi bi-calendar-date-fill"></i> Fecha de la
                Solicitud</label>
            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-4">
            <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-info w-100">Buscar</button>
        </div>
        <div class="col-lg-4">
            <button type="button" id="btnCalendario" name="btnCalendario" class="btn btn-info w-100">Ver
                Calendario</button>
        </div>
    </div>
</form>

<br>


<div id="dataTabla" class="col table-responsive mx-auto my-auto" style="max-width: 80%; padding: 10px;">
    <table id="tablaProtocolo" class="table table-bordered table-hover" style="width: 100%;">
    </table>
</div>



<div id="calendario">
    <div style="max-width: 1000px; margin:auto" id='calendar'></div>
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
                <form class="border bg-light p-5" id="formularioEvento">
                    <div class="text-center">
                        <h2>Solicitud de banda, combo musical, marimba y valla</h2>
                    </div>
                    <br>
                    <!-- Datos del personal solicitante -->
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-12">
                            <h3>Datos del solicitante</h3>
                        </div>
                        <div class="col-lg-6">
                            <input type="hidden" id="aut_id" name="aut_id" class="form-control">
                            <input type="hidden" name="ste_id" id="ste_id" class="form-control">
                            <label for="ste_cat"><i class="bi bi-universal-access"></i> Catálogo</label>
                            <input id="ste_cat" name="ste_cat" class="form-control" type="number"
                                placeholder="Número de catálogo" disabled>
                            <input type="hidden" id="ste_gra" name="ste_gra" class="form-control">
                            <input type="hidden" id="ste_arm" name="ste_arm" class="form-control">
                            <input type="hidden" id="ste_emp" name="ste_emp" class="form-control">
                            <input type="hidden" id="ste_comando" name="ste_comando" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="nombre"><i class="bi bi-clipboard-data-fill"></i> Nombres y Apellidos</label>
                            <input id="nombre" name="nombre" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
                            <input value="<?php echo date('Y-m-d H:i') ?>" id="ste_fecha" name="ste_fecha"
                                class="form-control" type="datetime-local" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i> Teléfono</label>
                            <input id="ste_telefono" name="ste_telefono" class="form-control" type="number"
                                placeholder="Número telefónico" disabled>
                        </div>
                    </div>

                    <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                    <input value="4" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                    <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                    <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="sol_motivo"><i class="bi bi-journal-check"></i>Motivos</label>
                            <select name="sol_motivo" id="sol_motivo" class="form-select" disabled>
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
                            <textarea class="form-control" id="sol_obs" name="sol_obs"
                                placeholder="Ingrese sus obserciones, si no tiene, colocar SIN OBSERVACION"
                                disabled></textarea>
                        </div>
                    </div>

                    <!-- Solicitud de protocolo -->
                    <div class="row justify-content-around mb-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <input value="" id="pco_id" name="pco_id" class="form-control" type="hidden">
                                <input value="" id="pco_autorizacion" name="pco_autorizacion" class="form-control"
                                    type="hidden">
                                <h3>Detalle de la Solicitud</h3>
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_cmbv">Seleccione el Combo o banda musical, Marimba o valla</label>
                                <select name="pco_cmbv" id="pco_cmbv" class="form-control" disabled>
                                    <option value="" selected>Seleccione su requerimiento...</option>
                                    <?php foreach ($combos as $combo): ?>
                                        <option value="<?= $combo['cmv_id'] ?>">
                                            <?= $combo['tipo'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_just"><i class="bi bi-body-text"></i>Justificación de la
                                    actividad:</label>
                                <input type="text" name="pco_just" id="pco_just" class="form-control"
                                    placeholder="Escriba la justificación de su requerimiento" disabled>
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_fechainicio"><i class="bi bi-calendar-date-fill"></i>Fecha de
                                    inicio</label>
                                <input value="<?php echo date('Y-m-d H:i') ?>" id="pco_fechainicio"
                                    name="pco_fechainicio" class="form-control" type="datetime-local" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_fechafin"><i class="bi bi-calendar-date-fill"></i>Fecha de
                                    finalización</label>
                                <input value="<?php echo date('Y-m-d H:i') ?>" id="pco_fechafin" name="pco_fechafin"
                                    class="form-control" type="datetime-local" disabled>
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_dir"><i class="bi bi-geo-fill"></i>Dirección de actividad:</label>
                                <input type="text" name="pco_dir" id="pco_dir" class="form-control"
                                    placeholder="Escriba la dirección de la actividad" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_civil"></label>
                                <input value="" id="pco_civil" name="pco_civil" class="form-control" type="hidden">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <iframe id="pdfSalidaEvento" title="PDF" class="text-center" width="100%" height="500px"
                                src=""></iframe>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<!-- Modal para modificar la solicitud -->
<div class="modal fade modal-xl" id="modalProtocolo" tabindex="-1" role="dialog" aria-labelledby="modalProtocoloLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioProto" name="formularioProto" style="min-height: 50vh;">
                    <div id="Protocolo">
                        <div class="text-center">
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
                                <input value="" id="ste_cat2" name="ste_cat2" class="form-control" type="number"
                                    placeholder="Número de catálogo">
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
                                <label for="ste_fecha2"><i class="bi bi-calendar-date-fill"></i>Fecha de
                                    Solicitud</label>
                                <input value="<?php echo date('Y/m/d H:i') ?>" value="" id="ste_fecha2" name="ste_fecha2"
                                    class="form-control" type="datetime">
                            </div>
                            <div class="col-lg-6">
                                <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                                <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number"
                                    placeholder="Número telefónico">
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
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante"
                                class="form-control">
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
                                <input value="" id="pco_autorizacion" name="pco_autorizacion" class="form-control"
                                    type="hidden">
                                <h3>Detalle de la Solicitud</h3>
                            </div>
                        </div>


                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_cmbv">Seleccione el Combo o banda musical, Marimba o valla</label>
                                <select name="pco_cmbv" id="pco_cmbv" class="form-control">
                                    <option value="">SELECCIONE SU REQUERIMIENTO</option>
                                    <?php foreach ($combos as $combo): ?>
                                        <option value="<?= $combo['cmv_id'] ?>">
                                            <?= $combo['tipo'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_just">Justificación de la actividad:</label>
                                <input type="text" name="pco_just" id="pco_just" class="form-control"
                                    placeholder="Escriba la justificación de su requerimiento">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_fechainicio"><i class="bi bi-calendar-date-fill"></i>Fecha de
                                    inicio</label>
                                <input value="" id="pco_fechainicio" name="pco_fechainicio" class="form-control"
                                    type="date">
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_fechafin"><i class="bi bi-calendar-date-fill"></i>Fecha de
                                    finalización</label>
                                <input value="" id="pco_fechafin" name="pco_fechafin" class="form-control" type="date">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_dir">Dirección de actividad:</label>
                                <input type="text" name="pco_dir" id="pco_dir" class="form-control"
                                    placeholder="Escriba la dirección de la actividad">
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_civil"></label>
                                <input value="" id="pco_civil" name="pco_civil" class="form-control" type="hidden">
                            </div>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-12">
                                <iframe id="pdfSalida" title="PDF" class="text-center" width="100%" height="500px"
                                    src=""></iframe>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-2">
                                <button type="button" id="modificar" name="modificar"
                                    class="btn btn-outline-warning w-100 overflow-visible text-wrap">Modificar</button>
                            </div>
                        </div>
                    </div>


                    <div id="pdf">
                        <div class="row justify-content-around mb-4">

                            <div class="col-lg-12">
                                <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                                <input value="" id="ste_catalogo" name="ste_catalogo" class="form-control" type="hidden"
                                    placeholder="Número de catálogo">
                                <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control"
                                    type="hidden">
                                <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-6">
                                <button type="button" id="addPdf" name="addPdf"
                                    class="btn btn-outline-primary w-100 overflow-visible text-wrap">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="./build/js/busquedasproto/index.js"></script>