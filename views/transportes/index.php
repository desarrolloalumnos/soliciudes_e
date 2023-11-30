<div class="container mt-5">
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioTransporte">
            <input type="hidden" name="transporte_id" id="transporte_id">
            <h1 class="text-center">TIPOS DE TRANSPORTES</h1>
            <div class="row mb-3">
                <div class="col">
                    <label for="transporte_descripcion">Descripción del transporte</label>
                    <input type="text" name="transporte_descripcion" id="transporte_descripcion" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioTransporte" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
    <h1>Historial de Transportes</h1>
    <div class="row justify-content-center">
        <div class="col table-responsive">
            <table id="tablaTransportes" class="table table-bordered table-hover">
                <!-- Contenido de la tabla aquí -->
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/transportes/index.js') ?>"></script>
