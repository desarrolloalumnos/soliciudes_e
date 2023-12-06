<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<form class="border bg-light p-4 mt-4 mx-auto w-75" id="formularioDepersonal" name="formularioDepersonal"
    style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Solicitudes Ingresadas</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"> <i class="bi bi-universal-access"></i>Catálogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number"
                placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">
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

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <button type="button" id="btnBuscar" name="btnBuscar"
                class="btn btn-outline-info w-100 overflow-visible text-wrap">Buscar</button>
        </div>
        <div class="col-lg-4">
            <button type="button" id="btnCalendario" name="btnCalendario" class="btn btn-info w-100">Ver
                Calendario</button>
        </div>
    </div>
</form>


<br>

    <div class="col table-responsive" id="dataTabla" style="width: 100%; padding: 10px;">
    <table id="tablaDepersonal" class="table table-bordered table-hover" style="width: 100%;">
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

                    <div class="row justify-content-center mt-4 mb-4">
                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade modal-xl" id="modal1" tabindroleex="-1" role="dialog" aria-labelledby="modal1Label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioSalidapais" name="formularioSalidapais"
                    style="min-height: 50vh;">
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
                                <input value="" id="ste_cat2" name="ste_cat2" class="form-control" type="text"
                                    placeholder="Número de catálogo">
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
                                <input value="<?php echo date('Y/m/d H:i') ?>" id="ste_fecha2" name="ste_fecha2"
                                    class="form-control" type="datetime" disabled>

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
                                <input class="form-control" type="text" id="sol_obs" name="sol_obs"
                                    placeholder="Observaciones del viaje">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
                                <input value="" id="sal_autorizacion" name="sal_autorizacion" class="form-control"
                                    type="hidden">
                                <h2>Solicitud</h2>
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="sal_salida"><i class="bi bi-calendar-date-fill"></i>Fecha de la salida del
                                    país</label>
                                <input value="" id="sal_salida" name="sal_salida" class="form-control" type="date">
                            </div>
                            <div class="col-lg-6">
                                <label for="sal_ingreso"><i class="bi bi-calendar-date-fill"></i>Fecha del ingreso al
                                    país</label>
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
                                <iframe id="pdfSalidaPais" title="PDF" class="text-center" width="100%" height="500px"
                                    src=""></iframe>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center mt-12 mt-4 mb-4">
                    <div class="col-lg-2">
                        <button id="aceptarFormularioSalida" name="aceptarFormularioSalida"
                            class="btn btn-primary">Elevar Solicitud</button>
                    </div>
                    <div class="col-lg-2">
                        <button id="corregirFormularioSalida" name="corregirFormularioSalida"
                            class="btn btn-warning">Corregir</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="cerrarModal" class="btn btn-danger W-40" data-bs-dismiss="modal"
                        onclick="borrarTodo(event)">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-xl" id="modalProto" tabindex="-1" role="dialog" aria-labelledby="modalProtoLabel"
    aria-hidden="true">
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
                                <input value="<?php echo date('Y/m/d H:i') ?>" id="ste_fecha2" name="ste_fecha2"
                                    class="form-control" type="datetime" disabled>
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
                    </div>
                </form>
                <div class="row justify-content-center mt-12 mt-4 mb-4">
                    <div class="col-lg-2">
                        <button id="aceptarFormularioCombo" name="aceptarFormularioCombo" class="btn btn-primary">Elevar
                            Solicitud</button>
                    </div>
                    <div class="col-lg-2">
                        <button id="corregirFormularioCombo" name="corregirFormularioCombo"
                            class="btn btn-warning">Corregir</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-xl " id="modalCasamiento" tabindex="-1" role="dialog"
    aria-labelledby="modalCasamientoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioCasamiento" name="formularioCasamiento"
                    style="min-height: 50vh;" enctype="multipart/form-data">

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
                            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="text"
                                placeholder="numero de catalogo">
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
                            <label for="ste_fecha">Fecha de Solicitud</label>
                            <input value="<?php echo date('Y/m/d H:i') ?>" id="ste_fecha" name="ste_fecha"
                                class="form-control" type="datetime">

                        </div>
                        <div class="col-lg-6">
                            <label for="ste_telefono">Telefono</label>
                            <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
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
                            <input value="" id="mat_lugar_civil" name="mat_lugar_civil" class="form-control"
                                type="text">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_bodac">Fecha de la boda Civil</label>
                            <input value="" id="mat_fecha_bodac" name="mat_fecha_bodac" class="form-control"
                                type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_lugar_religioso">Lugar de la boda Religiosa</label>
                            <input value="" id="mat_lugar_religioso" name="mat_lugar_religioso" class="form-control"
                                type="text">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="mat_fecha_bodar">Fecha de la boda Religiosa</label>
                            <input value="" id="mat_fecha_bodar" name="mat_fecha_bodar" class="form-control"
                                type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_ini">Inicio de la licencia</label>
                            <input value="" id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control"
                                type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_fin">Finalizacion de la licencia</label>
                            <input value="" id="mat_fecha_lic_fin" name="mat_fecha_lic_fin" class="form-control"
                                type="date">
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">

                        <div id="parejaCivil" class="col-lg-6">
                            <h1>Pareja</h1>
                            <input value="" type="hidden" name="mat_per_civil" id="mat_per_civil" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Nombres</label>
                            <input value="" type="text" name="parejac_nombres" placeholder="nombres"
                                id="parejac_nombres" class="form-control">
                            <input value="" type="hidden" name="parejac_id" id="parejac_id" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Apellidos</label>
                            <input value="" type="text" name="parejac_apellidos" placeholder="apellidos"
                                id="parejac_apellidos" class="form-control">
                            <label><i class="bi bi-house-door-fill"></i>Direccion</label>
                            <input value="" type="text" name="parejac_direccion" placeholder="direccion"
                                id="parejac_direccion" class="form-control">
                            <label><i class="bi bi-key"></i>DPI</label>
                            <input value="" type="text" name="parejac_dpi" placeholder="DPI" id="parejac_dpi"
                                class="form-control">
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
                            <input value="" type="hidden" name="parejam_comando" id="parejam_comando"
                                class="form-control">
                            <input value="" type="hidden" name="parejam_gra" id="parejam_gra" class="form-control">
                            <input value="" type="hidden" name="parejam_arm" id="parejam_arm" class="form-control">
                        </div>
                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-12">
                            <iframe id="pdfIframe" title="PDF" class="text-center" width="100%" height="500px"
                                src=""></iframe>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center mt-12 mt-4 mb-4">
                    <div class="col-lg-2">
                        <button id="aceptarFormulario" name="aceptarFormulario" class="btn btn-primary">Elevar
                            Solicitud</button>
                    </div>
                    <div class="col-lg-2">
                        <button id="corregirFormulario" name="corregirFormulario"
                            class="btn btn-warning">Corregir</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-xl" id="modalMostrarLicencias" tabindex="-1" role="dialog"
    aria-labelledby="modalMostrarLicenciasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioLicenciasB" name="formularioLicenciasB"
                    style="min-height: 50vh;">
                    <div id="licencias">
                        <div class="text-center">
                            <h1>Licencia Temporal</h1>
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
                                    <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number"
                                        placeholder="numero de catalogo">
                                    <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                                    <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                                    <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                                    <input value="" id="ste_comando" name="ste_comando" class="form-control"
                                        type="hidden">
                                </div>
                                <div class="col-lg-6">
                                    <label for="ste_cat"><i class="bi bi-clipboard-data-fill"></i>Nombres y
                                        Apellidos</label>
                                    <input value="" id="nombre" name="nombre" class="form-control" type="Text">
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha de
                                        Solicitud</label>
                                    <input value="<?php echo date('Y/m/d H:i') ?>" id="ste_fecha" name="ste_fecha"
                                        class="form-control" type="datetime" placeholder="Fecha de la solicitud"
                                        disabled>
                                </div>

                                <div class="col-lg-6">
                                    <label for="ste_telefono"><i
                                            class="bi bi-telephone-inbound-fill"></i>Telefono</label>
                                    <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                                </div>
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

                            </div>
                            <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                            <input value="2" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante"
                                class="form-control">
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
                                    <input value="" id="lit_autorizacion" name="lit_autorizacion" class="form-control"
                                        type="hidden">
                                    <input value="" id="lit_articulo" name="lit_articulo" class="form-control"
                                        type="hidden">
                                    <h2>Solicitud</h2>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="tiempo_servicio"><i class="bi bi-calendar-date-fill"></i>Tiempo de
                                        Servicio</label>
                                    <input value="" id="tiempo_servicio" name="tiempo_servicio" class="form-control"
                                        type="text">
                                    <input value="" id="tiempo" name="tiempo" class="form-control" type="hidden">
                                </div>
                                <div class="col-lg-6">
                                    <label for="lit_mes_consueldo"><i class="bi bi-body-text"></i>Meses con Sueldo
                                    </label>
                                    <input value="" id="lit_mes_consueldo" name="lit_mes_consueldo" class="form-control"
                                        type="number" min="0" max="0">
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="lit_mes_sinsueldo"><i class="bi bi-body-text"></i>Meses sin
                                        Sueldo</label>
                                    <input id="lit_mes_sinsueldo" name="lit_mes_sinsueldo" class="form-control"
                                        type="number" type="number" min="0" max="0">
                                </div>
                                <div class="col-lg-6">
                                    <label for="lit_fecha1"><i class="bi bi-calendar-date-fill"></i>Inicio de licencia
                                        Temporal</label>
                                    <input value="" id="lit_fecha1" name="lit_fecha1" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="lit_fecha2"><i class="bi bi-calendar-date-fill"></i>Fin de licencia
                                        Temporal</label>
                                    <input value="" id="lit_fecha2" name="lit_fecha2"
                                        class="form-control" type="date">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-12 mb-4">
                                <div class="col-lg-12">
                                    <iframe id="pdfLicencia" title="PDF" class="text-center" width="100%" height="500px"
                                        src=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center mt-12 mt-4 mb-4">
                    <div class="col-lg-2">
                        <button id="aceptarFormularioLicencia" name="aceptarFormularioLicencia"
                            class="btn btn-primary">Elevar Solicitud</button>
                    </div>
                    <div class="col-lg-2">
                        <button id="corregirFormularioLicencia" name="corregirFormularioLicencia"
                            class="btn btn-warning">Corregir</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" id="btnCancelar"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-xl" id="modalAceptar" tabindex="-1" role="dialog" aria-labelledby="modalAceptarLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioValidar" name="formularioValidar"
                    style="min-height: 50vh;">
                    <div id="autorizarSolicitud">
                        <div class="text-center">
                            <h1>Autorizar</h1>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-4">
                                <input value="" id="aut_solicitud2" name="aut_solicitud2" class="form-control"
                                    type="hidden">
                                <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                                <label for="aut_cat2"><i class="bi bi-universal-access">Catalogo</i></label>
                                <input value="" id="aut_cat2" name="aut_cat2" class="form-control" type="number"
                                    placeholder="numero de catalogo">
                                <input value="" id="aut_gra2" name="aut_gra2" class="form-control" type="hidden">
                                <input value="" id="aut_arm2" name="aut_arm2" class="form-control" type="hidden">
                                <input value="" id="aut_emp2" name="aut_emp2" class="form-control" type="hidden">
                                <input value="" id="aut_comando2" name="aut_comando2" class="form-control"
                                    type="hidden">
                            </div>
                            <div class="col-lg-4">
                                <label for="nombre2"><i class="bi bi-clipboard-data-fill"></i>Nombres y
                                    Apellidos</label>
                                <input value="" id="nombre2" name="nombre2" class="form-control" type="text">
                            </div>
                            <div class="col-lg-4">
                                <label for="aut_fecha2"><i class="bi bi-calendar-date-fill"></i>Fecha</label>
                                <input value="<?php echo date('Y/m/d H:i') ?>" id="aut_fecha2" name="aut_fecha2"
                                    class="form-control" type="datetime" disabled>
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="aut_obs2"><i class="bi bi-body-text"></i> Observaciones</label>
                                <textarea class="form-control" id="aut_obs2" name="aut_obs2"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mt-4 mb-4">
                            <div class="col-lg-2">
                                <button id="guardarAutorizacion" name="guardarAutorizacion"
                                    class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                    <div id="corregirSolicitud">
                        <div class="text-center">
                            <h1>Corregir</h1>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-4">

                                <label for="aut_catalogo"><i class="bi bi-universal-access">Catalogo</i></label>
                                <input value="" id="aut_catalogo" name="aut_catalogo" class="form-control" type="number" placeholder="numero de catalogo">
                                <input value="" id="aut_gra" name="aut_gra" class="form-control" type="hidden">
                                <input value="" id="aut_arm" name="aut_arm" class="form-control" type="hidden">
                                <input value="" id="aut_emp" name="aut_emp" class="form-control" type="hidden">
                                <input value="" id="aut_comando" name="aut_comando" class="form-control" type="hidden">
                            </div>
                            <div class="col-lg-4">
                                <label for="nombre_autorizador"><i class="bi bi-clipboard-data-fill"></i>Nombres y Apellidos</label>
                                <input value="" id="nombre_autorizador" name="nombre_autorizador" class="form-control"type="text">
                            </div>
                            <div class="col-lg-4">
                                <label for="aut_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha</label>
                                <input value="<?php echo date('Y/m/d H:i') ?>" id="aut_fecha" name="aut_fecha" class="form-control" type="datetime" disabled>
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="aut_obs"><i class="bi bi-body-text"></i> Observaciones</label>
                                <textarea class="form-control" id="aut_obs" name="aut_obs"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mt-4 mb-4">
                            <div class="col-lg-2">
                                <button id="guardarCorreccion" name="guardarCorreccion" class="btn btn-primary">Guardar</button>
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

<script>
    const divInpust = document.getElementById('masInputs');
    var paisesData = <?php echo json_encode($paises); ?>;
    var transporteData = <?php echo json_encode($transportes); ?>;
    const borrarTodo = (e) => {
        e.preventDefault()
        divInpust.innerHTML = ''

    };
</script>

<script src="./build/js/direccionpersonal/index.js"></script>