import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatearFecha, formatoTiempo } from "../funciones";


const modalL = new Modal(document.getElementById('modalLicencia'), {
    backdrop: 'static',
    keyboard: false
});



const formulario = document.getElementById('formularioLicencia');
const formularioModal = document.getElementById('formularioLicenciasB');
const btnBuscar = document.getElementById('btnBuscar');
const btnModficarDatos = document.getElementById('modificar')
const divPdf = document.getElementById('licencias');
const divLicencias = document.getElementById('pdf');
const addPdf = document.getElementById('addPdf')


formularioModal.ste_cat.disabled = true;
formularioModal.nombre.disabled = true;
const iframe = document.getElementById('pdfLicencia');
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
            render: (data, type, row, meta) =>
                `<div class="btn-group">
                        <button class="btn btn-warning" 
                        data-id="${data}"                                                   
                        data-sol_id="${row['sol_id']}"
                        data-tiempo="${row['tiempo']}"
                        data-ste_id="${row['ste_id']}"
                        data-ste_cat="${row['ste_cat']}"
                        data-sol_obs="${row['sol_obs']}"
                        data-sol_motivo="${row['sol_motivo']}"
                        data-ste_telefono="${row['ste_telefono']}"
                        data-mot_id="${row['mot_id']}"
                        data-pdf_id="${row['pdf_id']}"
                        data-pdf_solicitud="${row['pdf_solicitud']}"
                        data-grado_solicitante="${row['grado_solicitante']}"
                        data-nombres_solicitante="${row['nombres_solicitante']}"
                        data-lit_mes_consueldo="${row['lit_mes_consueldo']}"
                        data-lit_mes_sinsueldo="${row['lit_mes_sinsueldo']}"
                        data-lit_fecha1="${row['lit_fecha1'].substring(0, 10)}"
                        data-lit_fecha2="${row['lit_fecha2'].substring(0, 10)}"
                        data-ste_telefono="${row['ste_telefono']}"
                        data-pdf_ruta='${row["pdf_ruta"]}'>
                    DATOS
                </button>
                <button class="btn btn-outline-warning" data-pdf_id='${row["pdf_id"]}' data-ste_cat='${row["ste_cat"]}'data-pdf_solicitud='${row["pdf_solicitud"]}' data-pdf_ruta='${row["pdf_ruta"]}'>PDF</button>
                    </div>`

        },
        {
            title: 'ELIMINAR',
            className: 'text-center',
            data: 'sol_id',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],

});

