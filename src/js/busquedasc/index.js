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
            title: 'mat_autorizacion',
            className: 'text-center',
            data: 'mat_autorizacion'
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
            title: 'mat_lugar_civil',
            className: 'text-center',
            data: 'mat_lugar_civil'
        },
        {
            title: 'mat_fecha_bodac',
            className: 'text-center',
            data: 'mat_fecha_bodac'
        },
        {
            title: 'mat_lugar_religioso',
            className: 'text-center',
            data: 'mat_lugar_religioso'
        },
        {
            title: 'mat_fecha_bodar',
            className: 'text-center',
            data: 'mat_fecha_bodar'
        },
        {
            title: 'mat_per_civil',
            className: 'text-center',
            data: 'mat_per_civil'
        },
        {
            title: 'parejac_id',
            className: 'text-center',
            data: 'parejac_id'
        },
        {
            title: 'parejac_direccion',
            className: 'text-center',
            data: 'parejac_direccion'
        },
        {
            title: 'parejac_dpi',
            className: 'text-center',
            data: 'parejac_dpi'
        },
        {
            title: 'mat_per_army',
            className: 'text-center',
            data: 'mat_per_army'
        },
        {
            title: 'parejam_id',
            className: 'text-center',
            data: 'parejam_id'
        },
        {
            title: 'parejam_cat',
            className: 'text-center',
            data: 'parejam_cat'
        },
        {
            title: 'parejam_comando',
            className: 'text-center',
            data: 'parejam_comando'
        },
        {
            title: 'parejam_gra',
            className: 'text-center',
            data: 'parejam_gra'
        },
        {
            title: 'parejam_arm',
            className: 'text-center',
            data: 'parejam_arm'
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
            title: 'mat_situacion',
            className: 'text-center',
            data: 'mat_situacion'
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
            title: 'Pareja Civil',
            className: 'text-center',
            data: 'nombres'
        },
        {
            title: 'Grado Pareja',
            className: 'text-center',
            data: 'grado_pareja'
        },
        {
            title: 'Nombres Pareja',
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
            title: 'Telefono',
            className: 'text-center',
            data: 'ste_telefono'
        },
        {
            title: 'PDF',
            className: 'text-center',
            data: 'pdf_ruta',
                 
        },
        {
            title: 'MODIFICAR',
            className: 'text-center',
            data: 'mat_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-dependencia='${row["cmv_dependencia"]}'data-llave='${row["dep_llave"]}' data-tipo ='${row["cmv_tip"]}' >Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            className: 'text-center',
            data: 'mat_id',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
    columnDefs: [
        {
            targets: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41],
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

const traeDatos = (e) => {
    const button = e.target;
    const numero = button.dataset.id
    const dependencia = button.dataset.dependencia
    const llave = button.dataset.llave
    const tipo = button.dataset.tipo


    const dataset = {
        numero,
        llave,
        dependencia,
        tipo

    };


    colocarDatos(dataset);


};

const colocarDatos = (dataset) => {


    dependencias.value = dataset.llave;
    tipos.value = dataset.tipo;
    id.value = dataset.numero;

    btnGuardar.disabled = true
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.disabled = true
    btnBuscar.parentElement.style.display = 'none'
    btnModificar.disabled = false
    btnModificar.parentElement.style.display = ''
    btnCancelar.disabled = false
    btnCancelar.parentElement.style.display = ''



}

const cancelarAccion = () => {
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    divTabla.style.display = ''
    formulario.reset(); f
}

const modificar = async (evento) => {

    evento.preventDefault();


    const body = new FormData(formulario)
    const url = '/soliciudes_e/API/protocolos/modificar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();


        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
                buscar();
                cancelarAccion();
                break;

            case 0:
                icon = 'error'
                console.log(detalle)
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea elminar este registro?')) {
        const body = new FormData()
        body.append('cmv_id', id)
        const url = '/soliciudes_e/API/protocolos/eliminar';
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'POST',
            body
        }
        try {
            const respuesta = await fetch(url, config)
            const data = await respuesta.json();

            const { codigo, mensaje, detalle } = data;
            let icon = 'info'
            switch (codigo) {
                case 1:

                    icon = 'success'

                    break;

                case 0:
                    icon = 'error'
                    console.log(detalle)
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje
            })




        } catch (error) {
            console.log(error);
        }
    }

    // buscar();
}

buscar();

btnBuscar.addEventListener('click', buscar);

// datatable.on('click', '.btn-warning', traeDatos);
// datatable.on('click', '.btn-danger', eliminar);
// btnModificar.addEventListener('click', modificar)
// btnCancelar.addEventListener('click', cancelarAccion)