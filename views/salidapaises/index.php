<div class="row justify-content-center mt-5 mx-auto w-75">

    <div class="col-lg-10">
        <div id="carouselSalidapaises" class="carousel slide">

            <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselSalidapaises" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" id="botonSlide2" data-bs-target="#carouselSalidapaises" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>

            <form class="carousel-inner border bg-light p-4" id="formularioSalidapaises" style="min-height: 50vh;">
                <div class="text-center">
                    <input value="1" type="hidden" id="tse_id" name="tse_id">
                    <h2>Solicitud de Salida del País</h2>
                    <br>
                    <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
                </div>
                <div class="carousel-item active">
                    <div class="row justify-content-around mb-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3>Datos del solicitante</h3>
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <input value="" id="aut_id" name="aut_id" class="form-control" type="hidden">
                                <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                                <label for="ste_cat"><i class="bi bi-universal-access"></i>Catálogo</label>
                                <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catalogo">
                                <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                                <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                                <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                                <input value="" id="ste_comando" name="ste_comando" class="form-control" type="hidden">
                            </div>
                            <div class="col-lg-6">
                                <label for="ste_cat"><i class="bi bi-clipboard-data-fill"></i>Nombres y Apellidos</label>
                                <input value="" id="nombre" name="nombre" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha de Solicitud</label>
                                <input value="<?php echo date('Y/m/d H:i') ?>" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>
                            </div>

                            <div class="col-lg-6">
                                <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                                <input id="ste_telefono" name="ste_telefono" class="form-control" type="number" placeholder="Ingrese su número telefónico">
                            </div>
                        </div>

                        <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                        <input value="3" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                        <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                        <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

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
                            <div class="col-lg-8">
                                <h3>Oficial que autoriza</h3>
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-4">
                                <input value="" id="aut_solicitud" name="aut_solicitud" class="form-control" type="hidden">
                                <label for="aut_cat"><i class="bi bi-universal-access"></i>Catálogo</label>
                                <input value="" id="aut_cat" name="aut_cat" class="form-control" type="number" placeholder="Número de catálogo">
                                <input value="" id="aut_gra" name="aut_gra" class="form-control" type="hidden">
                                <input value="" id="aut_arm" name="aut_arm" class="form-control" type="hidden">
                                <input value="" id="aut_emp" name="aut_emp" class="form-control" type="hidden">
                                <input value="" id="aut_comando" name="aut_comando" class="form-control" type="hidden">
                            </div>
                            <div class="col-lg-4">
                                <label for="nombre2"><i class="bi bi-clipboard-data-fill"></i>Nombres y Apellidos</label>
                                <input value="" id="nombre2" name="nombre2" class="form-control" type="text" placeholder="Nombre del Autorizador">
                            </div>

                            <div class="col-lg-4">
                                <label for="aut_fecha"><i class="bi bi-calendar-date-fill"></i>Fecha</label>
                                <input value="<?php echo date('Y/m/d H:i') ?>" id="aut_fecha" name="aut_fecha" class="form-control" type="datetime" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detalle de la solicitud -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col flex-1">
                            <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
                            <input value="" id="sal_autorizacion" name="sal_autorizacion" class="form-control" type="hidden">
                            <h3>Detalle de la solicitud salida del país </h3>
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="sal_salida"><i class="bi bi-calendar-date-fill"></i>Fecha de la salida del país</label>
                            <input value="<?php echo date('Y/m/d') ?>" id="sal_salida" name="sal_salida" class="form-control" type="date">
                        </div>
                        <div class="col-lg-6">
                            <label for="sal_ingreso"><i class="bi bi-calendar-date-fill"></i>Fecha del ingreso al país</label>
                            <input value="<?php echo date('Y/m/d') ?>" id="sal_ingreso" name="sal_ingreso" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-5 mb-3">
                                
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-outline-success w-100" id="addPais">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div id="seleccion" class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <input value="" id="dsal_id" name="dsal_id" class="form-control" type="hidden">
                                    <input value="" type="hidden" name="dsal_sol_salida" id="dsal_sol_salida" class="form-control">
                                    <label for="dsal_pais" class="form-label"><i class="bi bi-globe-americas"></i>Seleccione el país a viajar:</label>
                                    <select name="dsal_pais[]" id="dsal_pais" class="form-select">
                                        <option value="">Seleccione el país</option>
                                        <?php foreach ($paises as $pais) { ?>
                                            <option value="<?= $pais['pai_codigo'] ?>">
                                                <?= $pais['pai_desc_lg'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="dsal_transporte" class="form-label"><i class="bi bi-airplane-fill"></i>Seleccione el transporte:</label>
                                    <select name="dsal_transporte[]" id="dsal_transporte" class="form-select">
                                        <option value="">Seleccione el transporte</option>
                                        <?php foreach ($transportes as $transporte) { ?>
                                            <option value="<?= $transporte['transporte_id'] ?>">
                                                <?= $transporte['transporte_descripcion'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label for="dsal_ciudad"><i class="bi bi-file-image-fill"></i>Ciudad del país a visitar</label>
                                    <input value="" id="dsal_ciudad" name="dsal_ciudad[]" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-around mb-4">

                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                                </div>
                                <div class="col-lg-12">
                                    <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                    <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                                    <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                                    <input value="" type="hidden" id="sol_situacion" name="sol_situacion" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                        <div class="col-lg-2">
                            <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-outline-primary w-100">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var paisesData = <?php echo json_encode($paises); ?>;
    var transporteData = <?php echo json_encode($transportes); ?>;
</script>

<script src="./build/js/salidapaises/index.js"></script>