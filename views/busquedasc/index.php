<form class="border bg-light p-4 mt-4 mx-auto w-50" id="formularioMatrimonio" name="formularioMatrimonio" style="min-height: 30vh; margin-top: 60px;">
    <div class="text-center mb-4">
        <h1>Matrimonio</h1>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4">
            <h2>Datos del solicitante</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="ste_cat">Catálogo</label>
            <input value="" id="ste_cat" name="ste_cat" class="form-control" type="number" placeholder="Número de catálogo">
        </div>
        <div class="col-lg-6">
            <label for="ste_fecha">Fecha de Solicitud</label>
            <input id="ste_fecha" name="ste_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4">
            <h2>Autorizador</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="aut_cat">Catálogo</label>
            <input value="" id="aut_cat" name="aut_cat" class="form-control" type="number">
        </div>
        <div class="col-lg-6">
            <label for="aut_fecha">Fecha</label>
            <input value="" id="aut_fecha" name="aut_fecha" class="form-control" type="date">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4">
            <h2>Solicitud</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="parejam_cat">Catálogo de la Pareja</label>
            <input value="" type="number" name="parejam_cat" id="parejam_cat" class="form-control">
        </div>
        <div class="col-lg-6">
            <label for="mat_fecha_bodac">Fecha de la boda Civil</label>
            <input id="mat_fecha_bodac" name="mat_fecha_bodac" class="form-control" type="date">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4">
            <label for="mat_fecha_bodar">Fecha de la boda Religiosa</label>
            <input id="mat_fecha_bodar" name="mat_fecha_bodar" class="form-control" type="date">
        </div>
        <div class="col-lg-4">
            <label for="mat_fecha_lic_ini">Fecha de inicio de licencia</label>
            <input id="mat_fecha_lic_ini" name="mat_fecha_lic_ini" class="form-control" type="date">
        </div>
        <div class="col-lg-4">
            <label for="mat_fecha_lic_fin">Fecha de finalización de licencia</label>
            <input id="mat_fecha_lic_fin" name="mat_fecha_lic_fin" class="form-control" type="date">
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