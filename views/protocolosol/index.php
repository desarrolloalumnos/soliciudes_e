<h1 class="text-center">Solicitud de conjunto musical, combos, marimbas y vallas</h1>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <form class="col-lg-8 border bg-light p-3" id="formularioProtocolo" accept-charset="UTF-8">
                <input type="hidden" name="pco_id" id="pco_id">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pco_autorizacion">Autorizado por:</label>
                        <input type="text" name="pco_autorizacion" id="pco_autorizacion" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="pco_cmbv">Seleccione el Combo, Marimba o Conjunto Musical</label>
                        <select type="text" name="pco_cmbv" id="pco_cmbv" class="form-control">
                            <option value="1">Marimba Alas de Seda</option>
                            <option value="0">Valla de cadetes navales</option>
                        </select>
                            
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pco_civil">Civil</label>
                        <input type="text" name="pco_civil" id="pco_civil" class="form-control">
                    </div> -->
                    <div class="col-md-6">
                        <label for="pco_fechainicio">Fecha y hora de inicio de la actividad:</label>
                        <input type="datetime-local" name="pco_fechainicio" id="pco_fechainicio" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pco_fechafin">Fecha y hora de finalización de la actividad:</label>
                        <input type="datetime-local" name="pco_fechafin" id="pco_fechafin" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="pco_dir">Dirección donde se ralizará la actividad:</label>
                        <input type="text" name="pco_dir" id="pco_dir" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pco_just">Escriba la justificación de la actividad:</label>
                        <input type="text" name="pco_just" id="pco_just" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" form="formularioProtocolo" id="btnGuardar" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                    <div class="col">
                        <button type="button" id="btnCancelar" class="btn btn-danger btn-block">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>