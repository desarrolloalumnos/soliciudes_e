<body>
    <div class="container" style="text-align: center;">
        <?php echo $enlace; ?>
        <div class="info-section">
            <?php foreach ($valores as $index => $valor) : ?>
                <?= $valor['dependencia'] ?>
                <br>
                <?= $direccion[0] ?>
            <?php endforeach; ?>
        </div>
        <div class="info-section" style="display: flex; flex-direction: column;">
            <p class="info-label" style="font-weight: bold;">BOLETA NO:</p>
            <?php foreach ($valores as $index => $valor) : ?>
                <p><?= $valor['sol_identificador'] ?></p>
            <?php endforeach; ?>
            <br>

            <p class="info-label" style="font-weight: bold;">TIPO DE TRAMITE:</p>
            <p><?= strtoupper($valor['tse_descripcion']) ?></p>
            <br>
            <p class="info-label" style="font-weight: bold;">ENVÍO LA BOLETA COMO:</p>
            <p><?= $valor['sol_situacion'] == 4 || 5 ? 'AUTORIZADO' : ($valor['sol_situacion'] == 7 ? 'CORRECCIONES' : 'OTRO') ?></p>
            <br>
            <p class="info-label" style="font-weight: bold;">OBSERVACIONES:</p>
            <p><?= strtoupper($valor['obs']) ?></p>
        </div>

        <br>
        <br>
        <P style="float: left; font-weight: bold;">RESPONSABLE:</P>

        <div class="info-section">
            <?php foreach ($valores as $index => $valor) : ?>
                <?= $valor['autorizador'] ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
