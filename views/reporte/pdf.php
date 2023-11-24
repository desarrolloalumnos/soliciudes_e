<body>
    <div class="container" style="text-align: center;">
        <div class="info-section">
            <?php foreach ($valores as $index => $valor) : ?>
                <?= $valor['dependencia'] ?>
                <br>
                <?= $direccion[0] ?>
            <?php endforeach; ?>
        </div>
        <div class="info-section">
            <p class="info-label">BOLETA NO:</p>
            <br>
            <p class="info-label">TIPO DE TRAMITE:</p><?= strtoupper($valor['tse_descripcion']) ?>
            <br>
            <p class="info-label">ENVÍO LA BOLETA COMO: </p>
            <?= $valor['sol_situacion'] == 4 ? 'AUTORIZADO' : ($valor['sol_situacion'] == 7 ? 'CORRECCIONES' : 'OTRO') ?>

            <br>
            <p class="info-label">OBSERVACIONES:</p><?=strtoupper ($valor['obs']) ?>
        </div>
        <br>
        <br>
        <P>RESPONSABLE:</P>
        <br>
        <br>
        <div class="info-section">
            <?= $valor['autorizador'] ?>
        </div>
    </div>
</body>