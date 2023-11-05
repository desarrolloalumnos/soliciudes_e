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
            render: function(data, type, row) {
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

// const traeDatos = (e) => {
//     const button = e.target;
//     const numero = button.dataset.id
//     const dependencia = button.dataset.dependencia
//     const llave = button.dataset.llave
//     const tipo = button.dataset.tipo


//     const dataset = {
//         numero,
//         llave,
//         dependencia,
//         tipo

//     };


//     colocarDatos(dataset);


// };

// const colocarDatos = (dataset) => {


//     dependencias.value = dataset.llave;
//     tipos.value = dataset.tipo;
//     id.value = dataset.numero;

//     btnGuardar.disabled = true
//     btnGuardar.parentElement.style.display = 'none'
//     btnBuscar.disabled = true
//     btnBuscar.parentElement.style.display = 'none'
//     btnModificar.disabled = false
//     btnModificar.parentElement.style.display = ''
//     btnCancelar.disabled = false
//     btnCancelar.parentElement.style.display = ''



// }

// const cancelarAccion = () => {
//     btnGuardar.disabled = false
//     btnGuardar.parentElement.style.display = ''
//     btnBuscar.disabled = false
//     btnBuscar.parentElement.style.display = ''
//     btnModificar.disabled = true
//     btnModificar.parentElement.style.display = 'none'
//     btnCancelar.disabled = true
//     btnCancelar.parentElement.style.display = 'none'
//     divTabla.style.display = ''
//     formulario.reset(); f
// }

// const modificar = async (evento) => {

//     evento.preventDefault();


//     const body = new FormData(formulario)
//     const url = '/soliciudes_e/API/protocolos/modificar';
//     const headers = new Headers();
//     headers.append("X-Requested-With", "fetch");
//     const config = {
//         method: 'POST',
//         body
//     }

//     try {
//         const respuesta = await fetch(url, config)
//         const data = await respuesta.json();


//         const { codigo, mensaje, detalle } = data;
//         let icon = 'info'
//         switch (codigo) {
//             case 1:
//                 formulario.reset();
//                 icon = 'success'
//                 buscar();
//                 cancelarAccion();
//                 break;

//             case 0:
//                 icon = 'error'
//                 console.log(detalle)
//                 break;

//             default:
//                 break;
//         }

//         Toast.fire({
//             icon,
//             text: mensaje
//         })

//     } catch (error) {
//         console.log(error);
//     }
// }

const enviar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea enviar esta solicitud?')) {
        const body = new FormData()
        body.append('sol_id', id)
        const url = '/soliciudes_e/API/administraciones/enviar';
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