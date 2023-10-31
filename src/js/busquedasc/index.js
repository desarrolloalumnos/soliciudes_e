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
            title: 'id_mat',
            className: 'text-center',
            data: 'mat_id'
        },
        {
            title: 'Catalogo Solicitante',
            className: 'text-center',
            data: 'ste_cat'
        },
        {
            title: 'Estado de la Solicitud',
            data: 'mat_situacion',
                
        },
        {
            title: 'Catalogo del Atorizador ',
            className: 'text-center',
            data: 'aut_cat'
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
            title: 'Catalogo de la Pareja',
            className: 'text-center',
            data: 'parejam_cat'
        },
        {
            title: 'Grado',
            className: 'text-center',
            data: 'grado_autorizacion'
        },
        {
            title: 'Nombres y Apellidos',
            className: 'text-center',
            data: 'nombres_autorizacion'
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
        },
        {
            targets: 4,
            visible: false,
            searchable: false,
        },
        {
            targets: 5,
            visible: false,
            searchable: false,
        },
        {
            targets: 6,
            visible: false,
            searchable: false,
        },
        {
            targets: 7,
            visible: false,
            searchable: false,
        },
        {
            targets: 8,
            visible: false,
            searchable: false,
        },
        {
            targets: 9,
            visible: false,
            searchable: false,
        },
        {
            targets: 10,
            visible: false,
            searchable: false,
        },
        {
            targets: 11,
            visible: false,
            searchable: false,
        },
        {
            targets: 12,
            visible: false,
            searchable: false,
        },
        {
            targets: 13,
            visible: false,
            searchable: false,
        },
        {
            targets: 14,
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