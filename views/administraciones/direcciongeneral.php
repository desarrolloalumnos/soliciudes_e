<div>
    <form class="border bg-light p-4 mt-4 mx-auto w-75" id="formularioDirecciongeneral" name="formularioDirecciongeneral"  style="min-height: 30vh; margin-top: 60px;">
        <div class="text-center mb-4">
            <h1>Solicitudes Ingresadas</h1>
        </div>

        <div class="row mb-4">
            <div class="col-lg-6">
                <label for="ste_cat"> <i class="bi bi-universal-access"></i>Catalogo</label>
                <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number"
                    placeholder="Número de catálogo">
            </div>
            <div class="col-lg-6">
                <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
                <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">
            </div>

            <div class="col-lg-6">
                <label for="tse_id"><i class="bi bi-body-text"></i>Tipo de Solicitud</label>
                <select id="tse_id" name="tse_id" class="form-control">
                    <option value="">SELECCIONE..</option>
                    <option value="1">Matrimonio</option>
                    <option value="2">Licencia Temporal</option>
                    <option value="3">Salida del Pais</option>
                    <option value="4">Protocolo</option>
                </select>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-2">
                <button type="button" id="btnBuscar" name="btnBuscar" class="btn btn-outline-info w-100">Buscar</button>
            </div>
        </div>
    </form>

    <div class="row justify-content-center">
        <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
            <table id="tablaDirecciongeneral" class="table table-bordered table-hover">
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/administraciones/direcciongeneral.js') ?>"></script>