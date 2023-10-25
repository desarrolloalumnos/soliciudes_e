<div class="row justify-content-center mt-5">

    <div class="col-lg-10">
        <div id="carouselSolicitudSalida" class="carousel slide" data-bs-ride="true">
            
        <div class="carousel-indicators">
                <button type="button" class="bg-dark active" data-bs-target="#carouselSolicitudSalida" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="bg-dark" data-bs-target="#carouselSolicitudSalida" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

            <form class="carousel-inner border bg-light p-4" id="formSolicitudSalida" style="min-height: 50vh;">
                <div class="text-center">
                    <h1>Solicitud de Salida de País</h1>
                </div>
                <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
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


                <div class="carousel-item">
                    <div class="row">
                        <div class="col flex-1">
                            <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
                            <input value="" id="sal_autorizacion" name="sal_autorizacion" class="form-control" type="hidden">
                            <h2>Solicitud salida del país </h2>
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="sal_salida">Fecha de la salida del país</label>
                            <input value="" id="sal_salida" name="sal_salida" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="sal_ingreso">Fecha del ingreso al país</label>
                            <input value="" id="sal_ingreso" name="sal_ingreso" class="form-control" type="date">
                        </div>

                        <div class="mb-3">
                        <label for="dsal_pais" class="form-label">Seleccione un país:</label>
                        <select name="dsal_pais" id="dsal_pais" class="form-select">
                            <option value="">Seleccione el país</option>
                            <?php foreach ($paises as $pais) { ?>
                                <option value="<?= $pais['pai_codigo'] ?>"><?= $pais['pai_desc_log'] ?></option>
                            <?php } ?>
                        </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="dsal_ciudad">Ciudad del país a visitar</label>
                            <input value="" id="dsal_ciudad" name="dsal_ciudad" class="form-control" type="text">
                        </div>
                        
                        <div class="mb-3">
                        <label for="dsal_transporte" class="form-label">Seleccione el transporte:</label>
                        <select name="dsal_transporte" id="dsal_transporte" class="form-select">
                            <option value="">Seleccione el transporte</option>
                            <?php foreach ($transportes as $transporte) { ?>
                                <option value="<?= $transporte['transporte_id'] ?>"><?= $transporte['transporte_descripción'] ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>

            </form>
        </div>
    </div>
</div>


<script src="./build/js/salidapaises/index.js"></script>