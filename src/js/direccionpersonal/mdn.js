import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMdn');
const btnBuscar = document.getElementById('btnBuscar');


let contador = 1;
const datatable = new Datatable('#tablaMdn', {
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
            render: function (data, type, row) {
                if (type === 'display') {
                    if (data === '1') {
                        return `<span style="color: red;">COMANDO</span>`;
                    } else if (data === '2') {
                        return `<span >DGAEMDN</span>`;
                    } else if (data === '3') {
                        return `<span >DPEMDN</span>`;
                    } else if (data === '4') {
                        return `<span >MDN</span>`;
                    } else if (data === '5') {
                        return `<span>AUTORIZADO</span>`;
                    } else if (data === '6') {
                        return `<span>RECHAZADA</span>`;
                    } else if (data === '7') {
                        return `<button class="btn btn-danger">CORREGIR</button>`;
                    } else {
                        return '';
                    }
                }
                return data;
            }
        },
        {
            title: 'Autorización',
            className: 'text-center',
            data: 'sol_situacion',
            render: function(data, type, row) {
                if (type === 'display') {
                    if (data === '5') {
                        return `<button class="btn btn-success btn-autorizar" data-id='${row.sol_id}'>Autorizado</button>`;
                    } else if (data === '6') {
                        return `<button class="btn btn-danger btn-rechazar" data-id='${row.sol_id}'>Rechazado</button>`;
                    } else if (data === '7') {
                        return `<button class="btn btn-danger">Correcciones</button>`;
                    } else {
                        return '';
                    }
                }
                return data;
            }
        }
    ],
});

const buscar = async () => {

 
    const url = `/soliciudes_e/API/direccionpersonal/buscarMdn`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        // console.log (data)     
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


const aprobarRechazarSolicitud = async (id, accion) => {
    if (await confirmacion('warning', `Desea ${accion.toLowerCase()} esta solicitud?`)) {
        const body = new FormData();
        body.append('sol_id', id);
        body.append('accion', accion);

        const url = '/soliciudes_e/API/direccionpersonal/aprobarRechazarSolicitud';
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'POST',
            body
        };

        try {
            const respuesta = await fetch(url, config);
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
};

buscar();

btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-autorizar', (e) => aprobarRechazarSolicitud(e.target.dataset.id, 'aprobar'));
datatable.on('click', '.btn-rechazar', (e) => aprobarRechazarSolicitud(e.target.dataset.id, 'rechazar'));

