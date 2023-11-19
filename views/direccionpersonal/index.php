<form class="border bg-light p-4 mt-4 mx-auto w-50" id="formularioDepersonal" name="formularioDepersonal" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Solicitudes Realizadas</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"> <i class="bi bi-universal-access"></i>Catálogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-2">
            <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-outline-info w-100 overflow-visible text-wrap">Buscar</button>
        </div>
    </div>
</form>

<div class="row justify-content-center">
    <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaDepersonal" class="table table-bordered table-hover">
        </table>
    </div>
</div>

<div class="modal fade modal-xl" id="modal1" tabindroleex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioSalidapais" name="formularioSalidapais" style="min-height: 50vh;">
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
                                <input value="" id="ste_cat2" name="ste_cat2" class="form-control" type="text" placeholder="Número de catálogo">
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
                                <input id="ste_fecha2" name="ste_fecha2" class="form-control" type="date">

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
                                <input class="form-control" type="text" id="sol_obs" name="sol_obs" placeholder="Observaciones del viaje">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
                                <input value="" id="sal_autorizacion" name="sal_autorizacion" class="form-control" type="hidden">
                                <h2>Solicitud</h2>
                            </div>
                        </div>

                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="sal_salida"><i class="bi bi-calendar-date-fill"></i>Fecha de la salida del país</label>
                                <input value="" id="sal_salida" name="sal_salida" class="form-control" type="date">
                            </div>
                            <div class="col-lg-6">
                                <label for="sal_ingreso"><i class="bi bi-calendar-date-fill"></i>Fecha del ingreso al país</label>
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
                                <iframe id="pdfSalidaPais" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" id="cerrarModal" class="btn btn-danger W-40" data-bs-dismiss="modal" onclick="borrarTodo(event)">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-xl" id="modalProto" tabindex="-1" role="dialog" aria-labelledby="modalProtoLabel" aria-hidden="true">
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
                                <input value="" id="ste_cat2" name="ste_cat2" class="form-control" type="number" placeholder="Número de catálogo">
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
                                <input value="" id="ste_fecha2" name="ste_fecha2" class="form-control" type="date">
                            </div>
                            <div class="col-lg-6">
                                <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Teléfono</label>
                                <input value="" id="ste_telefono" name="ste_telefono" class="form-control" type="number" placeholder="Número telefónico">
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
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
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
                                <input value="" id="pco_autorizacion" name="pco_autorizacion" class="form-control" type="hidden">
                                <h3>Detalle de la Solicitud</h3>
                            </div>
                        </div>


                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_cmbv">Seleccione el Combo o banda musical, Marimba o valla</label>
                                <select name="pco_cmbv" id="pco_cmbv" class="form-control">
                                    <option value="">SELECCIONE SU REQUERIMIENTO</option>
                                    <?php foreach ($combos as $combo) : ?>
                                        <option value="<?= $combo['cmv_id'] ?>">
                                            <?= $combo['tipo'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_just">Justificación de la actividad:</label>
                                <input type="text" name="pco_just" id="pco_just" class="form-control" placeholder="Escriba la justificación de su requerimiento">
                            </div>
                        </div>
                        <div class="row justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label for="pco_fechainicio"><i class="bi bi-calendar-date-fill"></i>Fecha de
                                    inicio</label>
                                <input value="" id="pco_fechainicio" name="pco_fechainicio" class="form-control" type="date">
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
                                <input type="text" name="pco_dir" id="pco_dir" class="form-control" placeholder="Escriba la dirección de la actividad">
                            </div>
                            <div class="col-lg-6">
                                <label for="pco_civil"></label>
                                <input value="" id="pco_civil" name="pco_civil" class="form-control" type="hidden">
                            </div>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-12">
                                <iframe id="pdfSalida" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar" data-bs-dismiss="modal">Cerrar</button>
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