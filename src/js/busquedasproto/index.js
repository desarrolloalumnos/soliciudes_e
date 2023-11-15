import Swal from "sweetalert2";
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";


const modalProtocolo = new Modal(document.getElementById('modalProtocolo'), {})
const formulario = document.getElementById('formularioProtocolo');
const formulario2 = document.getElementById('formularioProto');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');
const calendarEl = document.getElementById('calendar');

formulario2.ste_cat.disabled = true;
formulario2.ste_fecha.disabled = true;
formulario2.nombre.disabled = true;


const buscarCalender = async () => {

    // let dep_valor = dependencias.value 
    // let tipo = tipos.value 

    const url = `/soliciudes_e/API/busquedasproto/buscarCalender`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        
        
   
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
        
return

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


// document.addEventListener('DOMContentLoaded', function() {
   
//     const calendar = new Calendar(calendarEl, {
//         plugins: [dayGridPlugin], 
//         initialView: 'dayGridMonth',
//         height: 'auto',
//         headerToolbar: {
//           start: 'dayGridMonth,dayGridWeek,listWeek',
//           center: 'title',
//           end: 'today,prev,next',
//         },
//         events: [
//           {
//             title: 'Evento 1',
//             start: '2023-11-09T10:00:00',
//             end: '2023-11-09T12:00:00',
//           },
//           {
//             title: 'Evento 2',
//             start: '2023-11-11T14:00:00',
//             end: '2023-11-11T16:00:00',
//           },
          
//         ],
//         dayMaxEvents: 5,
//         locale: 'es',
//         buttonText: {
//           today: 'Hoy',
//           month: 'Mes',
//           week: 'Semana',
//           list: 'Lista',
//         }
//       });
    
//       calendar.render();
    
//   });




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
            title: 'Combo, banda, marimba o valla',
            className: 'text-center',
            data: 'cmv_tip'
        },
        {
            title: 'Fecha inicio actividad',
            className: 'text-center',
            data: function (row) {
                return row.pco_fechainicio.substring(0, 10);
            }
        },
        {
            title: 'Fecha fin actividad',
            className: 'text-center',
            data: function (row) {
                return row.pco_fechafin.substring(0, 10);
            } 
        },
        {
            title: 'Dirección',
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
            data: 'pco_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" 
                    data-id='${data}' 
                    data-ste_id='${row["ste_id"]}' 
                    data-ste_cat='${row["ste_cat"]}' 
                    data-pco_cmbv='${row["pco_cmbv"]}'  
                    data-pco_just='${row["pco_just"]}' 
                    data-pco_fechainicio='${row["pco_fechainicio"]}' 
                    data-pco_fechafin='${row["pco_fechafin"]}' 
                    data-pco_dir='${row["pco_dir"]}' 
                    data-pdf_id='${row["pdf_id"]}' 
                    data-pdf_solicitud='${row["pdf_solicitud"]}'  
                    data-nombre='${row["nombre"]}' 
                    data-cmv_tip='${row["cmv_tip"]}' 
                    data-pdf_ruta='${row["pdf_ruta"]}'>DATOS</button>
                    <button class="btn btn-outline-warning" data-pdf_id='${row["pdf_id"]}' data-ste_cat='${row["ste_cat"]}'data-pdf_solicitud='${row["pdf_solicitud"]}' data-pdf_ruta='${row["pdf_ruta"]}'>PDF</button>
                    </div>`
                },
            {
            title: 'ELIMINAR',
            className: 'text-center',
            data: 'pco_id',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
            },
    ],
});

const buscar = async () => {
    const url = `/soliciudes_e/API/busquedasproto/buscar`;
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


const traeDatos = (e) => {

        modalProtocolo.show()
        const button = e.target;
        console.log(button.dataset.nombre);
        const pco_id = button.dataset.id
        const pco_autorizacion = button.dataset.pco_autorizacion
        const aut_id = button.dataset.aut_id
        const aut_solicitud = button.dataset.aut_solicitud
        const sol_id = button.dataset.sol_id
        const sol_tipo = button.dataset.sol_tipo
        const tse_id = button.dataset.tse_id
        const sol_solicitante = button.dataset.sol_solicitante
        const ste_id = button.dataset.ste_id
        const ste_comando = button.dataset.ste_comando
        const ste_cat = button.dataset.ste_cat
        const ste_gra = button.dataset.ste_gra
        const ste_arm = button.dataset.ste_arm
        const ste_emp = button.dataset.ste_emp
        const ste_fecha = button.dataset.ste_fecha
        const sol_obs = button.dataset.sol_obs
        const sol_motivo = button.dataset.sol_motivo
        const mot_id = button.dataset.mot_id
        const sol_situacion = button.dataset.sol_situacion
        const aut_comando = button.dataset.aut_comando
        const aut_cat = button.dataset.aut_cat
        const aut_gra = button.dataset.aut_gra
        const aut_arm = button.dataset.aut_arm
        const aut_emp = button.dataset.aut_emp
        const aut_fecha = button.dataset.aut_fecha
        const pco_fechainicio = button.dataset.pco_fechainicio
        const pco_fechafin = button.dataset.pco_fechafin
        const pco_dir = button.dataset.pco_dir
        const pco_just = button.dataset.pco_just
        const cmv_tip = button.dataset.cmv_tip
        const pdf_id = button.dataset.pdf_id
        const pdf_solicitud = button.dataset.pdf_solicitud
        const grado = button.dataset.grado
        const nombre = button.dataset.nombre
        const ste_telefono = button.dataset.ste_telefono
        const pdf_ruta = button.dataset.pdf_ruta

    const dataset = {

        pco_id,
        pco_autorizacion,
        aut_id,
        aut_solicitud,
        sol_id,
        sol_tipo,
        tse_id,
        sol_solicitante,
        ste_id,
        ste_comando,
        ste_cat,
        ste_gra,
        ste_arm,
        ste_emp,
        ste_fecha,
        sol_obs,
        sol_motivo,
        mot_id,
        sol_situacion,
        aut_comando,
        aut_cat,
        aut_gra,
        aut_arm,
        aut_emp,
        aut_fecha,
        pco_fechainicio,
        pco_fechafin,
        pco_dir,
        pco_just,
        cmv_tip,
        pdf_id,
        pdf_solicitud,
        nombre,
        grado,
        ste_telefono,
        pdf_ruta

    };
    colocarDatos(dataset);

};
 

const colocarDatos = (dataset) => {
    // const pco_fechainicio = formatearFecha(dataset.pco_fechainicio);
    // const pco_fechafin = formatearFecha(dataset.pco_fechafin);
   
    // const ste_fecha = formatearFecha(dataset.ste_fecha);

   console.log(dataset.pco_cmbv);
    formulario2.ste_id.value = dataset.ste_id;
    formulario2.ste_cat.value = dataset.ste_cat;
    formulario2.sol_id.value = dataset.sol_id;
    formulario2.ste_telefono.value = dataset.ste_telefono;
    formulario2.pco_id.value = dataset.pco_id;
    formulario2.pco_cmbv.value = dataset.pco_cmbv;
    // formulario2.pco_just.value = pco_just;
    formulario2.pco_dir.value = dataset.pco_dir;
    formulario2.pco_fechainicio.value = pco_fechainicio;
    formulario2.pco_fechafin.value = dataset.pco_fechafin;
    formulario2.ste_gra.value = dataset.grado;
    formulario2.nombre.value = dataset.nombre;

}


const limpiarModelProtocolo = async () => {
    modalProtocolo.hide()
}


const modificar = async (evento) => {

    evento.preventDefault();
    let catalogo = formulario2.ste_cat.value
    let fecha = formulario2.ste_fecha.value

    const body = new FormData(formulario2)
    body.append('ste_cat', catalogo)
    body.append('ste_fecha', fecha)
    const url = '/soliciudes_e/API/busquedasproto/modificar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");
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
                // cancelarAccion();
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
        body.append('sol_id', id)
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

    // buscar();
}


const verPDF = (e) => {
    // const button = e.target;
    const boton = e.target
    let ruta = boton.dataset.ruta

    let pdf = btoa(btoa(btoa(ruta)))

    window.open(`/soliciudes_e/API/busquedasproto/pdf?ruta=${pdf}`)

}
buscar();

btnBuscar.addEventListener('click', buscar);
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', limpiarModelProtocolo)
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-outline-info', verPDF);
datatable.on('click', '.btn-danger', eliminar);


buscarCalender()