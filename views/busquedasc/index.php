<form class="border bg-light p-4 mt-4 mx-auto w-75" id="formularioMatrimonio" name="formularioMatrimonio" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Solicitud de Matrimonio</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"> <i class="bi bi-universal-access"></i>Catalogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
            <input value="" id="ste_fecha" name="ste_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-2">
            <button type="button" id="btnBuscar" name="btnBuscar" data-bs-target="#carouselMatrimonio" class="btn btn-outline-info w-100 overflow-visible text-wrap">Buscar</button>
        </div>
    </div>
</form>

<div class="row justify-content-center">
    <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaMatrimonios" class="table table-bordered table-hover">
        </table>
    </div>
</div>

<div class="modal fade modal-xl " id="modalM" tabindex="-1" role="dialog" aria-labelledby="modalMLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioCasamiento" name="formularioCasamiento" style="min-height: 50vh;" enctype="multipart/form-data">

                    <div class="text-center">
                        <input value="1" type="hidden" id="tse_id" name="tse_id">
                        <h1>Solicitud de Matrimonio</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Solicitante</h2>
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <input value="" type="hidden" name="ste_id" id="ste_id" class="form-control">
                            <label for="ste_cat">Catalogo</label>
                            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="text" placeholder="numero de catalogo">
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
                            <input value="<?php echo date('d/m/Y H:i') ?>" id="ste_fecha" name="ste_fecha" class="form-control" type="datetime" placeholder="Fecha de la solicitud" disabled>

                        </div>
                        <div class="col-lg-6">
                            <label for="ste_telefono">Telefono</label>
                            <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <input value="" id="mat_id" name="mat_id" class="form-control" type="hidden">

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
                            <input value="" id="mat_fecha_bodac" name="mat_fecha_bodac" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_lugar_religioso">Lugar de la boda Religiosa</label>
                            <input value="" id="mat_lugar_religioso" name="mat_lugar_religioso" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <label for="mat_fecha_bodar">Fecha de la boda Religiosa</label>
                            <input value="" id="mat_fecha_bodar" name="mat_fecha_bodar" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_ini">Inicio de la licencia</label>
                            <input value="" id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control" type="date">
                        </div>
                        <div class="col-lg-4">
                            <label for="mat_fecha_lic_fin">Finalizacion de la licencia</label>
                            <input value="" id="mat_fecha_lic_fin" name="mat_fecha_lic_fin" class="form-control" type="date">
                        </div>
                    </div>

                    <div class="row justify-content-around mb-4">

                        <div id="parejaCivil" class="col-lg-6">
                            <h1>Pareja</h1>
                            <input value="" type="hidden" name="mat_per_civil" id="mat_per_civil" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Nombres</label>
                            <input value="" type="text" name="parejac_nombres" placeholder="nombres" id="parejac_nombres" class="form-control">
                            <input value="" type="hidden" name="parejac_id" id="parejac_id" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Apellidos</label>
                            <input value="" type="text" name="parejac_apellidos" placeholder="apellidos" id="parejac_apellidos" class="form-control">
                            <label><i class="bi bi-house-door-fill"></i>Direccion</label>
                            <input value="" type="text" name="parejac_direccion" placeholder="direccion" id="parejac_direccion" class="form-control">
                            <label><i class="bi bi-key"></i>DPI</label>
                            <input value="" type="text" name="parejac_dpi" placeholder="DPI" id="parejac_dpi" class="form-control">
                        </div>

                        <div id="parejaMilitar" class="col-lg-6">
                            <h1>Pareja</h1>
                            <input value="" type="hidden" name="parejam_emp" id="parejam_emp" class="form-control">
                            <input value="" type="hidden" name="mat_per_army" id="mat_per_army" class="form-control">
                            <input value="" type="hidden" name="parejam_id" id="parejac_id" class="form-control">
                            <label> <i class="bi bi-key"></i> Catalogo</label>
                            <input value="" type="text" name="parejam_cat" id="parejam_cat" class="form-control">
                            <label><i class="bi bi-bag-heart"></i>Nombres</label>
                            <input value="" type="text" name="parejaNombre" id="parejaNombre" class="form-control">
                            <input value="" type="hidden" name="parejam_comando" id="parejam_comando" class="form-control">
                            <input value="" type="hidden" name="parejam_gra" id="parejam_gra" class="form-control">
                            <input value="" type="hidden" name="parejam_arm" id="parejam_arm" class="form-control">
                        </div>
                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-12">
                            <iframe id="pdfIframe" title="PDF" class="text-center" width="100%" height="500px" src=""></iframe>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-4 mt-12 mb-4">
                            <button type="click" id="btnModificar" name="btnModificar" class="btn btn-outline-warning w-100">Modificar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="btnCancelar" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-md" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="modalPdfLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioPdf" name="formularioPdf" style="min-height: 50vh;">

                    <div class="row justify-content-around mb-4">

                        <div class="col-lg-12">
                            <label for="pdf_ruta_input"><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                            <input value="" id="catalogo" name="catalogo" class="form-control" type="hidden" placeholder="Número de catálogo">
                            <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                            <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                            <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">

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

<script src="./build/js/busquedasc/index.js"></script>