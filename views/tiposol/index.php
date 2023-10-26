<div class="container mt-5">
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioTipoSolicitud">
            <input type="hidden" name="tse_id" id="tse_id">
            <h1 class="text-center">Tipos de Solicitudes</h1>
            <div class="row mb-3">
                <div class="col">
                    <label for="tse_descripcion">Descripción del Tipo de Solicitud</label>
                    <input type="text" name="tse_descripcion" id="tse_descripcion" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioTipoSolicitud" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <h1>Historial de Tipos de Solicitudes</h1>
    <div class="row justify-content-center">
        <div class="col table-responsive">
            <table id="tablaTipoSolicitudes" class="table table-bordered table-hover">
                <!-- Contenido de la tabla aquí -->
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/tiposol/index.js') ?>"></script>