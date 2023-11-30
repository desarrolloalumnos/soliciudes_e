import Swal from "sweetalert2";
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion,formatearFecha } from "../funciones";
import { data } from "jquery";


const modalProtocolo = new Modal(document.getElementById('modalProtocolo'), {
    backdrop: 'static',
    keyboard: false
});


const formulario = document.getElementById('formularioProtocolo');
const formulario2 = document.getElementById('formularioProto');
const formularioEvento = document.getElementById('formularioEvento');
const btnGuardar = document.getElementById('btnGuardar');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificarDatos = document.getElementById('modificar');
const calendarEl = document.getElementById('calendar');
const verTabla = document.getElementById('dataTabla');
const verCalendario = document.getElementById('calendario');
const btnCalendario = document.getElementById('btnCalendario');
const iframe = document.getElementById('pdfSalida');
const iframe2 = document.getElementById('pdfSalidaEvento')
const divPdf = document.getElementById('pdf');
const divProtocolo = document.getElementById('Protocolo');
const addPdf = document.getElementById('addPdf')
const fileInputs = document.querySelectorAll('input[style="file"]');

verCalendario.style.display = 'none'
verTabla.style.display = 'none'
formulario2.ste_cat2.disabled = true;
formulario2.ste_fecha2.disabled = true;
formulario2.nombre.disabled = true;

const abrirModalEvento = (evento) => {
    const id_solicitud = evento.extendedProps.sol_id;
    console.log(id_solicitud);
    buscarEvento(id_solicitud)
    $('#eventoModal').modal('show');
};

const guardarEvento = async () => {
    const formData = new FormData(formularioEvento);

    try {
        const response = await fetch('/soliciudes_e/API/busquedasproto/guardarEvento', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            // Éxito, puedes mostrar una notificación de éxito o cerrar el modal, etc.
            Toast.fire({
                title: 'Evento guardado con éxito',
                icon: 'success',
            });

            // Cerrar el modal
            $('#eventoModal').modal('hide');
        } else {
            // Error, puedes mostrar una notificación de error o realizar otras acciones según la respuesta
            Toast.fire({
                title: 'Error al guardar el evento',
                icon: 'error',
            });
        }
    } catch (error) {
        console.error('Error al procesar la solicitud:', error);
    }
};


const buscarCalender = async () => {
    verCalendario.style.display = 'block';
    verTabla.style.display = 'none';

    const url = `/soliciudes_e/API/busquedasproto/buscarCalender`;

    const config = {
        method: 'GET',
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        if (data) {
            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin],
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    start: 'dayGridMonth,dayGridWeek,listWeek',
                    center: 'title',
                    end: 'today,prev,next',
                    lugar: 'Ubicación del evento',
                    id: 'sol_id'
                },
                events: data,
                dayMaxEvents: 5,
                locale: 'es',
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    list: 'Lista',
                },
                eventClick: function (info) {
                    abrirModalEvento(info.event);
                }
            });

            calendar.render();
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
};


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
            title: 'NOMBRES',
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


    console.log(catalogo, fecha);
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
                    lugar: evento.pco_dir,
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


const buscarEvento = async (id_solicitud) => {
    console.log(id_solicitud);
   
    const url = `/soliciudes_e/API/busquedasproto/buscarEventos?id=${id_solicitud}`;
    const config = {
        method: 'GET',
    }

    // try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        if (data) {
            Toast.fire({
                title: 'Abriendo Solicitud',
                icon: 'success'
            })
           

            formularioEvento.ste_id.value = data[0].ste_id
            formularioEvento.ste_cat.value = data[0].ste_cat
            formularioEvento.nombre.value = data[0].nombre
            formularioEvento.ste_fecha.value = data[0].ste_fecha
            formularioEvento.ste_telefono.value = data[0].ste_telefono
            formularioEvento.sol_motivo.value = data[0].sol_motivo
            formularioEvento.sol_obs.value = data[0].sol_obs
            formularioEvento.pco_autorizacion.value = data[0].pco_autorizacion
            formularioEvento.pco_id.value = data[0].pco_id
            formularioEvento.pco_cmbv.value = data[0].cmv_id
            formularioEvento.pco_just.value = data[0].pco_just
            formularioEvento.pco_fechainicio.value = data[0].pco_fechainicio
            formularioEvento.pco_fechafin.value = data[0].pco_fechafin
            formularioEvento.pco_dir.value = data[0].pco_dir
            let pdfSinCorregir = data[0].pdf_ruta;
            let pdfCorregido = pdfSinCorregir.substring(10);
            
            let verDoc = btoa(btoa(btoa(pdfCorregido)));
            let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${verDoc}`
            iframe2.src = ver



        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'

            })
        }

    // } catch (error) {
    //     console.log(error);
    // }

}





const buscarModal = async (e) => {
    const boton = e.target;
    let ids = boton.dataset.id;
    let id = ids;
    const url = `/soliciudes_e/API/busquedasproto/buscarModal?id=${id}`;
    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        if (data) {
            Toast.fire({
                title: 'Abriendo Solicitud',
                icon: 'success'   
            })

            modalProtocolo.show();
            const dato = data[0]
            divPdf.style.display = 'none';
            divProtocolo.style.display = 'block';

     
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
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'

            })
        }

    } catch (error) {
        console.log(error);
    }

}

const modificar = async (evento) => {

    evento.preventDefault();

    let fecha_inicio = formulario2.pco_fechainicio.value
    let fecha_fin= formulario2.pco_fechafin.value

    if (fecha_fin < fecha_inicio){
        let icon = 'info'
        Toast.fire({
            icon,
            text: 'La fecha de finalizacion no puede ser menor a la fecha de inicio',
        });
        return;
    }
    
    const body = new FormData(formulario2)
   
    const url = '/soliciudes_e/API/busquedasproto/modificar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    // for (var pair of body.entries()) {
    //     console.log(pair[0]+ ', ' + pair[1]); 
    // }
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

const modificarPdf = async (evento) => {

    evento.preventDefault();

    if (!file) {
        Toast.fire({
            icon: 'info',
            text: 'Por favor, selecciona un archivo PDF.'
        })
        return;
    }

    const allowedExtensions = /(\.pdf)$/i;

    if (!allowedExtensions.test(file.name)) {
        Toast.fire({
            icon: 'info',
            text: 'Por favor, selecciona un archivo PDF válido.'
        })
        fileInput.value = ''; 
        return;
    }

    const body = new FormData(formulario2);
    body.append('ste_catalogo', ste_id)
    const url = '/soliciudes_e/API/busquedasproto/modificarPdf';
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
                formulario2.reset();
                icon = 'success'
                modalProtocolo.hide()
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

const verPDF = (e) => {
    // const button = e.target;
    const boton = e.target
    let ruta = boton.dataset.ruta

    let pdf = btoa(btoa(btoa(ruta)))

    window.open(`/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`)

}
buscar();

btnBuscar.addEventListener('click', buscar);
btnModificarDatos.addEventListener('click', modificar);
datatable.on('click', '.btn-outline-info', verPDF);
datatable.on('click', '.btn-warning', buscarModal);
datatable.on('click', '.btn-outline-warning', traePdf);
addPdf.addEventListener('click',modificarPdf);
datatable.on('click', '.btn-danger', eliminar);
btnCalendario.addEventListener('click', buscarCalender);
