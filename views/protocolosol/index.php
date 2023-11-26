<div class="row justify-content-center mt-5">
    <div class="col-lg-10">
        <!-- Solicitud -->
        <form class="border bg-light p-5" id="formularioProtocolo">
            <div>
                <div class="text-center">
                    <h2 class="text-center">Solicitud de banda o combo musical, marimba y valla</h2>
                </div>
                <br>
                <!-- Datos del personal solicitante -->
                <div class="row justify-content-around mb-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Datos del solicitante</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <input value="" id="aut_id" name="aut_id" class="form-control" type="hidden">
                        <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                        <label for="ste_cat"><i class="bi bi-universal-access"></i>Catálogo</label>
                        <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo" required>
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
                        <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha de Solicitud</label>
                        <input value="<?php echo date('d/m/Y H:i')?>" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>
                    </div>
                    <div class="col-lg-6">
                        <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                        <input id="ste_telefono" name="ste_telefono" class="form-control" type="number" placeholder="Número telefónico" required>
                    </div>
                </div>

                <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                <input value="4" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

                <div class="row justify-content-around mb-4">
                    <div class="col-lg-6">
                        <label for="sol_motivo"><i class="bi bi-journal-check"></i>Motivos</label>
                        <select name="sol_motivo" id="sol_motivo" class="form-select" required>
                            <option value=" " selected>Seleccione...</option>
                            <?php foreach ($motivos as $motivo) { ?>
                                <option value="<?= $motivo['mot_id'] ?>"><?= $motivo['mot_descripcion'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="sol_obs"><i class="bi bi-body-text"></i> Observaciones</label>
                        <textarea class="form-control"  id="sol_obs" name="sol_obs" placeholder="Ingrese sus obserciones, si no tiene, colocar SIN OBSERVACION" required></textarea>
                    </div>
                </div>

                <!-- Datos del oficial que autoriza la solicitud -->
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Oficial que autoriza</h3>
                    </div>
                </div>
                <div class="row justify-content-around mb-4">
                    <div class="col-lg-4">
                        <input value="" id="aut_solicitud" name="aut_solicitud" class="form-control" type="hidden">
                        <label for="aut_cat"><i class="bi bi-universal-access"></i>Catálogo</label>
                        <input value="" id="aut_cat" name="aut_cat" class="form-control" type="number" placeholder="Número de catálogo" required>
                        <input value="" id="aut_gra" name="aut_gra" class="form-control" type="hidden">
                        <input value="" id="aut_arm" name="aut_arm" class="form-control" type="hidden">
                        <input value="" id="aut_emp" name="aut_emp" class="form-control" type="hidden">
                        <input value="" id="aut_comando" name="aut_comando" class="form-control" type="hidden">
                    </div>
                    <div class="col-lg-4">
                        <label for="nombre2"><i class="bi bi-clipboard-data-fill"></i>Nombres y Apellidos</label>
                        <input value="" id="nombre2" name="nombre2" class="form-control" type="text">
                    </div>
                    <div class="col-lg-4">
                        <label for="aut_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha</label>
                        <input value="" id="aut_fecha" name="aut_fecha" class="form-control" type="date" required>
                    </div>
                </div>

                <!-- Solicitud de protocolo -->
                <div class="row justify-content-around mb-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <input value="" id="pco_id" name="pco_id" class="form-control" type="hidden">
                            <input value="" id="pco_autorizacion" name="pco_autorizacion" class="form-control" type="hidden">
                            <h3>Detalle de la Solicitud</h3>
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="pco_cmbv">Seleccione el Combo o banda musical, Marimba o valla</label>
                            <select name="pco_cmbv" id="pco_cmbv" class="form-control">
                                <option value="" selected>Seleccione su requerimiento...</option>
                                <?php foreach ($combos as $combo): ?>
                                    <option value="<?= $combo['cmv_id'] ?>">
                                        <?= $combo['tipo'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="pco_just"><i class="bi bi-body-text"></i>Justificación de la actividad:</label>
                            <input type="text" name="pco_just" id="pco_just" class="form-control" placeholder="Escriba la justificación de su requerimiento" required>
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="pco_fechainicio"><i class="bi bi-calendar-date-fill"></i>Fecha de inicio</label>
                            <input value="" id="pco_fechainicio" name="pco_fechainicio" class="form-control" type="date" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="pco_fechafin"><i class="bi bi-calendar-date-fill"></i>Fecha de finalización</label>
                            <input value="" id="pco_fechafin" name="pco_fechafin" class="form-control" type="date" required>
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="pco_dir"><i class="bi bi-geo-fill"></i>Dirección de actividad:</label>
                            <input type="text" name="pco_dir" id="pco_dir" class="form-control" placeholder="Escriba la dirección de la actividad" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="pco_civil"></label>
                            <input value="" id="pco_civil" name="pco_civil" class="form-control" type="hidden">
                        </div>
                    </div>
                    <div class="col-lg-6">
                            <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                            <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file" required>
                            <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                            <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                        </div>
                    </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-2">
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-outline-primary w-100">Guardar</button>
                            </div>
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="./build/js/protocolosol/index.js"></script>
