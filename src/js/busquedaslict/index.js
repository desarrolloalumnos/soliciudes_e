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
const addPdf = document.getElementById('addPdf');

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
            data: 'gra_desc_lg'
        },
        {
            title: 'Nombres',
            className: 'text-center',
            data: 'nombre_solicitante'
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
            data: 'ste_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) =>
                `<div class="btn-group">
                        <button class="btn btn-warning" 
                        data-id="${data}">
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

    const catalogo = formulario.ste_catalogo.value
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
const buscarModal = async (e) => {
    const boton = e.target
    let ids = boton.dataset.id
    let id = ids
    const url = `/soliciudes_e/API/busquedaslict/buscarModal?id=${id}`;
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
            modalL.show();
            const dato = data[0];
            divPdf.style.display = 'block';           
            formularioModal.lit_id.value = dato.lit_id;
            formularioModal.sol_id.value = dato.sol_id;
            formularioModal.ste_id.value = dato.ste_id;
            formularioModal.ste_cat.value = dato.ste_cat;
            formularioModal.ste_telefono.value = dato.ste_telefono;
            formularioModal.sol_obs.value = dato.sol_obs;
            formularioModal.sol_motivo.value = dato.sol_motivo;
            formularioModal.nombre.value = dato.nombres_solicitante;
            formularioModal.tiempo.value = dato.tiempo;
            const numero = dato.tiempo;
            formatoTiempo(numero).then((tiempoFormateado) => {
                formularioModal.tiempo_servicio.value = tiempoFormateado;
                formularioModal.tiempo_servicio.disabled = true;
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
            formularioModal.lit_mes_consueldo.value = dato.lit_mes_consueldo;
            formularioModal.lit_mes_sinsueldo.value = dato.lit_mes_sinsueldo;
            divLicencias.style.display = 'none';
            let fecha1SinFormato = dato.lit_fecha1
            let fecha1ConFormato = formatearFecha(fecha1SinFormato)
            formularioModal.lit_fecha1.value = fecha1ConFormato;
            let fecha2SinFormato = dato.lit_fecha2
            let fecha2ConFormato = formatearFecha(fecha2SinFormato)
            formularioModal.lit_fecha2.value = fecha2ConFormato;
            let pdf = btoa(btoa(btoa(dato.pdf_ruta)));
            let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`;
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

    let fecha_inicio = formularioModal.lit_fecha1.value
    let fecha_fin= formularioModal.lit_fecha2.value

    if (fecha_fin < fecha_inicio){
        let icon = 'info'
        Toast.fire({
            icon,
            text: 'La fecha de finalizacion no puede ser menor a la fecha de inicio',
        });
        return;
    }


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
    const fileInput = document.getElementById('pdf_ruta');
    const file = fileInput.files[0];

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
const corregir = async (e) => {
    const button = e.target;
    const id = button.dataset.sol_id;

    if (await confirmacion('warning', 'Desea corregir este registro?')) {

        const body = new FormData()
        body.append('sol_id', id)
        const url = '/soliciudes_e/API/busquedasc/corregir';

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
datatable.on('click', '.btn-warning', buscarModal)
datatable.on('click', '.btn-outline-warning', traePdf);
btnModficarDatos.addEventListener('click', modificar);
addPdf.addEventListener('click', modificarPdf);
datatable.on('click', '.btn-danger', eliminar)
datatable.on('click','.btn-success',corregir)