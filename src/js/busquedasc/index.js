import { Dropdown, Modal } from "bootstrap";
import Swal from "sweetalert2";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatearFecha } from "../funciones";

const modalM = new Modal(document.getElementById('modalM'), {
    backdrop: 'static',
    keyboard: false
});
const modalPdf = new Modal(document.getElementById('modalPdf'), {
    backdrop: 'static',
    keyboard: false
});
const formulario = document.getElementById('formularioMatrimonio');
const formulario2 = document.getElementById('formularioCasamiento');
const pdf = document.getElementById('formularioPdf');
const ste_cat2 = document.getElementById('ste_cat2');
const idPareja = document.getElementById('parejac_id')
const iframe = document.getElementById('pdfIframe');
const btnModificar = document.getElementById('btnModificar');
const btnBuscar = document.getElementById('btnBuscar');
const addPdf = document.getElementById('addPdf');
const parejam_cat = document.getElementById('parejam_cat');
const divMilitar = document.getElementById('parejaMilitar');
const divCivil = document.getElementById('parejaCivil');
const formularioModal = document.getElementById('formularioPdf');

divMilitar.style.display = 'none';
divCivil.style.display = 'none';
formulario2.ste_cat.disabled = true;
formulario2.ste_fecha.disabled = true;
formulario2.nombre.disabled = true;
let contador = 1;
const datatable = new Datatable('#tablaMatrimonios', {
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
            className: 'gra_desc_lg',
            data: 'gra_desc_lg'
        },
        {
            title: 'Nombres',
            className: 'text-center',
            data: 'nombre_solicitante'
        },
        {
            title: 'Pareja Civil',
            className: 'text-center',
            data: 'pareja_civil',
            visible: false
        },
        {
            title: 'Grado Pareja',
            className: 'text-center',
            data: 'grado_pareja',
            visible: false
        },
        {
            title: 'Nombres Pareja',
            className: 'text-center',
            data: 'nombres_pareja',
            visible: false
        },
        {
            title: 'Nombres de la Pareja',
            render: function (data, type, row) {
                return row.grado_pareja + ' ' + row.nombres_pareja + row.pareja_civil;
            }
        },

        {
            title: 'Inicio de Licencia',
            className: 'text-center',
            data: function (row) {
                return row.mat_fecha_lic_ini.substring(0, 10);
            }
        },
        {
            title: 'Fin de Licencia',
            className: 'text-center',
            data: function (row) {
                return row.mat_fecha_lic_fin.substring(0, 10);
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
            title: 'MODIFICAR ',
            className: 'text-center',
            data: 'ste_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) =>
                `<div class="btn-group">
                <button class="btn btn-warning" data-id='${data}'>
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

    const url = `/soliciudes_e/API/busquedasc/buscar?catalogo=${catalogo}&fecha=${fecha}`;


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

const buscarModal = async (e) => {

    const boton = e.target
    let ids = boton.dataset.id

    let id = ids
    const url = `/soliciudes_e/API/busquedasc/buscarModal?id=${id}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        if (data) {
            Toast.fire({
                title: 'Abriendo Solicitud',
                icon: 'info'

            })
            const dato = data[0];
         
            const mat_fecha_bodac = formatearFecha(dato.mat_fecha_bodac);
            const mat_fecha_bodar = formatearFecha(dato.mat_fecha_bodar);
            const mat_fecha_lic_ini = formatearFecha(dato.mat_fecha_lic_ini);
            const mat_fecha_lic_fin = formatearFecha(dato.mat_fecha_lic_fin);
            const ste_fecha = formatearFecha(dato.ste_fecha);
            const partes = dato.pareja_civil.split(' ');                     
            const maxNombres = 2;
            const maxApellidos = 2;
            const nombres = partes.slice(0, maxNombres).join(' ');
            const apellidos = partes.slice(maxNombres, maxNombres + maxApellidos).join(' ');
            formulario2.parejac_nombres.value = nombres;
            formulario2.parejac_apellidos.value = apellidos;        
            formulario2.ste_id.value = dato.ste_id;
            formulario2.ste_cat.value = dato.ste_cat;
            formulario2.nombre.value = dato.nombres_solicitante;
            formulario2.ste_fecha.value = ste_fecha;
            formulario2.ste_telefono.value = dato.ste_telefono;
            formulario2.mat_id.value = dato.mat_id;
            formulario2.mat_lugar_civil.value = dato.mat_lugar_civil;
            formulario2.mat_fecha_bodac.value = mat_fecha_bodac;
            formulario2.mat_lugar_religioso.value = dato.mat_lugar_religioso;
            formulario2.mat_fecha_bodar.value = mat_fecha_bodar;
            formulario2.mat_per_civil.value = dato.mat_per_civil;
            idPareja.value = dato.parejac_id;
            formulario2.parejac_direccion.value = dato.parejac_direccion;
            formulario2.parejac_dpi.value = dato.parejac_dpi;
            formulario2.mat_per_army.value = dato.mat_per_army;
            formulario2.parejam_id.value = dato.parejam_id;
            parejam_cat.value = dato.parejam_cat;
            formulario2.parejaNombre.value = dato.nombres_pareja;
            formulario2.mat_fecha_lic_ini.value = mat_fecha_lic_ini;
            formulario2.mat_fecha_lic_fin.value = mat_fecha_lic_fin;
        
            if (parejam_cat.value === "") {
                divMilitar.style.display = 'none';
                divCivil.style.display = 'block';
            } else {
                divMilitar.style.display = 'block';
                divCivil.style.display = 'none';
                parejam_cat.addEventListener('change', buscarCatalogo)
        
            }
        
        
            let pdf = btoa(btoa(btoa(dato.pdf_ruta)));
            let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`;
        
            iframe.src = ver

           modalM.show()


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


const traePdf = (e) => {

    modalPdf.show()
    const button = e.target;
    const ste_cat = button.dataset.ste_cat;
    const pdf_id = button.dataset.pdf_id;
    const pdf_solicitud = button.dataset.pdf_solicitud;


    const dataset = {

        ste_cat,
        pdf_id,
        pdf_solicitud
    };
    colocarPdf(dataset)

};

const colocarPdf = (dataset) => {
    ste_cat2.value = dataset.ste_cat;
    pdf.pdf_solicitud.value = dataset.pdf_solicitud;
    pdf.pdf_id.value = dataset.pdf_id;


}



const modificar = async (evento) => {

    evento.preventDefault();
    let catalogo = formulario2.ste_cat.value
    let fecha = formulario2.ste_fecha.value


    const body = new FormData(formulario2)
    body.append('ste_cat', catalogo)
    body.append('ste_fecha', fecha)
    const url = '/soliciudes_e/API/busquedasc/modificar';
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
                modalM.hide()
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

const modificarPdf = async (evento) => {

    evento.preventDefault();


    const body = new FormData(pdf);
    body.append('ste_cat2', ste_id)
    const url = '/soliciudes_e/API/busquedasc/modificarPdf';
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
                modalPdf.hide()
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


const buscarCatalogo = async () => {

    let catalogo = parejam_cat.value;
    const url = `/soliciudes_e/API/licencias/buscarCatalogo?per_catalogo=${catalogo}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        if (data.length > 0) {
            const dato = data[0]
            formulario2.parejam_arm.value = dato.per_arma;          
            formulario2.parejam_gra.value = dato.per_grado;
            formulario2.parejam_emp.value = dato.org_plaza_desc
            formulario2.parejam_comando.value = dato.dep_llave
            formulario2.parejam_cat.value = dato.per_catalogo
            formulario2.parejaNombre.value = dato.nombres;


            Toast.fire({
                title: 'Catálogo válido',
                icon: 'success'
            });
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
            return;
        }

        return data;
    } catch (error) {
        console.log(error);
    }


}


const verPDF = (e) => {

    const boton = e.target
    let ruta = boton.dataset.ruta

    let pdf = btoa(btoa(btoa(ruta)))

    window.open(`/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`)

}
buscar();

btnBuscar.addEventListener('click', buscar);
btnModificar.addEventListener('click', modificar)
datatable.on('click', '.btn-warning', buscarModal);
datatable.on('click', '.btn-outline-warning', traePdf);
addPdf.addEventListener('click', modificarPdf)
datatable.on('click', '.btn-outline-info', verPDF);
datatable.on('click', '.btn-danger', eliminar);
