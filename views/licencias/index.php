<div class="row justify-content-center mt-5 mx-auto w-50">

    <div class="col-lg-10">
        <div id="carouselMatrimonio" class="carousel slide">

            <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselMatrimonio" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" id="botonSlide2" data-bs-target="#carouselMatrimonio" data-bs-slide-to="1" aria-label="Slide 2"></button>

            </div>
            <form class="carousel-inner border bg-light p-4" id="formularioMatrimonio" name="formularioMatrimonio" style="min-height: 50vh;">
                <div class="text-center">
                    <h1>Licencia Temporal</h1>
                </div>
                <div class="carousel-item active">
                    <div class="row justify-content-around mb-4">
                        <div class="row">

                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Datos del solicitante</h2>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <input value="" id="mat_autorizacion" name="mat_autorizacion" class="form-control" type="hidden">
                                    <input value="" id="aut_id" name="aut_id" class="form-control" type="hidden">
                                    <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                                    <label for="ste_cat">Catalogo</label>
                                    <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="numero de catalogo">
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
                                    <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">

                                </div>
                                <div class="col-lg-6">
                                    <label for="ste_telefono">Telefono</label>
                                    <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                                </div>

                            </div>
                            <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                            <input value="2" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                            <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <select name="sol_motivo" id="sol_motivo" class="form-select" style="display: none">
                                        <option value="1" selected>Matrimonio</option>
                                        <?php foreach ($motivos as $motivo) { ?>
                                            <option value="<?= $motivo['mot_id'] ?>"><?= $motivo['mot_descripcion'] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <input value=" " class="form-control" type="hidden" name="sol_obs" id="sol_obs" rows="10" cols="50">
                                </div>


                            </div>
                            <div class="row ">
                                <div class="col-lg-4">
                                    <h2>Autorizador</h2>
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-4">
                                    <input value="" id="aut_solicitud" name="aut_solicitud" class="form-control" type="hidden">
                                    <label for="aut_cat">Catalogo</label>
                                    <input value="" id="aut_cat" name="aut_cat" class="form-control" type="number">
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
                                    <input value="" id="aut_fecha" name="aut_fecha" class="form-control" type="date">

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
                            <h2>Solicitud</h2>
                        </div>
                    </div>


                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="lit_mes_consueldo">Meses con Sueldo </label>
                            <input value="" id="lit_mes_consueldo" name="lit_mes_consueldo" class="form-control" type="number">
                        </div>
                        <div class="col-lg-4">
                            <label for="lit_mes_sinsueldo">Meses sin Sueldo</label>
                            <input id="lit_mes_sinsueldo" name="lit_mes_sinsueldo" class="form-control" type="number">
                        </div>
                        <div class="col-lg-4">
                            <label for="lit_fecha1">Fecha de inicio de licencia Temporal</label>
                            <input value="" id="lit_fecha1" name="lit_fecha1" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="lit_fecha2">Fecha de fin de licencia Temporal</label>
                            <input id="lit_fecha2" name="lit_fecha2" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <select name="lit_articulo" id="lit_articulo" class="form-select" style="display: none">
                                <option value=" " selected></option>
                                <?php foreach ($tipos as $tipo) { ?>
                                    <option value="<?= $tipo['art_id'] ?>"><?= $tipo['art_descripcion'] ?></option>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-6">
                                <label for="mat_fecha_bodar">Documentos PDF</label>
                                <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                                <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                            </div>

                        </div>

                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-2">
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-outline-primary w-100">Guardar</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<script src="./build/js/licencias/index.js"></script>