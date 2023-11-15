<form class="border bg-light p-4 mt-4 mx-auto w-50" id="formularioSalidapaises" name="formularioSalidapaises" style="min-height: 30vh; margin-top: 60px;">
<form class="border bg-light p-4 mt-4 mx-auto w-50" id="formularioSalidapaises" name="formularioSalidapaises" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Solicitudes de Salida del País</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"><i class="bi bi-universal-access"></i> Catálogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-2">
            <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-outline-info w-100 overflow-visible text-wrap">Buscar</button>
        </div>
    </div>
</form>

<div class="row justify-content-center">
    <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaSalidapaises" class="table table-bordered table-hover">
        </table>
    </div>
</div>



<!-- Modal para modificar la solicitud -->
<div class="modal fade" id="modalSalidapaises" tabindroleex="-1" role="dialog" aria-labelledby="modalMLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioSalidapais" name="formularioSalidapais" style="min-height: 50vh;">

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
                            <label for="ste_cat">Catálogo</label>
                            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="text" placeholder="Número de catálogo">
                            <input value="" id="ste_gra" name="ste_gra" class="form-control" type="hidden">
                            <input value="" id="ste_arm" name="ste_arm" class="form-control" type="hidden">
                            <input value="" id="ste_emp" name="ste_emp" class="form-control" type="hidden">
                            <input value="" id="ste_comando" name="ste_comando" class="form-control" type="hidden">
                        </div>

                        <div class="col-lg-6">
                            <label for="nombre">Nombres</label>
                            <input value="" id="nombre" name="nombre" class="form-control" type="hidden">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="ste_fecha">Fecha de Solicitud</label>
                            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">

                        </div>
                        <div class="col-lg-6">
                            <label for="ste_telefono">Teléfono</label>
                            <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                        </div>
                    </div>


                        <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                        <input value="3" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                        <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                        <input value="" type="hidden" name="sol_motivo" id="sol_motivo" class="form-control">
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

                    <!-- Detalle de la solicitud -->

                    
                    <div class="row">
                        <div class="col-lg-12">
                            <input value="" id="sal_id" name="sal_id" class="form-control" type="hidden">
                            <input value="" id="sal_autorizacion" name="sal_autorizacion" class="form-control"
                                type="hidden">
                            <h2>Solicitud</h2>
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="sal_salida"><i class="bi bi-calendar-date-fill"></i>Fecha de la salida del
                                país</label>
                            <input value="" id="sal_salida" name="sal_salida" class="form-control" type="date">
                        </div>
                        <div class="col-lg-6">
                            <label for="sal_ingreso"><i class="bi bi-calendar-date-fill"></i>Fecha del ingreso al
                                país</label>
                            <input value="" id="sal_ingreso" name="sal_ingreso" class="form-control" type="date">
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <input value="" id="dsal_id" name="dsal_id" class="form-control" type="hidden">
                            <input value="" type="hidden" name="dsal_sol_salida" id="dsal_sol_salida" class="form-control">
                            <label for="dsal_pais" class="form-label"><i class="bi bi-globe-americas"></i>Seleccione el
                                país a viajar:</label>
                            <select name="dsal_pais" id="dsal_pais" class="form-select">
                                <option value="">Seleccione el país</option>
                                <?php foreach ($paises as $pais) { ?>
                                    <option value="<?= $pais['pai_codigo'] ?>">
                                        <?= $pais['pai_desc_lg'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="dsal_ciudad"><i class="bi bi-file-image-fill"></i>Ciudad del país a
                                visitar</label>
                            <input value="" id="dsal_ciudad" name="dsal_ciudad" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <label for="dsal_transporte" class="form-label"><i class="bi bi-airplane-fill"></i>Seleccione el transporte:</label>
                            <select name="dsal_transporte" id="dsal_transporte" class="form-select">
                                <option value="">Seleccione el transporte</option>
                                <?php foreach ($transportes as $transporte) { ?>
                                    <option value="<?= $transporte['transporte_id'] ?>">
                                        <?= $transporte['transporte_descripcion'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-12">
                                <label for="sal_salida"><i class="bi bi-file-pdf-fill"></i>Documentos
                                    PDF</label>
                                <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control"
                                    type="hidden">
                                <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                            </div>

                            </div>

                        <div class="row justify-content-center mt-12 mb-4">
                            <div class="col-lg-6">
                                <button type="click" id="btnModificar" name="btnModificar"
                                    class="btn btn-outline-warning w-100">Modificar</button>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="./build/js/busquedasalpais/index.js"></script>