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
            title: 'ste_fecha',
            className: 'text-center',
            data: 'ste_fecha'
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
            title: 'mat_lugar_civil',
            className: 'text-center',
            data: 'mat_lugar_civil'
        },
        {
            title: 'mat_fecha_bodac',
            className: 'text-center',
            data: 'mat_fecha_bodac'
        },
        {
            title: 'mat_lugar_religioso',
            className: 'text-center',
            data: 'mat_lugar_religioso'
        },
        {
            title: 'mat_fecha_bodar',
            className: 'text-center',
            data: 'mat_fecha_bodar'
        },

        {
            title: 'parejac_id',
            className: 'text-center',
            data: 'parejac_id'
        },
        {
            title: 'parejac_direccion',
            className: 'text-center',
            data: 'parejac_direccion'
        },
        {
            title: 'parejac_dpi',
            className: 'text-center',
            data: 'parejac_dpi'
        },

        {
            title: 'parejam_id',
            className: 'text-center',
            data: 'parejam_id'
        },
        {
            title: 'parejam_cat',
            className: 'text-center',
            data: 'parejam_cat'
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
            title: 'Pareja Civil',
            className: 'text-center',
            data: 'nombres',
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
                return row.grado_pareja + ' ' + row.nombres_pareja + row.nombres;
            }
        },

        {
            title: 'Fin de Licencia',
            className: 'text-center',
            data: function (row) {
                return row.mat_fecha_lic_ini.substring(0, 10);
            }
        },
        {
            title: 'Inicio de Licencia',
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
            data: 'mat_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) =>
                `<div class="btn-group">
                <button class="btn btn-warning" data-id='${data}' data-pdf_id='${row["pdf_id"]}' data-pdf_solicitud='${row["pdf_solicitud"]}' data-pdf_ruta='${row["pdf_ruta"]}' data-ste_id='${row["ste_id"]}' data-ste_cat='${row["ste_cat"]}' data-mat_lugar_civil='${row["mat_lugar_civil"]}'
                    data-mat_fecha_bodac='${row["mat_fecha_bodac"]}' data-mat_lugar_religioso='${row["mat_lugar_religioso"]}' data-mat_fecha_bodar='${row["mat_fecha_bodar"]}' 
                    data-parejac_id='${row["parejac_id"]}' data-parejac_direccion='${row["parejac_direccion"]}' data-parejac_dpi='${row["parejac_dpi"]}' data-parejam_id='${row["parejam_id"]}' 
                    data-parejam_cat='${row["parejam_cat"]}' data-grado_solicitante='${row["grado_solicitante"]}' data-nombres_solicitante='${row["nombres_solicitante"]}' data-nombres='${row["nombres"]}'
                    data-grado_pareja='${row["grado_pareja"]}' data-nombres_pareja='${row["nombres_pareja"]}' data-mat_fecha_lic_ini='${row["mat_fecha_lic_ini"]}' 
                    data-mat_fecha_lic_fin='${row["mat_fecha_lic_fin"]}' data-ste_telefono='${row["ste_telefono"]}' data-pdf_ruta='${row["pdf_ruta"]}' data-ste_fecha='${row["ste_fecha"]}'>
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
    columnDefs: [
        {
            targets: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            visible: false,
            searchable: false,
        }
    ]
});

const buscar = async () => {

    // let dep_valor = dependencias.value 
    // let tipo = tipos.value 

    const url = `/soliciudes_e/API/busquedasc/buscar`;


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

const traeDatos = (e) => {

    modalM.show()
    const button = e.target;
    const mat_id = button.dataset.id
    const ste_id = button.dataset.ste_id;
    const ste_cat = button.dataset.ste_cat;
    // const sol_id = button.dataset.sol_id;
    const mat_lugar_civil = button.dataset.mat_lugar_civil;
    const mat_fecha_bodac = button.dataset.mat_fecha_bodac;
    const mat_lugar_religioso = button.dataset.mat_lugar_religioso;
    const mat_fecha_bodar = button.dataset.mat_fecha_bodar;
    const mat_per_civil = button.dataset.mat_per_civil;
    const parejac_id = button.dataset.parejac_id;
    const parejac_direccion = button.dataset.parejac_direccion;
    const parejac_dpi = button.dataset.parejac_dpi;
    const mat_per_army = button.dataset.mat_per_army;
    const parejam_id = button.dataset.parejam_id;
    const parejam_cat = button.dataset.parejam_cat;
    const grado_solicitante = button.dataset.grado_solicitante;
    const nombres_solicitante = button.dataset.nombres_solicitante;
    const nombres = button.dataset.nombres;
    const grado_pareja = button.dataset.grado_pareja;
    const nombres_pareja = button.dataset.nombres_pareja;
    const mat_fecha_lic_ini = button.dataset.mat_fecha_lic_ini;
    const mat_fecha_lic_fin = button.dataset.mat_fecha_lic_fin;
    const ste_telefono = button.dataset.ste_telefono;
    const pdf_ruta = button.dataset.pdf_ruta;
    const ste_fecha = button.dataset.ste_fecha;

    const dataset = {

        ste_id,
        ste_cat,
        // sol_id,
        ste_telefono,
        ste_fecha,
        mat_id,
        mat_lugar_civil,
        mat_fecha_bodac,
        mat_lugar_religioso,
        mat_fecha_bodar,
        mat_per_civil,
        parejac_id,
        parejac_direccion,
        parejac_dpi,
        mat_per_army,
        parejam_id,
        parejam_cat,
        grado_solicitante,
        nombres_solicitante,
        nombres,
        mat_fecha_lic_ini,
        mat_fecha_lic_fin,
        pdf_ruta,
        // grado_pareja,
        nombres_pareja
    };
    colocarDatos(dataset)

};

const colocarDatos = (dataset) => {
    const mat_fecha_bodac = formatearFecha(dataset.mat_fecha_bodac);
    const mat_fecha_bodar = formatearFecha(dataset.mat_fecha_bodar);
    const mat_fecha_lic_ini = formatearFecha(dataset.mat_fecha_lic_ini);
    const mat_fecha_lic_fin = formatearFecha(dataset.mat_fecha_lic_fin);
    const ste_fecha = formatearFecha(dataset.ste_fecha);

    const partes = dataset.nombres.split(' ');
    const maxNombres = 2;
    const maxApellidos = 2;
    const nombres = partes.slice(0, maxNombres).join(' ');
    const apellidos = partes.slice(maxNombres, maxNombres + maxApellidos).join(' ');
    formulario2.parejac_nombres.value = nombres;
    formulario2.parejac_apellidos.value = apellidos;

    formulario2.ste_id.value = dataset.ste_id;
    formulario2.ste_cat.value = dataset.ste_cat;
    formulario2.nombre.value = dataset.nombres_solicitante;
    formulario2.ste_fecha.value = ste_fecha;
    formulario2.ste_telefono.value = dataset.ste_telefono;
    formulario2.mat_id.value = dataset.mat_id;
    formulario2.mat_lugar_civil.value = dataset.mat_lugar_civil;
    formulario2.mat_fecha_bodac.value = mat_fecha_bodac;
    formulario2.mat_lugar_religioso.value = dataset.mat_lugar_religioso;
    formulario2.mat_fecha_bodar.value = mat_fecha_bodar;
    formulario2.mat_per_civil.value = dataset.mat_per_civil;
    idPareja.value = dataset.parejac_id;
    formulario2.parejac_direccion.value = dataset.parejac_direccion;
    formulario2.parejac_dpi.value = dataset.parejac_dpi;
    formulario2.mat_per_army.value = dataset.mat_per_army;
    formulario2.parejam_id.value = dataset.parejam_id;
    parejam_cat.value = dataset.parejam_cat;
    formulario2.parejaNombre.value = dataset.nombres_pareja;
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


    let pdf = btoa(btoa(btoa(dataset.pdf_ruta)));
    let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`;

    iframe.src = ver

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
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-outline-warning', traePdf);
addPdf.addEventListener('click', modificarPdf)
datatable.on('click', '.btn-outline-info', verPDF);
datatable.on('click', '.btn-danger', eliminar);
