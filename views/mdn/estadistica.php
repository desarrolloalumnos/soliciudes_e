<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas </title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .reporte-titulo {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            transition: color 0.3s ease;
        }

        .reporte-titulo:hover {
            color: #2079b0;
        }

        #btnActualizar {
            background-color: #3498db;
            color: #fff;
            padding: 15px 25px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
            margin: auto;
            margin-top: 20px;
        }

        #btnActualizar:hover {
            background-color: #2079b0;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 30px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            margin-bottom: 30px;
            flex: 0 0 calc(50% - 30px);
            border-radius: 10px;
            box-sizing: border-box;
            margin-right: 30px;
            position: relative;
            z-index: 1;

        }
        .card:hover {
            transform: scale(1.3);
            box-shadow: 0 10px 20px rgba(33, 150, 243, 0.5);
            z-index: 2;
        }
        .card:last-child {
            margin-right: 0;
        }

        @media screen and (max-width: 768px) {
            .card {
                flex-basis: calc(100% - 50px);
            }
        }

    
        .card h4 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Filtrar Solicitudes</h1>
                    <p class="card-title text-center mb-4">Intervalos de 3 meses </p>
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
    </div>
</div>


<body>
    <div class="container">
        <h1 class="reporte-titulo">ESTADISTICAS</h1>
        <div class="row">
            <div class="card">
                <h4>Paises mas Visitados</h4>
                <canvas id="chart3TopPaises"></canvas>
            </div>
            <div class="card">
                <h4>Oficiales con mas solicitudes</h4>
                <canvas id="chart3Top5"></canvas>
            </div>
            <div class="card">
                <h4>Concurrencia</h4>
                <canvas id="chart3Concurrencia"></canvas>
            </div>
            <div class="card">
                <h4>Tipos de Solicitudes</h4>
                <canvas id="chart3Motivos"></canvas>
            </div>
            <div class="card">
                <h4>Estados de Las Solicitudes</h4>
                <canvas id="chart3Estados"></canvas>
            </div>

        </div>
    </div>


    <script src="<?= asset('./build/js/mdn/estadistica.js') ?>"></script>

</body>

</html>