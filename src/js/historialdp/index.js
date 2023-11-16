import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";
const formulario = document.getElementById('formularioDepersonal');
const btnBuscar = document.getElementById('btnBuscar');



let contador = 1;
const datatable = new Datatable('#tablaDepersonal', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            className: 'text-center',
            render: () => contador++
        },
        {
            title: 'Solicitante',
            className: 'text-center',
            data: 'solicitante'
        },
        {
            title: 'Telefono',
            data: 'ste_telefono',
        },
        {
            title: 'Tipo',
            className: 'text-center',
            data: 'tipo'
        },
        {
            title: 'Motivo',
            className: 'text-center',
            data: 'motivo'
        },
        {
            title: 'Autorizador',
            className: 'text-center',
            data: 'autorizador'
        },
        {
            title: 'Estado',
            className: 'text-center',
            data: 'sol_situacion',
            render: function(data, type, row) {
                if (type === 'display') {
                    if (data === '5') {
                        return `<button class="btn btn-success">AUTORIZADO</button>`;
                    }else if (data === '6') {
                        return `<button class="btn btn-dark">RECHAZADA</button>`;
                    }else {
                        return ''; 
                    }
                }
                return data; 
            }
        },
    
    ],
});

const buscar = async () => {

    const url = `/soliciudes_e/API/historialdp/buscar`;


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

