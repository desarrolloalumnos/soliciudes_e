<div class="row justify-content-center mt-5">

    <div class="col-lg-10">
        <div id="carouselMatrimonio" class="carousel slide" data-bs-ride="true">

            <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselMatrimonio" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" data-bs-target="#carouselMatrimonio" data-bs-slide-to="1" aria-label="Slide 2"></button>

            </div>
            <form class="carousel-inner border bg-light p-4" id="formMatrimonio" style="min-height: 50vh;">
                <div class="text-center">
                    <h1>Matrimonio</h1>
                </div>
                <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                <div class="carousel-item active">
                    <div class="row justify-content-around mb-4">
                        <div class="row">

                            <div class="row">
                                <div class="col-lg-4">
                                    <h2>Datos del solicitante</h2>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-4">
                                    <label for="sol_cat">Catalogo</label>
                                    <input value="" id="sol_cat" name="sol_cat" class="form-control" type="text">
                                    <input value="" id="sol_gra" name="sol_gra" class="form-control" type="hidden">
                                    <input value="" id="sol_arm" name="sol_arm" class="form-control" type="hidden">
                                    <input value="" id="sol_emp" name="sol_emp" class="form-control" type="hidden">
                                    <input value="" id="sol_comando" name="sol_comando" class="form-control" type="hidden">
                                </div>
                                <div class="col-lg-4">
                                    <label for="sol_fecha">Fecha de solicitud</label>
                                    <input value="" id="sol_fecha" name="sol_fecha" class="form-control" type="datetime-local">

                                </div>
                                <div class="col-lg-4">
                                    <label for="sol_telefono">Telefono</label>
                                    <input value="" id="sol_telefono" name="sol_telefono" class="form-control" type="tel">
                                </div>

                            </div>

                            <input value=" " type="hidden" class="form-control" name="sol_id" id="sol_id">
                            <input value="1" type="hidden" class="form-control" name="sol_tipo" id="sol_tipo">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="sol_motivo">Motivo</label>
                                    <input value="" type="text" name="sol_motivo" id="sol_motivo" class="form-control">
                                </div>

                                <div class="col-lg-6">
                                    <label for="sol_obs">Observaciones</label>
                                    <input class="form-control" name="sol_obs" id="sol_obs" rows="10" cols="50">
                                </div>


                            </div>
                            <div class="row ">
                                <div class="col-lg-4">
                                    <h2>Autorizador</h2>
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="aut_cat">Catalogo</label>
                                    <input value="" id="aut_cat" name="aut_cat" class="form-control" type="text">
                                    <input value="" id="aut_gra" name="aut_gra" class="form-control" type="hidden">
                                    <input value="" id="aut_arm" name="aut_arm" class="form-control" type="hidden">
                                    <input value="" id="aut_comando" name="aut_comando" class="form-control" type="hidden">

                                    <input value="" id="aut_emp" name="aut_emp" class="form-control" type="hidden">
                                </div>
                                <div class="col-lg-6">
                                    <label for="aut_fecha">Fecha</label>
                                    <input value="" id="aut_fecha" name="aut_fecha" class="form-control" type="datetime-local">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="row">
                        <div class="col flex-1">
                            <input value="" id="mat_id" name="mat_id" class="form-control" type="hidden">
                            <input value="" id="mat_autorizacion" name="mat_autorizacion" class="form-control" type="hidden">
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
                            <input value="" id="mat_fecha_bodac" name="mat_fecha_bodac" class="form-control" type="datetime-local">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_lugar_religioso">Lugar de la boda Religiosa</label>
                            <input value="" id="mat_lugar_religioso" name="mat_lugar_religioso" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="mat_fecha_bodar">Fecha de la boda Religiosa</label>
                            <input value="" id="mat_fecha_bodar" name="mat_fecha_bodar" class="form-control" type="text">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_ini">Fecha de inicio de licencia</label>
                            <input value="" id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control" type="text">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_fin">Fecha de finalizacion de licencia</label>
                            <input value="" id="mat_fecha_lic_fin" name="mat_fecha_lic_fin" class="form-control" type="datetime-local">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-2">
                            <label for="mat_fecha_bodar">Pareja Militar</label>
                            <input type="checkbox" id="pareja_civil" name="pareja_civil" class="form-check-input">
                        </div>
                        <div class="col-lg-2">
                            <label for="mat_fecha_lic_ini">Pareja Civil</label>
                            <input type="checkbox" id="pareja_civil" name="pareja_civil" class="form-check-input">
                        </div>
                        
                    </div>
                    <div class="row justify-content-center mt-12 mb-4">
                        
                        <div class="col-lg-4">
                            <label for="mat_fecha_bodar">Documentos PDF</label>
                            <input value="" id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control" type="text">
                        </div>

                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-2">
                            <button type="button" data-bs-target="#carouselMatrimonio" class="btn btn-primary w-100">Guardar</button>
                        </div>
                    </div>
                </div>
        </div>

        </form>
    </div>
</div>
</div>


<div class="modal fade" id="modalPuntos" tabindex="-1" role="dialog" aria-labelledby="modalPuntosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="modalPuntosLabel">Puntos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body container" id="formPuntos" novalidate>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="latitud">Latitud</label>
                        <input type="number" name="latitud" id="latitud" class="form-control">
                    </div>
                    <div class="col-lg-12">
                        <label for="longitud">Longitud</label>
                        <input type="number" name="longitud" id="longitud" class="form-control">
                    </div>
                    <div class="col-lg-12">
                        <label for="lugar">Lugar</label>
                        <input type="text" name="lugar" id="lugar" class="form-control">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="submit" form="formPuntos" class="btn btn-success" id="buttonLimpiar"><i class="bi bi-plus-circle me-2"></i>Agregar</button>
                <button type="button" class="btn btn-secondary" id="buttonAnterior" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<script src="./build/js/casamientos/index.js"></script>