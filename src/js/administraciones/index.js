import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";
const formulario = document.getElementById('formularioAdministracion');
const btnBuscar = document.getElementById('btnBuscar');


let contador = 1;
const datatable = new Datatable('#tablaAdministracion', {
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
            render: function (data, type, row) {
                if (type === 'display') {
                    if (data === '1') {
                        return `
            <span style="color: red;">COMANDO</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
                </div>
            `;
                    } else if (data === '2') {
                        return `
                        <span >DGAEMDN</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>
                </div>
            `;
                    } else if (data === '3') {
                        return `
                        <span >DPEMDN</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                </div>
            `;
                    } else if (data === '4') {
                        return `
                        <span >MDN</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                </div>
            `;
                    } else if (data === '5') {
                        return `
                        <span>AUTORIZADO</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            `;
                    } else if (data === '6') {
                        return `<button class="btn btn-danger">RECHAZADA</button>`;
                    } else if (data === '7') {
                        return `<button class="btn btn-warning">CORRECCIONES</button>`;
                    } else {
                        return '';
                    }
                }
                return data;
            }
        },

        {
            title: 'Telefono',
            data: 'ste_telefono',
        },
        {
            title: 'Enviar',
            className: 'text-center',
            data: 'sol_id',
            searchable: false,
            orderable: false,
            render: function (data, type, row) {
                if (type === 'display') {
                    if (row.sol_situacion !== '1') {
                        return `<button class="btn btn-secondary">Enviado</button>`;
                    } else {
                        return `<button class="btn btn-primary" data-id='${data}'>Enviar</button>`;
                    }
                }
                return data;
            }
        },
    ],
});

const buscar = async () => {

    // let dep_valor = dependencias.value 
    // let tipo = tipos.value 

    const url = `/soliciudes_e/API/administraciones/buscar`;


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


const enviar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea enviar esta solicitud?')) {
        const body = new FormData()
        body.append('sol_id', id)
        const url = '/soliciudes_e/API/administraciones/enviarDga';
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
            let icon = 'info';
            switch (codigo) {
                case 1:
                    icon = 'success';
                    buscar();
                    break;

                case 0:
                    icon = 'error';
                    console.log(detalle);
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje,
            });
        } catch (error) {
            console.log(error);
        }
    }

}
buscar();


btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-primary', enviar);