<div class="row justify-content-center mt-5 mx-auto w-75">

    <div class="col-lg-10">
        <div id="carouselLicencia" class="carousel slide">

            <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselLicencia" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" id="botonSlide2" data-bs-target="#carouselLicencia" data-bs-slide-to="1" aria-label="Slide 2"></button>

            </div>
            <form class="carousel-inner border bg-light p-4" id="formularioLicencias" name="formularioLicencias" style="min-height: 50vh;">
                <div class="text-center">
                <h2 class="text-center">Licencia Temporal</h2>
                </div>
                <br>
                <div class="carousel-item active">
                    <div class="row justify-content-around mb-4">
                        <div class="row">

                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Datos del solicitante</h3>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <input value="" id="aut_id" name="aut_id" class="form-control" type="hidden">
                                    <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                                    <label for="ste_cat"><i class="bi bi-universal-access"></i>Catálogo</label>
                                    <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
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
                                    <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha de Solicitud</label>
                                    <input value="<?php echo date('Y/m/d H:i')?>" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>

                                </div>
                                <div class="col-lg-6">
                                    <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                                    <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                                </div>

                            </div>
                            <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                            <input value="2" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                            <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="sol_motivo"><i class="bi bi-journal-check"></i>Motivos</label>
                                    <select name="sol_motivo" id="sol_motivo" class="form-select">
                                        <option value=" " selected>Seleccione...</option>
                                        <?php foreach ($motivos as $motivo) { ?>
                                            <option value="<?= $motivo['mot_id'] ?>"><?= $motivo['mot_descripcion'] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="sol_obs"><i class="bi bi-body-text"></i> Observaciones</label>
                                    <textarea class="form-control"  id="sol_obs" name="sol_obs"></textarea>
                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-lg-8">
                                    <h3>Oficial que autoriza</h3>
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-4">
                                    <input value="" id="aut_solicitud" name="aut_solicitud" class="form-control" type="hidden">
                                    <label for="aut_cat"><i class="bi bi-universal-access">Catálogo</i></label>
                                    <input value="<?php echo $aut_cat; ?>" id="aut_cat" name="aut_cat" class="form-control" type="number" placeholder="Número de catálogo">
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
                                    <input value="<?php echo date('Y/m/d H:i')?>" id="aut_fecha" name="aut_fecha" class="form-control" type="datetime" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item ">
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
                            <label for="lit_fecha1"><i class="bi bi-calendar-date-fill"></i>Fecha de inicio de licencia Temporal</label>
                            <input value="" id="lit_fecha1" name="lit_fecha1" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="lit_fecha2"><i class="bi bi-calendar-date-fill"></i>Fecha de fin de licencia Temporal</label>
                            <input value="" id="lit_fecha2" name="lit_fecha2" class="form-control" type="date">
                        </div>
                        <div class="col-lg-6">
                            <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                            <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                            <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                            <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                        </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-2">
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-outline-primary w-100 overflow-visible text-wrap">Guardar</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<script src="./build/js/licencias/index.js"></script>