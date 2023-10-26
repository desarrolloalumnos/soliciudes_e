<div class="row justify-content-center mt-5">

    <div class="col-lg-10">
        <div id="carouselProtocolo" class="carousel slide" data-bs-ride="true">

            <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselProtocolo" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" data-bs-target="#carouselProtocolo" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <form class="carousel-inner border bg-light p-4" id="formularioProtocolo" style="min-height: 50vh;">
                <div class="text-center">
                    <h1 class="text-center">Solicitud de banda o combo musical, marimba y valla</h1>
                </div>

                <div class="carousel-item active">
                    <div class="row justify-content-around mb-4">
                        <div class="row">
                            
                        <!-- Datos del personal solicitante -->

                            <div class="row">
                                <div class="col-lg-4">
                                    <h2>Datos del personal solicitante</h2>
                                </div>
                            </div>

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <input value="" id="ste_id" name="ste_id" class="form-control" type="hidden">
                                    <label for="ste_cat">Catálogo</label>
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
                                    <label for="ste_fecha">Fecha de la Solicitud</label>
                                    <input value="" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime-local">
                                </div>
                                <div class="col-lg-6">
                                    <label for="ste_telefono">Teléfono</label>
                                    <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                                </div>
                            </div>

                            <input value=" " type="hidden" class="form-control" name="sol_id" id="sol_id">
                            <input value="1" type="hidden" class="form-control" name="sol_tipo" id="sol_tipo">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <select name="sol_motivo" id="sol_motivo" class="form-select" style="display: none">
                                        <option value="1" selected>Matrimonio</option>
                                        <option value="2" selected>Eventos festivos</option>
                                        <?php foreach ($motivos as $motivo) { ?>
                                            <option value="<?= $motivo['mot_id'] ?>"><?= $motivo['mot_descripcion'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <input class="form-control" placeholder="Si el motivo es la opción 'OTROS' llene la observación" type="hidden" name="sol_obs" id="sol_obs" rows="10" cols="50">
                                </div>
                            </div>


                        <!-- Datos del oficial que autoriza la solicitud -->

                            <div class="row ">
                                <div class="col-lg-4">
                                    <h2>Oficial que autoriza</h2>
                                </div>
                            </div>

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-4">
                                    <input value="" id="aut_id" name="aut_id" class="form-control" type="hidden">
                                    <input value="" id="aut_solicitud" name="aut_solicitud" class="form-control" type="hidden">
                                    <label for="aut_cat">Catálogo</label>
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
        

    <!-- pendiente -->
    
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">

                        <label for="pco_cmbv">Seleccione el Combo, Marimba o Conjunto Musical</label>
                        <select type="text" name="pco_cmbv" id="pco_cmbv" class="form-control">
                            <option value="1">Marimba Alas de Seda</option>
                            <option value="0">Valla de cadetes navales</option>
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
                <div class="row">
                    <div class="col">
                        <button type="submit" form="formularioProtocolo" id="btnGuardar" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                    <div class="col">
                        <button type="button" id="btnCancelar" class="btn btn-danger btn-block">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>