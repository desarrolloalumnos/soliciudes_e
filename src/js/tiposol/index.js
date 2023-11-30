import { Dropdown } from "bootstrap";
import Swal from 'sweetalert2';
import { validarFormulario, Toast, confirmacion } from '../funciones';
import Datatable from 'datatables.net-bs5';
import { lenguaje } from '../lenguaje';

const formulario = document.querySelector('form');
const btnGuardar = document.getElementById('btnGuardar');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

let contador = 1;
btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

const datatable = new Datatable('#tablaTipoSolicitudes', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contador++,
        },
        {
            title: 'DESCRIPCIÓN',
            data: 'tse_descripcion',
        },
        {
            title: 'MODIFICAR',
            data: 'tse_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) =>
                `<button class="btn btn-warning" data-id='${data}' data-descripcion='${row['tse_descripcion']}'>Modificar</button>`,
        },
        {
            title: 'ELIMINAR',
            data: 'tse_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) =>
                `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`,
        },
    ],
});

const buscar = async () => {
    let tse_descripcion = formulario.tse_descripcion.value;
    const url = `/soliciudes_e/API/tiposol/buscar?tse_descripcion=${tse_descripcion}`;
    const config = {
        method: 'GET',
    };
    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        datatable.clear().draw();
        if (data) {
            contador = 1;
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info',
            });
        }
    } catch (error) {
        console.log(error);
    }
};

const traeDatos = (e) => {
    const button = e.target;
    const id = button.dataset.id;
    const descripcion = button.dataset.descripcion;
    const dataset = {
        id,
        descripcion,
    };

    colocarDatos(dataset);

    const body = new FormData(formulario);
    body.append('tse_id', id);
    body.append('tse_descripcion', descripcion);
};

const colocarDatos = (dataset) => {
    formulario.tse_descripcion.value = dataset.descripcion;
    formulario.tse_id.value = dataset.id;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
};

const cancelarAccion = () => {
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
};

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('tse_id', id);
        const url = '/soliciudes_e/API/tiposol/eliminar';
        const config = {
            method: 'POST',
            body,
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            let icon = 'info';
            switch (data.codigo) {
                case 1:
                    icon = 'success';
                    buscar();
                    break;
                case 0:
                    icon = 'error';
                    console.log(data.detalle);
                    break;
                default:
                    break;
            }

            Toast.fire({
                icon,
                text: data.mensaje,
            });
        } catch (error) {
            console.log(error);
        }
    }
};

const modificar = async () => {
    if (!validarFormulario(formulario)) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los campos',
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/soliciudes_e/API/tiposol/modificar';
    const config = {
        method: 'POST',
        body,
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        let icon = 'info';
        switch (data.codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                cancelarAccion();
                break;
            case 0:
                icon = 'error';
                console.log(data.detalle);
                break;
            default:
                break;
        }

        Toast.fire({
            icon,
            text: data.mensaje,
        });
    } catch (error) {
        console.log(error);
    }
};

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['tse_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos',
        });
        return;
    }
    const body = new FormData(formulario);
    body.delete('tse_id');
    const url = '/soliciudes_e/API/tiposol/guardar';
    const config = {
        method: 'POST',
        body,
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
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
};

buscar();

datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
formulario.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);