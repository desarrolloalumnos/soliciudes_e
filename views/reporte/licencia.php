<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud para Licencia Temporal </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin-bottom: 10px;
            margin: auto;
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info-section {
            margin-bottom: 18px;
        }

        .info-label {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
<?php foreach ($valores as $valor) : ?>
    <div class="container" style="margin-top: 10px; page-break-inside: avoid;">
        <div class="header">
            <?php echo $enlace; ?>
            <p style="margin: 0;"><?= $valor['dependencia'] ?></p>
            <p style="margin: 0;"><?= $direccion[0] ?></p>
            <p style="margin: 0;"><?= date('d-m-Y', strtotime($valor['fecha'])) ?></p>
            <p class="title" style="margin-top: 10px;">TIPO DE TRÁMITE:</p>
            <p style="margin: 0;"><?= $valor['tse_descripcion'] ?></p>
            <p style="margin: 0;"><?= $valor['sol_identificador'] ?></p>
        </div>

        <div class="info-section" style="margin-top: 10px;">
            <p class="info-label">DATOS GENERALES:</p>
            <p style="margin: 0;">COMANDO: <?= $valor['ste_comando'] ?></p>
            <p style="margin: 0;">GRADO Y ARMA: <?= $valor['grado_solicitante'] ?></p>
            <p style="margin: 0;">NOMBRE: <?= $valor['nombre_solicitante'] ?></p>
            <p style="margin: 0;">EMPLEO: <?= $valor['ste_emp'] ?></p>
        </div>

        <div class="info-section" style="margin-top: 10px;">
            <p class="info-label">DATOS DE LA SOLICITUD:</p>
            <p style="margin: 0;">MOTIVO: <?= strtoupper($valor['mot_descripcion']) ?></p>
            <p style="margin: 0;">MESES CON SUELDO: <?= $valor['lit_mes_consueldo'] ?></p>
            <p style="margin: 0;">MESES SIN SUELDO: <?= $valor['lit_mes_sinsueldo'] ?></p>
            <p style="margin: 0;">FECHA DE INICIO DE LA LICENCIA: <?= date('d-m-Y', strtotime($valor['lit_fecha1'])) ?></p>
            <p style="margin: 0;">FECHA DE FINALIZACION DE LA LICENCIA: <?= date('d-m-Y', strtotime($valor['lit_fecha2'])) ?></p>
            <br>
            <p style="margin: 0;">AUTORIZADO POR:</p><b> <?= $valor['autorizador'] ?></b>
        </div>
    </div>
<?php endforeach; ?>


</body>

</html>
