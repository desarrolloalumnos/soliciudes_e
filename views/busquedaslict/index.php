<form class="border bg-light p-4 mt-4 mx-auto w-75" id="formularioLicencia" name="formularioLicencia" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Licencias Temporales</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"> <i class="bi bi-universal-access"></i>Catalogo</label>
            <input value="" id="ste_catalogo" name="ste_catalogo" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
            <input  id="ste_fecha" name="ste_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-2">
            <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-outline-info w-100">Buscar</button>
        </div>
    </div>
</form>


    <div class="col table-responsive" style="max-width: 100%; padding: 10px;">
        <table id="tablaLicencias" class="table table-bordered table-hover">
        </table>
    </div>


<div class="modal fade modal-xl" id="modalLicencia" tabindex="-1" role="dialog" aria-labelledby="modalLicenciaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioLicenciasB" name="formularioLicenciasB" style="min-height: 50vh;">
                    <div id="licencias">
                        <div class="text-center">
                            <h1>Solicitud de Licencia Temporal</h1>
                        </div>

                        <div class="row justify-content-around mb-4">


                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Datos del solicitante</h2>
                                </div>
                            </div>


                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                                    <label for="ste_cat"><i class="bi bi-universal-access"></i>Catalogo</label>
                                    <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="numero de catalogo">
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
                                    <label for="ste_telefono"><i class="bi bi-telephone-inbound-fill"></i>Telefono</label>
                                    <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                                </div>
                                <div class="col-lg-6">
                                    <label for="sol_motivo"><i class="bi bi-journal-check"></i>Motivos</label>
                                    <select name="sol_motivo" id="sol_motivo" class="form-select">
                                        <option value=" " selected>Seleccione...</option>
                                        <?php foreach ($motivos as $motivo) { ?>
                                            <option value="<?= $motivo['mot_id'] ?>"><?= $motivo['mot_descripcion'] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                            <input value="2" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                            <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                            <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="sol_obs"><i class="bi bi-body-text"></i> Observaciones</label>
                                    <textarea class="form-control" type="text" id="sol_obs" name="sol_obs"></textarea>
                                </div>

                            </div>

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
                                    <label for="lit_fecha1"><i class="bi bi-calendar-date-fill"></i>Inicio de licencia Temporal</label>
                                    <input value="" id="lit_fecha1" name="lit_fecha1" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="row justify-content-around mb-4">
                                <div class="col-lg-6">
                                    <label for="lit_fecha2"><i class="bi bi-calendar-date-fill"></i>Fin de licencia Temporal</label>
                                    <input value="" id="lit_fecha2" name="lit_fecha2" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-12 mb-4">
                                <div class="col-lg-12">
                                    <iframe id="pdfLicencia" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                                <div class="col-lg-2">
                                    <button type="button" id="modificar" name="modificar" class="btn btn-outline-warning w-100 overflow-visible text-wrap">Modificar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pdf">
                        <div class="row justify-content-around mb-4">

                            <div class="col-lg-12">
                                <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                                <input value="" id="ste_catalogo" name="ste_catalogo" class="form-control" type="hidden" placeholder="Número de catálogo">
                                <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                                <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                            <div class="col-lg-6">
                                <button type="button" id="addPdf" name="addPdf" class="btn btn-outline-primary w-100 overflow-visible text-wrap">Guardar</button>
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
</div>


<script src="./build/js/busquedaslict/index.js"></script>