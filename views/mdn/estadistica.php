<style>
    body {
        background-color: #f4f4f4;
    }

    .card {
        background-color: #ffffff;
        margin-bottom: 30px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .reporte-titulo {
        font-family: Arial;
        font-size: 36px;
        font-weight: bold;
        color: #333333;
        text-align: center;
    }

    #btnActualizar {
        background-color: #3498db;
        color: #ffffff;
        border: none;
    }

    /* Gráficas */
    .chart-container {
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-bottom: 30px;
    }

    canvas {
        width: 100%;
    }
</style>

<div class="container mt-5">
    <!-- Filtros -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <h3 class="reporte-titulo mb-4">Filtrar Solicitudes</h3>
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
                        <button id="btnActualizar" class="btn btn-info mt-3">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Gráficas de Estados de las Solicitudes -->
    <div class="row mt-5">
        <div class="col-lg-6 offset-lg-3">
            <h1 class="reporte-titulo text-center">Estados de Las Solicitudes</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="chart-container">
                <canvas id="chartEstados"></canvas>
            </div>
        </div>
    </div>

    <!-- Gráficas de Tipos de Solicitudes -->
    <div class="row mt-5">
        <div class="col-lg-6 offset-lg-3">
            <h1 class="reporte-titulo text-center">Tipos de Solicitudes</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="chart-container">
                <canvas id="chartMotivos"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="<?=asset('./build/js/mdn/estadistica.js') ?>"></script>