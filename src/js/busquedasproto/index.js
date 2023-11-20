import Swal from "sweetalert2";
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion,formatearFecha } from "../funciones";

const modalProtocolo = new Modal(document.getElementById('modalProtocolo'), {
    backdrop: 'static',
    keyboard: false
});


const formulario = document.getElementById('formularioProtocolo');
const formulario2 = document.getElementById('formularioProto');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('modificar');
const btnCancelar = document.getElementById('btnCancelar');
const calendarEl = document.getElementById('calendar');
const verTabla = document.getElementById('dataTabla')
const verCalendario = document.getElementById('calendario')
const btnCalendario = document.getElementById('btnCalendario')
const iframe = document.getElementById('pdfSalida');
const divPdf = document.getElementById('pdf');
const divProtocolo = document.getElementById('Protocolo');



verCalendario.style.display = 'none'
verTabla.style.display = 'none'
formulario2.ste_cat2.disabled = true;
formulario2.ste_fecha2.disabled = true;
formulario2.nombre.disabled = true;





const buscarCalender = async () => {
    verCalendario.style.display = 'block';
    verTabla.style.display = 'none';
    // let dep_valor = dependencias.value 
    // let tipo = tipos.value 

    const url = `/soliciudes_e/API/busquedasproto/buscarCalender`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        
        
        if (data) {

        const calendar = new Calendar(calendarEl, {

            plugins: [dayGridPlugin],
            initialView: 'dayGridMonth',
            height: 'auto',
            headerToolbar: {
                start: 'dayGridMonth,dayGridWeek,listWeek',
                center: 'title',
                end: 'today,prev,next',
            },
            events: data,
            dayMaxEvents: 5,
            locale: 'es',
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                list: 'Lista',
            }
        });

        calendar.render();

        // return

            
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



let contador = 1;
const datatable = new Datatable('#tablaProtocolo', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            className: 'text-center',
            render: () => contador++
        },
        {
            title: 'GRADO',
            className: 'text-center',
            data: 'gra_desc_lg'
        },
        {
            title: 'NOMBRE',
            className: 'text-center',
            data: 'nombre'
        },
        {
            title: 'COMBO, VALLA, MARIMBA, BANDA',
            className: 'text-center',
            data: 'cmv_tip'
        },
        {
            title: 'DEPENDECIA',
            className: 'text-center',
            data: 'dep_desc_lg'
        },
        {
            title: 'FECHA INICIO ACTIVIDAD',
            className: 'text-center',
            data: function (row) {
                return row.pco_fechainicio.substring(0, 10);
            }
        },
        {
            title: 'FECHA FIN ACTIVIDAD',
            className: 'text-center',
            data: function (row) {
                return row.pco_fechafin.substring(0, 10);
            }
        },
        {
            title: 'DIRECCION',
            className: 'text-center',
            data: 'pco_dir'
        },
        {
            title: 'PDF',
            data: 'pdf_ruta',
            render: function (data) {
                return `<button  class="btn btn-outline-info" data-ruta="${data.substr(10)}"><i class="bi bi-eye"></i>Ver PDF</button>`;
            },
            width: '150px'
        },
        {
            title: 'MODIFICAR',
            className: 'text-center',
            data: 'ste_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `
            <div class="btn-group">
            <button class="btn btn-warning" data-id='${data}'>DATOS</button>
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
    verCalendario.style.display = 'none';
    verTabla.style.display = 'block';
    const catalogo = formulario.ste_cat.value
    const fecha = formulario.ste_fecha.value
console.log(catalogo,fecha);
    const url = `/soliciudes_e/API/busquedasproto/buscar?catalogo=${catalogo}&fecha=${fecha}`;
    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        datatable.clear().draw()

        if (data) {
            contador = 1;
            datatable.rows.add(data).draw();
            data.forEach((evento) => {
                Calendar.addEvent({
                    title: evento.titulo,
                    start: evento.pco_fechainicio,
                    end: evento.pco_fechafin,
                });
            });

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


const buscarModal = async (e) => {
    modalProtocolo.show();
    divPdf.style.display = 'none';
    divProtocolo.style.display = 'block';
    const boton = e.target
    let ids = boton.dataset.id
    let id = ids

    const url = `/soliciudes_e/API/busquedasproto/buscarModal?id=${id}`;
    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();


        if (data) {
            const dato = data[0]
            let fechaSinFormato = dato.ste_fecha
            let fechaSolicitud = formatearFecha(fechaSinFormato)

            let fecha2SinFormato = dato.pco_fechainicio
            let fechaInicio = formatearFecha(fecha2SinFormato)

            let fecha3SinFormato = dato.pco_fechafin
            let fechaFin = formatearFecha(fecha3SinFormato)

            
            formulario2.ste_id.value = dato.ste_id
            formulario2.ste_cat2.value = dato.ste_cat
            formulario2.nombre.value = dato.nombre
            formulario2.ste_fecha2.value = fechaSolicitud
            formulario2.ste_telefono.value = dato.ste_telefono
            formulario2.sol_motivo.value = dato.sol_motivo
            formulario2.sol_obs2.value = dato.sol_obs            
            formulario2.pco_autorizacion.value = dato.pco_autorizacion
            formulario2.pco_id.value = dato.pco_id
            formulario2.pco_cmbv.value = dato.cmv_id
            formulario2.pco_just.value = dato.pco_just
            formulario2.pco_fechainicio.value = fechaInicio
            formulario2.pco_fechafin.value = fechaFin
            formulario2.pco_dir.value = dato.pco_dir

            let pdfSinCorregir = dato.pdf_ruta;
            let pdfCorregido = pdfSinCorregir.substring(10);
            
            let verDoc = btoa(btoa(btoa(pdfCorregido)));
            let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${verDoc}`
            iframe.src = ver


            Toast.fire({
                title: 'Abriendo solicitud',
                icon: 'success'
            });

        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
        }
    } catch (error) {
        console.log(error);
    }
    formulario.reset();
}


const modificar = async (evento) => {

    evento.preventDefault();
    let catalogo = formulario2.ste_cat2.value
    let fecha = formulario2.ste_fecha2.value

    const body = new FormData(formulario2)
    body.append('ste_cat', catalogo)
    body.append('ste_fecha', fecha)
    const url = '/soliciudes_e/API/busquedasproto/modificar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    for (var pair of body.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        // console.log(data)
        // return

        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
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
}

const traePdf = (e) => {    
    modalProtocolo.show()
    divPdf.style.display = 'block';
    divProtocolo.style.display = 'none';
  

    const button = e.target;
    const ste_cat = button.dataset.ste_cat;
    const pdf_id = button.dataset.pdf_id;
    const pdf_solicitud = button.dataset.pdf_solicitud;


    const dataset = {

        ste_cat,
        pdf_id,
        pdf_solicitud
    };
 
    formulario2.pdf_solicitud.value = dataset.pdf_solicitud;
    formulario2.pdf_id.value = dataset.pdf_id;

};




const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea elminar este registro?')) {
        const body = new FormData()
        body.append('sol_id', id)

        // console.log(object);
        const url = '/soliciudes_e/API/busquedasproto/eliminar';
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


buscar();
const verPDF = (e) => {
    // const button = e.target;
    const boton = e.target
    let ruta = boton.dataset.ruta

    let pdf = btoa(btoa(btoa(ruta)))

    window.open(`/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`)

}

btnBuscar.addEventListener('click', buscar);
btnModificar.addEventListener('click', modificar)
addPdf.addEventListener('click',modificarPdf);
btnCancelar.addEventListener('click', limpiarModelProtocolo)
datatable.on('click', '.btn-warning', buscarModal);
datatable.on('click', '.btn-outline-info', verPDF);
datatable.on('click', '.btn-danger', eliminar);
btnCalendario.addEventListener('click', buscarCalender)
datatable.on('click', '.btn-outline-warning', traePdf);
