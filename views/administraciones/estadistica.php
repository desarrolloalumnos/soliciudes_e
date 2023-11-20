
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Filtrar Solicitudes</h3>
                    <form id="formularioFiltros">
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                        </div>
                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin">
                        </div>
                        <div class="text-center">
                        <button id="btnActualizar" class="btn btn-info mt-3">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-6 offset-lg-3">
        <h1 class="text-center">Estados de Las Solicitudes</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <canvas id="chartEstados" width="100%"></canvas>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-6 offset-lg-3">
        <h1 class="text-center">Motivos de Las Solicitudes</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <canvas id="chartMotivos" width="100%"></canvas>
            <button id="btnActualizar" class="btn btn-info mt-3">Actualizar</button>
        </div>
    </div>
</div>


<script src="<?=asset('./build/js/administraciones/estadistica.js') ?>"></script>