<div class="row justify-content-center mt-5">

    <div class="col-lg-10">
        <div id="carouselMatrimonio" class="carousel slide">

            <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselMatrimonio" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" id="botonSlide2" data-bs-target="#carouselMatrimonio" data-bs-slide-to="1" aria-label="Slide 2"></button>

            </div>
            <form class="carousel-inner border bg-light p-4" id="formularioMatrimonio" style="min-height: 50vh;">
                <div class="text-center">
                    <h1>Matrimonio</h1>
                    <input value="" id="mat_id" name="mat_id" class="form-control" type="hidden">
                </div>
                <div class="carousel-item active">
                    <div class="row justify-content-around mb-4">
                        <div class="row">

                            <div class="row">
                                <div class="col-lg-4">
                                    <h2>Datos del solicitante</h2>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <input value="text" id="mat_autorizacion" name="mat_autorizacion" class="form-control" type="hidden">
                                    <input value="text" id="aut_id" name="aut_id" class="form-control" type="hidden">
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
                                    <input value="" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime-local">

                                </div>
                                <div class="col-lg-6">
                                    <label for="ste_telefono">Telefono</label>
                                    <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                                </div>

                            </div>
                            <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                            <input value="1" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                            <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <input value="1" type="hidden" name="sol_motivo" id="sol_motivo" class="form-control" placeholde="Matrimonio">
                                </div>

                                <div class="col-lg-6">
                                    <input class="form-control" placeholder="si su motivo fue 'OTROS' llene la observacion" type="hidden" name="sol_obs" id="sol_obs" rows="10" cols="50">
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
                            <input value="" id="mat_fecha_bodar" name="mat_fecha_bodar" class="form-control" type="datetime-local">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_ini">Fecha de inicio de licencia</label>
                            <input value="" id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control" type="datetime-local">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_fin">Fecha de finalizacion de licencia</label>
                            <input value="" id="mat_fecha_lic_fin" name="mat_fecha_lic_fin" class="form-control" type="datetime-local">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-2">
                            <label for="mat_fecha_bodar">Pareja Militar</label>
                            <input type="checkbox" id="pareja_militar" name="pareja_militar" class="form-check-input">
                        </div>
                        <div class="col-lg-2">
                            <label for="mat_fecha_lic_ini">Pareja Civil</label>
                            <input type="checkbox" id="pareja_civil" name="pareja_civil" class="form-check-input">
                        </div>

                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-3">
                            <input type="hidden" name="mat_per_civil" id="mat_per_civil" class="form-control">
                            <input type="hidden" name="mat_per_army" id="mat_per_civil" class="form-control">
                            <input type="hidden" name="parejac_id" id="parejac_id" class="form-control">
                            <input type="hidden" name="parejam_id" id="parejac_id" class="form-control">
                            <input type="hidden" name="parejac_nombres" id="parejac_nombres" class="form-control">
                            <input type="hidden" name="parejam_cat" id="parejam_cat" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <input type="hidden" name="parejac_apellidos" id="parejac_apellidos" class="form-control">
                            <input type="hidden" name="nombre4" id="nombre4" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <input type="hidden" name="parejac_direccion" id="parejac_direccion" class="form-control">
                            <input type="hidden" name="parejam_emp" id="parejam_emp" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <input type="hidden" name="parejam_comando" id="parejam_comando" class="form-control">
                            <input type="hidden" name="parejac_dpi" id="parejac_dpi" class="form-control">
                            <input type="hidden" name="parejam_gra" id="parejam_gra" class="form-control">
                            <input type="hidden" name="parejam_arm" id="parejam_arm" class="form-control">
                        </div>
                    </div>

                    <div class="row justify-content-center mt-12 mb-4">

                        <div class="col-lg-4">
                            <label for="mat_fecha_bodar">Documentos PDF</label>
                            <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                            <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="hidden">
                            <input value="" id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control" type="text">
                        </div>

                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-2">
                            <button type="button" id="btnGuardar" name="btnGuardar" data-bs-target="#carouselMatrimonio" class="btn btn-outline-primary w-100">Guardar</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btnBuscar" name="btnBuscar" data-bs-target="#carouselMatrimonio" class="btn btn-outline-info w-100">Buscar</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btnModificar" name="btnModificar" data-bs-target="#carouselMatrimonio" class="btn btn-outline-warning w-100">Modificar</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btnCancelar" name="btnCancelar" data-bs-target="#carouselMatrimonio" class="btn btn-outline-danger w-100">Cancelar</button>
                        </div>
                    </div>
                </div>
        </div>

        </form>
    </div>
</div>
</div>
<div class="modal fade" id="modalC" tabindex="-1" role="dialog" aria-labelledby="modalCLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalMLabel">Datos de la Pareja</h1>
            </div>
            <div class="modal-body">
                <form class="modal-body container" id="formCasamiento" novalidate>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="parejac1_nombres">Nombres</label>
                            <input type="text" name="parejac1_nombres" id="parejac1_nombres" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label for="parejac1_apellidos">Apellidos</label>
                            <input type="text" name="parejac1_apellidos" id="parejac1_apellidos" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label for="parejac1_direccion">Direccion</label>
                            <input type="text" name="parejac1_direccion" id="parejac1_direccion" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label for="parejac1_dpi">DPI</label>
                            <input type="text" name="parejac1_dpi" id="parejac1_dpi" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="formPuntos" class="btn btn-outline-success" id="buttonGuardar1"><i class="bi bi-plus-circle me-2"></i>Agregar</button>
                <button type="button" class="btn btn-outline-danger" id="buttonCancelar1" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalM" tabindex="-1" role="dialog" aria-labelledby="modalMLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalMLabel">Datos de la Pareja</h1>
            </div>
            <div class="modal-body">
                <form class="modal-body container" id="formCasamiento" novalidate>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="pareja_cat1">Catalogo</label>
                            <input type="number" name="parejam1_cat" id="parejam1_cat" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label for="nombre3">Nombres y Apellidos</label>
                            <input type="text" name="nombre3" id="nombre3" class="form-control">
                            <input type="hidden" name="parejam1_comando" id="parejam1_comando" class="form-control">
                            <input type="hidden" name="parejam1_gra" id="parejam1_gra" class="form-control">
                            <input type="hidden" name="parejam1_arm" id="parejam1_arm" class="form-control">
                            <input type="hidden" name="parejam1_emp" id="parejam1_emp" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" form="formPuntos" class="btn btn-outline-success" id="buttonGuardar2"><i class="bi bi-plus-circle me-2"></i>Agregar</button>
                <button type="button" class="btn btn-outline-danger" id="buttonCancelar2" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script src="./build/js/casamientos/index.js"></script>