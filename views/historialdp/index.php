<form class="border bg-light p-4 mt-4 mx-auto w-75" id="formularioDepersonal" name="formularioDepersonal" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Historial de solicitudes</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat"> <i class="bi bi-universal-access"></i>Catalogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha"><i class="bi bi-calendar-date-fill"></i> Fecha de Solicitud</label>
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
    <div class="col table-resstyle="max-width: 80%; padding: 10px;">
        <table id="tablaDepersonal" class="table table-bordered table-hover">
        </table>
    </div>
</div>


<script src="./build/js/historialdp/index.js"></script> 