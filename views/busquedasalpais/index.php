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
    <div class="modal fade modal-xl" id="modalSalidapaises" tabindroleex="-1" role="dialog" aria-labelledby="modalSalidapaisesLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <form class="border bg-light p-4" id="formularioSalidapais" name="formularioSalidapais" style="min-height: 50vh;">
                        <div id="salidas">
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
                                    <label for="ste_fecha">Fecha de Solicitud</label>
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

                            <div class="row justify-content-center mt-12 mb-4" style="margin-top: 20px;">
                                <div class="col-lg-2">
                                    <button type="button" id="modificar" name="modificar" class="btn btn-outline-warning w-100 overflow-visible text-wrap">Modificar</button>
                                </div>
                            </div>
                        </div>
                        <div id="pdf">
                            <div class="row justify-content-around mb-4">

                                <div class="col-lg-12">
                                    <label for="pdf_ruta"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                                    <input value="" id="ste_catalogo" name="ste_catalogo" class="form-control" type="hidden" placeholder="Número de catálogo">
                                    <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                                    <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="text">
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
                        <button type="button" id="cerrarModal"class="btn btn-danger W-40" data-bs-dismiss="modal" onclick=" borrarTodo()">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>

        <script>
            var paisesData = <?php echo json_encode($paises); ?>;
            var transporteData = <?php echo json_encode($transportes); ?>;


           
        </script>

        <script src="./build/js/busquedasalpais/index.js"></script>