import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const modalL = new Modal(document.getElementById('modalLicencia'), {})
const formulario = document.getElementById('formularioLicencia');
const formularioModal = document.getElementById('formularioLicenciasB');
const btnBuscar = document.getElementById('btnBuscar');


let contador = 1;
const datatable = new Datatable('#tablaLicencias', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            className: 'text-center',
            render: () => contador++
        },
        {
            title: 'sol_id',
            className: 'text-center',
            data: 'sol_id'
        },
        {
            title: 'tiempo',
            className: 'text-center',
            data: 'tiempo'
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
            title: 'ste_cat',
            className: 'text-center',
            data: 'ste_cat'
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
            title: 'Meses con sueldo',
            className: 'text-center',
            data: 'lit_mes_consueldo'
        },
        {
            title: 'Meses sin sueldo',
            className: 'text-center',
            data: 'lit_mes_sinsueldo'
        },
        {
            title: 'Inicio de Licencia',
            className: 'text-center',
            data: function (row) {
                return row.lit_fecha1.substring(0, 10);
            }
        },
        {
            title: 'Fin de Licencia',
            className: 'text-center',
            data: function (row) {
                return row.lit_fecha2.substring(0, 10);
            }
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
            render: function (data) {
                return `<button  class="btn btn-outline-info" data-ruta="${data.substr(10)}"><i class="bi bi-eye"></i>Ver PDF</button>`;
            },
            width: '150px'
        },
        {
            title: 'MODIFICAR',
            className: 'text-center',
            data: 'lit_id',
            searchable: false,
            orderable: false,
            render: function (data, type, row, meta) {
                return `<button class="btn btn-warning" 
                                data-id="${data}"                                                   
                                data-sol_id="${row['sol_id']}"
                                data-tiempo="${row['tiempo']}"
                                data-sol_solicitante="${row['sol_solicitante']}"
                                data-ste_id="${row['ste_id']}"
                                data-ste_cat="${row['ste_cat']}"
                                data-sol_obs="${row['sol_obs']}"
                                data-sol_motivo="${row['sol_motivo']}"
                                data-mot_id="${row['mot_id']}"
                                data-pdf_id="${row['pdf_id']}"
                                data-pdf_solicitud="${row['pdf_solicitud']}"
                                data-grado_solicitante="${row['grado_solicitante']}"
                                data-nombres_solicitante="${row['nombres_solicitante']}"
                                data-lit_mes_consueldo="${row['lit_mes_consueldo']}"
                                data-lit_mes_sinsueldo="${row['lit_mes_sinsueldo']}"
                                data-lit_fecha1="${row['lit_fecha1'].substring(0, 10)}"
                                data-lit_fecha2="${row['lit_fecha2'].substring(0, 10)}"
                                data-ste_telefono="${row['ste_telefono']}">
                            Modificar
                        </button>`;
             }
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
            targets: [1,2, 3, 4, 5, 6, 7, 8, 9, 10,11],
            visible: false,
            searchable: false,
        },

    ]
});

const buscar = async () => {

    // let dep_valor = dependencias.value 
    // let tipo = tipos.value 

    const url = `/soliciudes_e/API/busquedaslict/buscar`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
           
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
    modalL.show();
    const button = e.target;
    const sol_id = button.dataset.sol_id;
    const tiempo = button.dataset.tiempo;
    const sol_solicitante = button.dataset.sol_solicitante;
    const ste_id = button.dataset.ste_id;
    const ste_cat = button.dataset.ste_cat;
    const sol_obs = button.dataset.sol_obs;
    const sol_motivo = button.dataset.sol_motivo;
    const mot_id = button.dataset.mot_id;
    const pdf_id = button.dataset.pdf_id;
    const pdf_solicitud = button.dataset.pdf_solicitud;
    const grado_solicitante = button.dataset.grado_solicitante;
    const nombres_solicitante = button.dataset.nombres_solicitante;
    const lit_mes_consueldo = button.dataset.lit_mes_consueldo;
    const lit_mes_sinsueldo = button.dataset.lit_mes_sinsueldo;
    
    const dataset = {
        sol_id,
        tiempo,
        sol_solicitante,
        ste_id,
        ste_cat,
        sol_obs,
        sol_motivo,
        mot_id,
        pdf_id,
        pdf_solicitud,
        grado_solicitante,
        nombres_solicitante,
        lit_mes_consueldo,
        lit_mes_sinsueldo
    };

    formularioModal.sol_id.value = dataset.sol_id;
    formularioModal.sol_solicitante.value = dataset.sol_solicitante;
    formularioModal.ste_id.value = dataset.ste_id;
    formularioModal.ste_cat.value = dataset.ste_cat;
    formularioModal.sol_obs.value = dataset.sol_obs;
    formularioModal.sol_motivo.value = dataset.sol_motivo;
    formularioModal.mot_id.value = dataset.mot_id;
    formularioModal.pdf_id.value = dataset.pdf_id;
    formularioModal.pdf_solicitud.value = dataset.pdf_solicitud;
    formularioModal.grado_solicitante.value = dataset.grado_solicitante;
    formularioModal.nombres_solicitante.value = dataset.nombres_solicitante;

    formularioModal.tiempo.value = dataset.tiempo;
    const numero = dataset.tiempo;
            formatoTiempo(numero).then((tiempoFormateado) => {
                formulario.tiempo_servicio.value = tiempoFormateado;
            })
            const numeroEntero = parseInt(numero, 10);
            if (numeroEntero >= 10000 && numeroEntero <= 50000) {
                formulario.lit_mes_consueldo.setAttribute('max', '0');
                formulario.lit_mes_sinsueldo.setAttribute('max', '3');
                formulario.lit_articulo.value = '2'
            } else if (numeroEntero >= 50001 && numeroEntero <= 100000) {
                formulario.lit_mes_consueldo.setAttribute('max', '0');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '3'
            } else if (numeroEntero >= 100001 && numeroEntero <= 200000) {
                formulario.lit_mes_consueldo.setAttribute('max', '1');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '4'
            } else if (numeroEntero >= 200001 && numeroEntero <= 280000) {
                formulario.lit_mes_consueldo.setAttribute('max', '2');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '5'
            } else if (numeroEntero >= 280001 && numeroEntero <= 330000) {
                formulario.lit_mes_consueldo.setAttribute('max', '1');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '6'
            } else if (numeroEntero >= 33001) {
                formulario.lit_mes_consueldo.setAttribute('max', '2');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '6'
            } else {
                return
            }
    formularioModal.lit_mes_consueldo.value = dataset.lit_mes_consueldo;
    formularioModal.lit_mes_sinsueldo.value = dataset.lit_mes_sinsueldo;
};



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

    buscar();
}

const verPDF = (e) => {
    // const button = e.target;
const boton = e.target
let ruta = boton.dataset.ruta 

let pdf = btoa(btoa(btoa(ruta))) 

window.open(`/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`)
 
}
buscar();

btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-outline-info', verPDF);
datatable.on('click', '.btn-warning',traeDatos )


// btnModificar.addEventListener('click', modificar)
// btnCancelar.addEventListener('click', cancelarAccion)