const buscar = async () => {

    const catalogo = formulario.ste_cat.value
    const fecha = formulario.ste_fecha.value

    const url = `/soliciudes_e/API/busquedaslict/buscar?catalogo=${catalogo}&fecha=${fecha}`;


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
    divPdf.style.display = 'block';
    divLicencias.style.display = 'none';

    const button = e.target;
    const lit_id = button.dataset.id;
    const sol_id = button.dataset.sol_id;
    const tiempo = button.dataset.tiempo;
    const ste_id = button.dataset.ste_id;
    const ste_cat = button.dataset.ste_cat;
    const sol_obs = button.dataset.sol_obs;
    const ste_telefono = button.dataset.ste_telefono;
    const mot_id = button.dataset.mot_id;
    const grado_solicitante = button.dataset.grado_solicitante;
    const nombres_solicitante = button.dataset.nombres_solicitante;
    const lit_mes_consueldo = button.dataset.lit_mes_consueldo;
    const lit_mes_sinsueldo = button.dataset.lit_mes_sinsueldo;
    const lit_fecha1 = button.dataset.lit_fecha1;
    const lit_fecha2 = button.dataset.lit_fecha2;
    const pdf_ruta = button.dataset.pdf_ruta;
    // const pdf_id = button.dataset.pdf_id;
    // const pdf_solicitud = button.dataset.pdf_solicitud;

    const dataset = {
        lit_id,
        sol_id,
        tiempo,
        ste_id,
        ste_cat,
        ste_telefono,
        sol_obs,
        mot_id,
        grado_solicitante,
        nombres_solicitante,
        lit_mes_consueldo,
        lit_mes_sinsueldo,
        // pdf_id,
        // pdf_solicitud,
        lit_fecha1,
        lit_fecha2,
        pdf_ruta

    };

    console.log(dataset);
    formularioModal.lit_id.value = dataset.lit_id;
    formularioModal.sol_id.value = dataset.sol_id;
    formularioModal.ste_id.value = dataset.ste_id;
    formularioModal.ste_cat.value = dataset.ste_cat;
    formularioModal.ste_telefono.value = dataset.ste_telefono;
    formularioModal.sol_obs.value = dataset.sol_obs;
    formularioModal.sol_motivo.value = dataset.mot_id;
    formularioModal.nombre.value = dataset.nombres_solicitante;

    formularioModal.tiempo.value = dataset.tiempo;

    const numero = dataset.tiempo;


    formatoTiempo(numero).then((tiempoFormateado) => {
        formularioModal.tiempo_servicio.value = tiempoFormateado;
    })
    const numeroEntero = parseInt(numero, 10);
    if (numeroEntero >= 10000 && numeroEntero <= 50000) {
        formularioModal.lit_mes_consueldo.setAttribute('max', '0');
        formularioModal.lit_mes_sinsueldo.setAttribute('max', '3');
        formularioModal.lit_articulo.value = '2'
    } else if (numeroEntero >= 50001 && numeroEntero <= 100000) {
        formularioModal.lit_mes_consueldo.setAttribute('max', '0');
        formularioModal.lit_mes_sinsueldo.setAttribute('max', '6');
        formularioModal.lit_articulo.value = '3'
    } else if (numeroEntero >= 100001 && numeroEntero <= 200000) {
        formularioModal.lit_mes_consueldo.setAttribute('max', '1');
        formularioModal.lit_mes_sinsueldo.setAttribute('max', '6');
        formularioModal.lit_articulo.value = '4'
    } else if (numeroEntero >= 200001 && numeroEntero <= 280000) {
        formularioModal.lit_mes_consueldo.setAttribute('max', '2');
        formularioModal.lit_mes_sinsueldo.setAttribute('max', '6');
        formularioModal.lit_articulo.value = '5'
    } else if (numeroEntero >= 280001 && numeroEntero <= 330000) {
        formularioModal.lit_mes_consueldo.setAttribute('max', '1');
        formularioModal.lit_mes_sinsueldo.setAttribute('max', '6');
        formularioModal.lit_articulo.value = '6'
    } else if (numeroEntero >= 33001) {
        formularioModal.lit_mes_consueldo.setAttribute('max', '2');
        formularioModal.lit_mes_sinsueldo.setAttribute('max', '6');
        formularioModal.lit_articulo.value = '6'
    } else {
        return
    }
    formularioModal.lit_mes_consueldo.value = dataset.lit_mes_consueldo;
    formularioModal.lit_mes_sinsueldo.value = dataset.lit_mes_sinsueldo;
    formularioModal.lit_fecha1.value = dataset.lit_fecha1;
    formularioModal.lit_fecha2.value = dataset.lit_fecha2
    // formularioModal.pdf_id.value = dataset.pdf_id;
    // formularioModal.pdf_solicitud.value = dataset.pdf_solicitud;
    let pdf = btoa(btoa(btoa(dataset.pdf_ruta)));
    let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`;
    iframe.src = ver

};

const modificar = async (evento) => {

    evento.preventDefault();


    const body = new FormData(formularioModal)
    const url = '/soliciudes_e/API/busquedaslict/modificar';
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
                modalL.hide()
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

const traePdf = (e) => {    
    modalL.show()
    divPdf.style.display = 'none';
    divLicencias.style.display = 'block';
  

    const button = e.target;
    const ste_cat = button.dataset.ste_cat;
    const pdf_id = button.dataset.pdf_id;
    const pdf_solicitud = button.dataset.pdf_solicitud;


    const dataset = {

        ste_cat,
        pdf_id,
        pdf_solicitud
    };
 
    formularioModal.pdf_solicitud.value = dataset.pdf_solicitud;
    formularioModal.pdf_id.value = dataset.pdf_id;

};





const modificarPdf = async (evento) => {

    evento.preventDefault();


    const body = new FormData(formularioModal);
    body.append('ste_catalogo', ste_id)
    const url = '/soliciudes_e/API/busquedaslict/modificarPdf';
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
                formularioModal.reset();
                icon = 'success'
                modalL.hide()
                buscar();
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
    buscar()
}


const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea elminar este registro?')) {

        const body = new FormData()
        body.append('sol_id', id)
        const url = '/soliciudes_e/API/busquedasc/eliminar';

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
datatable.on('click', '.btn-warning', traeDatos)
datatable.on('click', '.btn-outline-warning', traePdf);
btnModficarDatos.addEventListener('click', modificar);
addPdf.addEventListener('click',modificarPdf);
datatable.on('click', '.btn-danger', eliminar)