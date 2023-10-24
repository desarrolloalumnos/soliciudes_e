<div class="container mt-5">
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioProtocolos">
            <input type="hidden" name="cmv_id" id="cmv_id">
            <h1 class="text-center">COMBOS/MARIMBAS/VALLAS</h1>
            <div class="row mb-4 mt-3">
                <div class="col">
                    <label for="cmv_dependencia">Dependencias</label>
                    <select name="cmv_dependencia" id="cmv_dependencia" class="form-select">
                        <option value="" selected>SELECCIONE</option>
                        <?php foreach ($dependencias as $dependencia) { ?>
                            <option value="<?= $dependencia['dep_llave'] ?>"><?= $dependencia['dep_desc_md'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col">
                    <label for="cmv_tip">Combo/Marimba/Valla</label>
                    <select name="cmv_tip" id="cmv_tip" class="form-select">
                        <option value=" " selected>SELECCIONE</option>
                        <option value="Combos">COMBOS</option>
                        <option value="Marimbas">MARIMBAS</option>
                        <option value="Vallas">VALLAS</option>
                    </select>
                </div>
            </div>
            <!-- <div class="row mb-3">
            <div class="col">
                <label for="cmv_obs">Observaciones</label>
                <textarea name="cmv_obs" id="cmv_obs" class="form-control"></textarea>
            </div>
        </div> -->
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioProtocolos" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                </div>
            </div>
        </form>


    </div>







    <div class="row justify-content-center">
        <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
            <table id="tablaProtocolos" class="table table-bordered table-hover">
            </table>
        </div>
    </div>
</div>

<script src="<?= asset('./build/js/protocolos/index.js')  ?>"></script>