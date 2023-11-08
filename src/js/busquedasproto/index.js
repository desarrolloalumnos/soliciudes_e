import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioProtocolo');
const btnBuscar = document.getElementById('btnBuscar');

let contador = 1;
const datatable = new Datatable('#tablaProtocolo', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            className: 'text-center',
            render: () => contador++
        },
        {
            title: 'CATALOGO',
            className: 'text-center',
            data: 'ste_cat'
        },
        {
            title: 'NOMBRE',
            className: 'text-center',
            data: 'nombre'
        },
        {
            title: 'Combo, banda, marimba o valla',
            className: 'text-center',
            data: 'cmv_tip'
        },
        {
            title: 'Fecha inicio actividad',
            className: 'text-center',
            data: 'pco_fechainicio'
        },
        {
            title: 'Fecha fin actividad',
            className: 'text-center',
            data: 'pco_fechafin' 
        },
        {
            title: 'Dirección',
            className: 'text-center',
            data: 'pco_dir'
        },
        {
            title: 'PDF',
            data: 'pdf_ruta',
            render: (data, type, row, meta) => `<a class="btn btn-info" href="file:///C:\\docker\\soliciudes_e\\${data.substr(3)}">VER DOCUMENTACION</a>`
        },
        {
            title: 'MODIFICAR',
            className: 'text-center',
            data: 'lit_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-dependencia='${row["cmv_dependencia"]}' data-llave='${row["dep_llave"]}' data-tipo='${row["cmv_tip"]}'>Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            className: 'text-center',
            data: 'lit_id',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
});

const buscar = async () => {
    const url = `/soliciudes_e/API/busquedasproto/buscar`;
    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        datatable.clear().draw()
        if (data) {
            contador = 1;
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            })
        }
    } catch (error) {
        console.log(error);
    }
    formulario.reset();
}

modalM.show()
const button = e.target;
const pco_id = button.dataset.id
const pco_autorizacion = button.dataset.pco_autorizacion
const aut_id = button.dataset.aut_id
const aut_solicitud = button.dataset.aut_solicitud
const sol_id = button.dataset.sol_id
const sol_tipo = button.dataset.sol_tipo
const tse_id = button.dataset.tse_id
const sol_solicitante = button.dataset.sol_solicitante
const ste_id = button.dataset.ste_id
const ste_comando = button.dataset.ste_comando
const ste_cat = button.dataset.ste_cat
const ste_gra = button.dataset.ste_gra
const ste_arm = button.dataset.ste_arm
const ste_emp = button.dataset.ste_emp
const ste_fecha = button.dataset.ste_fecha
const sol_obs = button.dataset.sol_obs
const sol_motivo = button.dataset.sol_motivo
const mot_id = button.dataset.mot_id
const sol_situacion = button.dataset.sol_situacion
const aut_comando = button.dataset.aut_comando
const aut_cat = button.dataset.aut_cat
const aut_gra = button.dataset.aut_gra
const aut_arm = button.dataset.aut_arm
const aut_emp = button.dataset.aut_emp
const aut_fecha = button.dataset.aut_fecha
const pco_fechainicio = button.dataset.pco_fechainicio
const pco_fechafin = button.dataset.pco_fechafin
const pco_dir = button.dataset.pco_dir
const pco_just = button.dataset.pco_just
const mat_per_civil = button.dataset.mat_per_civil
const parejac_id = button.dataset.parejac_id
const parejac_direccion = button.dataset.parejac_direccion
const parejac_dpi = button.dataset.parejac_dpi
const mat_per_army = button.dataset.mat_per_army
const parejam_id = button.dataset.parejam_id
const parejam_cat = button.dataset.parejam_cat
const parejam_comando = button.dataset.parejam_comando
const parejam_gra = button.dataset.parejam_gra
const parejam_arm = button.dataset.parejam_arm
const pdf_id = button.dataset.pdf_id
const pdf_solicitud = button.dataset.pdf_solicitud
const mat_situacion = button.dataset.mat_situacion
const grado_solicitante = button.dataset.grado_solicitante
const nombres_solicitante = button.dataset.nombres_solicitante
const nombres = button.dataset.nombres
const grado_pareja = button.dataset.grado_pareja
const nombres_pareja = button.dataset.nombres_pareja
const mat_fecha_lic_ini = button.dataset.mat_fecha_lic_ini
const mat_fecha_lic_fin = button.dataset.mat_fecha_lic_fin
const ste_telefono = button.dataset.ste_telefono
const pdf_ruta = button.dataset.pdf_ruta

const dataset = {

    pco_id,
    pco_autorizacion,
    aut_id,
    aut_solicitud,
    sol_id,
    sol_tipo,
    tse_id,
    sol_solicitante,
    ste_id,
    ste_comando,
    ste_cat,
    ste_gra,
    ste_arm,
    ste_emp,
    ste_fecha,
    sol_obs,
    sol_motivo,
    mot_id,
    sol_situacion,
    aut_comando,
    aut_cat,
    aut_gra,
    aut_arm,
    aut_emp,
    aut_fecha,
    pco_fechainicio,
    pco_fechafin,
    pco_dir,
    pco_just,
    mat_per_civil,
    parejac_id,
    parejac_direccion,
    parejac_dpi,
    mat_per_army,
    parejam_id,
    parejam_cat,
    parejam_comando,
    parejam_gra,
    parejam_arm,
    pdf_id,
    pdf_solicitud,
    mat_situacion,
    grado_solicitante,
    nombres_solicitante,
    nombres,
    grado_pareja,
    nombres_pareja,
    mat_fecha_lic_ini,
    mat_fecha_lic_fin,
    ste_telefono,
    pdf_ruta

};
console.log(parejac_id)
colocarDatos(dataset);







const cancelarAccion = () => {
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    divTabla.style.display = '';
    formulario.reset();
}

buscar();
