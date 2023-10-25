<div class="container mt-5">
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioMotivo">
            <input type="hidden" name="mot_id" id="mot_id">
            <h1 class="text-center">MOTIVOS PARA REALIZAR LAS SOLICITUDES</h1>
                <div class="row mb-3">
                    <div class="col">
                        <label for="mot_descripcion">Descripción del motivo</label>
                        <input type="text" name="mot_descripcion" id="mot_descripcion" class="form-control">
                </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioMotivo" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
<h1>Historial de Motivos</h1>
<div class="row justify-content-center">
    <div class="col table-responsive">
        <table id="tablaMotivos" class="table table-bordered table-hover">
            <!-- Contenido de la tabla aquí -->
        </table>
    </div>
</div>
</div>
<script src="<?= asset('./build/js/motivos/index.js') ?>"></script>