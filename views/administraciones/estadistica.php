<div class="row mt-5">
    <div class="col-lg-6 offset-lg-3">
        <h1 class="text-center">Estados de Las Solicitudes</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <canvas id="chartEstados" width="100%"></canvas>
            <button id="btnActualizar" class="btn btn-info mt-3">Actualizar</button>
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