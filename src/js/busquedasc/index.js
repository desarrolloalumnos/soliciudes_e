import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMatrimonio');
const btnBuscar = document.getElementById('btnBuscar');


let contador = 1;
const datatable = new Datatable('#tablaMatrimonios', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            className: 'text-center',
            render: () => contador++
        },
        {
            title: 'id_autorizacion',
            className: 'text-center',
            data: 'mat_autorizacion'
        },
        {
            title: 'id_pareja_civil',
            className: 'text-center',
            data: 'mat_per_civil'
        },
        {
            title: 'id_pareja_militar',
            className: 'text-center',
            data: 'mat_per_army'
        },
        {
            title: 'Catalogo Solicitante',
            className: 'text-center',
            data: 'ste_cat'
        },
        {
            title: 'Nombres y Apellidos ',
            className: 'text-center',
            data: 'nombres_solicitante'
        },
        {
            title: 'Catalogo del Atorizador ',
            className: 'text-center',
            data: 'aut_cat'
        },
        {
            title: 'Nombres y Apellidos',
            className: 'text-center',
            data: 'nombres_autorizacion'
        },
        {
            title: 'Lugar de la Boda Civil',
            className: 'text-center',
            data: 'mat_lugar_civil'
        },
        {
            title: 'Fecha de la Boda Civil',
            className: 'text-center',
             width: '100%',
            data: 'mat_fecha_bodac'
        },
        {
            title: 'Lugar de la Boda Religiosa',
            className: 'text-center',
            data: 'mat_lugar_religioso'
        },
        {
            title: 'Fecha de la Boda Religiosa',
            className: 'text-center',
            data: 'mat_fecha_bodar'
        },
        {
            title: 'Nombres de la Pareja Civil',
            className: 'text-center',
            data: 'nombres'
        },
        {
            title: 'Catalogo de la Pareja',
            className: 'text-center',
            data: 'parejam_cat'
        },
        {
            title: 'Nombres de la Pareja',
            className: 'text-center',
            data: 'nombres_pareja'
        },
        {
            title: 'Fin de Licencia',
            className: 'text-center',
            data: 'mat_fecha_lic_ini'
        },
        {
            title: 'Inicio de Licencia',
            className: 'text-center',
            data: 'mat_fecha_lic_fin'
        },
        {
            title: 'Estado de la Solicitud',
            className: 'text-center',
            data: 'mat_situacion'
        },
        {
            title: 'MODIFICAR',
            className: 'text-center',
            data: 'cmv_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-dependencia='${row["cmv_dependencia"]}'data-llave='${row["dep_llave"]}' data-tipo ='${row["cmv_tip"]}' >Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            className: 'text-center',
            data: 'cmv_id',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
    columnDefs: [
        {
            targets: 1,
            visible: false,
            searchable: false,
        },
        {
            targets: 2,
            visible: false,
            searchable: false,
        },
        {
            targets: 3,
            visible: false,
            searchable: false,
        }
    ]
});

const buscar = async () => {

    // let dep_valor = dependencias.value 
    // let tipo = tipos.value 

    const url = `/soliciudes_e/API/busquedasc/buscar`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        // console.log (data)
        // return;      
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

buscar();

btnBuscar.addEventListener('click', buscar);