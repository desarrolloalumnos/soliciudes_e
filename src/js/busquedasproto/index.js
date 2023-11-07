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
            title: 'pco_autorizacion',
            className: 'text-center',
            data: 'pco_autorizacion'
        },
        {
            title: 'aut_id',
            className: 'text-center',
            data: 'aut_id'
        },
        {
            title: 'aut_solicitud',
            className: 'text-center',
            data: 'aut_solicitud'
        },
        {
            title: 'sol_id',
            className: 'text-center',
            data: 'sol_id'
        },
        {
            title: 'sol_tipo',
            className: 'text-center',
            data: 'sol_tipo'
        },
        {
            title: 'tse_id',
            className: 'text-center',
            data: 'tse_id'
        },
        {
            title: 'sol_solicitante',
            className: 'text-center',
            data: 'sol_solicitante'
        },
        {
            title: 'ste_id',
            className: 'text-center',
            data: 'ste_id'
        },
        {
            title: 'ste_comando',
            className: 'text-center',
            data: 'ste_comando'
        },
        {
            title: 'ste_cat',
            className: 'text-center',
            data: 'ste_cat'
        },
        {
            title: 'ste_gra',
            className: 'text-center',
            data: 'ste_gra'
        },
        {
            title: 'ste_arm',
            className: 'text-center',
            data: 'ste_arm'
        },
        {
            title: 'ste_emp',
            className: 'text-center',
            data: 'ste_emp'
        },
        {
            title: 'ste_fecha',
            className: 'text-center',
            data: 'ste_fecha'
        },
        {
            title: 'sol_obs',
            className: 'text-center',
            data: 'sol_obs'
        },
        {
            title: 'sol_motivo',
            className: 'text-center',
            data: 'sol_motivo'
        },
        {
            title: 'mot_id',
            className: 'text-center',
            data: 'mot_id'
        },
        {
            title: 'sol_situacion',
            className: 'text-center',
            data: 'sol_situacion'
        },
        {
            title: 'aut_comando',
            className: 'text-center',
            data: 'aut_comando'
        },
        {
            title: 'aut_cat',
            className: 'text-center',
            data: 'aut_cat'
        },
        {
            title: 'aut_gra',
            className: 'text-center',
            data: 'aut_gra'
        },
        {
            title: 'aut_arm',
            className: 'text-center',
            data: 'aut_arm'
        },
        {
            title: 'aut_emp',
            className: 'text-center',
            data: 'aut_emp'
        },
        {
            title: 'aut_fecha',
            className: 'text-center',
            data: 'aut_fecha'
        },
        {
            title: 'pdf_id',
            className: 'text-center',
            data: 'pdf_id'
        },
        {
            title: 'pdf_solicitud',
            className: 'text-center',
            data: 'pdf_solicitud'
        },
        {
            title: 'Grado',
            className: 'text-center',
            data: 'grado_solicitante'
        },
        {
            title: 'Nombres',
            className: 'text-center',
            data: 'nombres_solicitante'
        },
        {
            title: 'Combo, banda, marimba y valla',
            className: 'text-center',
            data: 'pco_cmbv'
        },
        {
            title: 'Fecha inicio actividad',
            className: 'text-center',
            data: 'pco_fechainicio'
        },
        {
            title: 'Fecha fin actividad',
            className: 'text-center',
            data: 'pco_fechafin '
        },
        {
            title: 'Direccion',
            className: 'text-center',
            data: 'pco_dir '
        },
        {
            title: 'Justificacion',
            className: 'text-center',
            data: 'pco_just'
        },
        {
            title: 'Telefono',
            className: 'text-center',
            data: 'ste_telefono'
        },
        {
            title: 'PDF',
            data: 'pdf_ruta',
            render: (data, type, row, meta) => `<a class="btn btn-warning" href='C:/docker/${data}'>VER DOCUMENTACION</a>`
        },
        {
            title: 'MODIFICAR',
            className: 'text-center',
            data: 'lit_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-dependencia='${row["cmv_dependencia"]}'data-llave='${row["dep_llave"]}' data-tipo ='${row["cmv_tip"]}' >Modificar</button>`
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
    columnDefs: [
        {
            targets: [1, , 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26],
            visible: false,
            searchable: false,
        },

    ]
});
