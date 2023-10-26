<div class="row justify-content-center mt-5">

    <div class="col-lg-10">
        <div id="carouselProtocolo" class="carousel slide">

            <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselProtocolo" data-bs-slide-to="0"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" data-bs-target="#carouselProtocolo" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>

            <form class="carousel-inner border bg-light p-4" id="formularioProtocolo" style="min-height: 50vh;">
                <div class="text-center">
                    <h2 class="text-center">Solicitud de banda o combo musical, marimba y valla</h2>
                    <input value="" id="pvc_id" name="pvc_id" class="form-control" type="hidden">
                </div>
                <br>
                <!-- Datos del personal solicitante -->

                <div class="carousel-item active">
                    <div class="row justify-content-around mb-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3>Datos del personal solicitante</h3>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <input value="text" id="mat_autorizacion" name="mat_autorizacion" class="form-control"
                                type="hidden">
                            <input value="text" id="aut_id" name="aut_id" class="form-control" type="hidden">
                            <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                            <label for="ste_id">Catalogo</label>
                            <label for="ste_cat">Catalogo</label>
                            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number"
                                placeholder="Número de catalogo">
                            <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                            <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                            <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                            <input value="" id="ste_comando" name="ste_comando" class="form-control" type="hidden">
                        </div>
                        <div class="col-lg-6">
                            <label for="ste_cat">Nombres y Apellidos</label>
                            <input value="" id="nombre" name="nombre" class="form-control" type="Text">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="ste_fecha">Fecha de Solicitud</label>
                            <input value="" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime-local">

                        </div>
                        <div class="col-lg-6">
                            <label for="ste_telefono">Teléfono</label>
                            <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                        </div>

                    </div>

                    <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                    <input value="1" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                    <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <select name="sol_motivo" id="sol_motivo" class="form-select" style="display: none">
                                <option value="1" selected>Matrimonio</option>
                                <option value="2" selected>Eventos festivos</option>
                                <?php foreach ($motivos as $motivo) { ?>
                                    <option value="<?= $motivo['mot_id'] ?>">
                                        <?= $motivo['mot_descripcion'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control"
                                placeholder="Si el motivo es la opción 'OTROS' llene la observación" type="hidden"
                                name="sol_obs" id="sol_obs" rows="10" cols="50">
                        </div>
                    </div>


                    <!-- Datos del oficial que autoriza la solicitud -->

                    <div class="row ">
                        <div class="col-lg-8">
                            <h3>Oficial que autoriza</h3>
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <input value="" id="aut_solicitud" name="aut_solicitud" class="form-control" type="hidden">
                            <label for="aut_cat">Catalogo</label>
                            <input value="" id="aut_cat" name="aut_cat" class="form-control" type="text">
                            <input value="" id="aut_gra" name="aut_gra" class="form-control" type="hidden">
                            <input value="" id="aut_arm" name="aut_arm" class="form-control" type="hidden">
                            <input value="" id="aut_emp" name="aut_emp" class="form-control" type="hidden">
                            <input value="" id="aut_comando" name="aut_comando" class="form-control" type="hidden">
                        </div>
                        <div class="col-lg-4">
                            <label for="nombre2">Nombres y Apellidos</label>
                            <input value="" id="nombre2" name="nombre2" class="form-control" type="text">
                        </div>
                        <div class="col-lg-4">
                            <label for="aut_fecha">Fecha</label>
                            <input value="" id="aut_fecha" name="aut_fecha" class="form-control" type="datetime-local">
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- Solicitud de protocolo -->

    <div class="carousel-item ">
        <div class="row">
            <div class="col flex-1">
                <input value="" id="pco_id" name="pco_id" class="form-control" type="hidden">
                <input value="" id="pco_autorizacion" name="pco_autorizacion" class="form-control" type="hidden">
                <h2>Solicitud</h2>
            </div>
        </div>


        <div class="row justify-content-around mb-4">
            <div class="col-lg-4">

                <label for="pco_cmbv">Seleccione el Combo o banda musical, Marimba o valla</label>
                <select name="pco_cmbv" id="pco_cmbv" class="form-control">
                    <option value="">SELECCIONE...</option>
                    <?php foreach ($combos as $combo): ?>
                        <option value="<?= $combo['cmv_id'] ?>">
                            <?= $combo['cmv_tip'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

            </div>
        </div>
        <div class="col-md-6">
            <label for="pco_fechainicio">Fecha y hora de inicio de la actividad:</label>
            <input type="datetime-local" name="pco_fechainicio" id="pco_fechainicio" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="pco_fechafin">Fecha y hora de finalización de la actividad:</label>
            <input type="datetime-local" name="pco_fechafin" id="pco_fechafin" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="pco_dir">Dirección donde se ralizará la actividad:</label>
            <input type="text" name="pco_dir" id="pco_dir" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="pco_just">Escriba la justificación de la actividad:</label>
            <input type="text" name="pco_just" id="pco_just" class="form-control">
        </div>
    </div>

    <div class="row justify-content-center mt-12 mb-4">

        <div class="col-lg-4">
            <label for="mat_fecha_bodar">Documentos PDF</label>
            <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
            <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
            <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
        </div>

    </div>


   <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-2">
                            <button type="button" id="btnGuardar" name="btnGuardar" data-bs-target="#carouselProtocolo" class="btn btn-outline-primary w-100">Guardar</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btnBuscar" name="btnBuscar" data-bs-target="#carouselProtocolo" class="btn btn-outline-info w-100">Buscar</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btnModificar" name="btnModificar" data-bs-target="#carouselProtocolo" class="btn btn-outline-warning w-100">Modificar</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btnCancelar" name="btnCancelar" data-bs-target="#carouselProtocolo" class="btn btn-outline-danger w-100">Cancelar</button>
                        </div>
                    </div>
                </div>
        </div>

        </form>
    </div>
</div>

<script src="./build/js/protocolosol/index.js"></script>