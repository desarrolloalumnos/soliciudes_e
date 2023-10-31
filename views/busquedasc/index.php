<form class="border bg-light p-4 mt-4 mx-auto w-50" id="formularioMatrimonio" name="formularioMatrimonio" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Matrimonio</h1>
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
            <button type="button" id="btnBuscar" name="btnBuscar" data-bs-target="#carouselMatrimonio" class="btn btn-outline-info w-100">Buscar</button>
        </div>
    </div>
</form>

<div class="row justify-content-center">
    <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaMatrimonios" class="table table-bordered table-hover">
        </table>
    </div>
</div>


<script src="./build/js/busquedasc/index.js"></script>