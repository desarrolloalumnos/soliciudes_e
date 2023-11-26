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
            title: 'Dependencia',
            className: 'text-center',
            data: 'dependencia_solicitante'
        },

        {
            title: 'Estado',
            className: 'text-center',
            data: 'sol_situacion',
            render: function (data, type, row) {
                if (type === 'display') {
                    if (data === '4') {
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
                        return `<span>CORRECCIONES PENDIENTES</span>`;
                    } else if (data === '8') {
                        return `<span>CORRECCIONES APLICADAS</span>`;
                    } else {
                        return `<span>SITUACION NO COMTEMPLADA</span>`;
                    }
                }
                return data;
            }
        },
        {
            title: 'Autorización',
            className: 'text-center',
            data: 'ste_id',
            searchable: false,
            orderable: false,
            render: function (data, type, row) {
                if (type === 'display') {
                    if (row.sol_situacion === '6') {
                        return `
                        <div  class="btn-group">
                        <button class="btn btn-secondary">Autorizada</button>
                        
                         </div>
                         `;
                    } else (row.sol_situacion === '4')
                    {
                        return `<button class="btn btn-primary" data-id='${data}' data-tse_id='${row.tse_id}'data-sol_id='${row.sol_id}'data-sol_situacion='${row.sol_situacion}'>Revisar</button>`;
                    }
                }
                return data;
            }
        },

    ],
    columnDefs: [
        {
            targets: [1],
            visible: false
        },
    ],
});

const buscar = async () => {

    const catalogo = formulario.ste_cat.value
    const fecha = formulario.ste_fecha.value
    const estado = formulario.sol_situacion.value
    const tipo = formulario.tse_id.value

    const url = `/soliciudes_e/API/direccionpersonal/buscar?catalogo=${catalogo}&fecha=${fecha}&estado=${estado}&tipo=${tipo}`;


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

