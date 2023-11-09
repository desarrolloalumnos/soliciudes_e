<form class="border bg-light p-4 mt-4 mx-auto w-50" id="formularioDireccionpersonal" name="formularioDireccionpersonal" id="tablaDireccionpersonal" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Solicitudes Ingresadas</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"> <i class="bi bi-universal-access me-2"></i>Catálogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill me-2"></i> Fecha de Solicitud</label>
            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-2">
            <button type="button" id="btnBuscar" name="btnBuscar"  class="btn btn-outline-info w-100">Buscar</button>
        </div>
    </div>
</form>

<div class="row justify-content-center">
    <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaDireccionpersonal" class="table table-bordered table-hover">
        </table>
    </div>
</div>

<div class="modal fade modal-lg" id="modalDep" tabindex="-1" role="dialog" aria-labelledby="modalDepLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <form class="border bg-light p-4" id="formularioDireccionpersonal" name="formularioDireccionpersonal" style="min-height: 50vh;">

                    <div class="text-center">
                        <input value="1" type="hidden" id="tse_id" name="tse_id">
                        <h1>Solicitudes</h1>
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
                            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="text" placeholder="Número de catalogo">
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
                            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">

                        </div>
                        <div class="col-lg-6">
                            <label for="ste_telefono">Teléfono</label>
                            <input id="ste_telefono" name="ste_telefono" class="form-control" type="number">
                        </div>
                    </div>
                    <input value="" id="sol_id" name="sol_id" class="form-control" type="hidden">
                    <input value="" type="hidden" name="sol_tipo" id="sol_tipo" class="form-control">
                    <input value="" type="hidden" name="sol_solicitante" id="sol_solicitante" class="form-control">
                    <input value="" type="hidden" name="sol_motivo" id="sol_motivo" class="form-control">
                    <input value="" type="hidden" name="sol_obs" id="sol_obs" class="form-control">

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-6">
                            <!-- <input value="1" type="hidden" name="sol_motivo" id="sol_motivo" class="form-control"> -->
                        </div>

                        <div class="col-lg-6">
                            <!-- <input value=" " class="form-control"  type="hidden" name="sol_obs" id="sol_obs" rows="10" cols="50"> -->
                        </div>


                    </div>

                    <div class="row justify-content-around mb-4">
                        <div class="col-lg-4">
                            <input value="" id="aut_solicitud" name="aut_solicitud" class="form-control" type="hidden">

                            <input value="" id="aut_cat" name="aut_cat" class="form-control" type="hidden">
                            <input value="" id="aut_gra" name="aut_gra" class="form-control" type="hidden">
                            <input value="" id="aut_arm" name="aut_arm" class="form-control" type="hidden">
                            <input value="" id="aut_emp" name="aut_emp" class="form-control" type="hidden">
                            <input value="" id="aut_comando" name="aut_comando" class="form-control" type="hidden">
                        </div>
                        <div class="col-lg-4">
                            <input value="" id="nombre2" name="nombre2" class="form-control" type="hidden">
                        </div>
                        <div class="col-lg-4">
                            <!-- <label for="aut_fecha">Fecha</label> -->
                            <input value="" id="aut_fecha" name="aut_fecha" class="form-control" type="hidden">

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Solicitud</h2>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-12 mb-4">

                        <div class="col-lg-12">
                            <label for=""><i class="bi bi-file-pdf-fill"></i>Documentos PDF</label>
                            <input value="" id="pdf_id" name="pdf_id" class="form-control" type="hidden">
                            <input value="" id="pdf_solicitud" name="pdf_solicitud" class="form-control" type="hidden">
                            <input value="" id="pdf_ruta" name="pdf_ruta" class="form-control" type="file">
                        </div>

                    </div>

                    <div class="row justify-content-center mt-12 mb-4">
                        <div class="col-lg-6">
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

<script src="<?=asset('./build/js/direccionpersonal/index.js') ?>"></script>