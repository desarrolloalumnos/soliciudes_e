import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

// const modalSalidapaises = new Modal(document.getElementById('modalSalidapaises'), {
//     backdrop: 'static',
//     keyboard: false
// });

// const modalPdf = new Modal(document.getElementById('modalPdf'), {
//     backdrop: 'static',
//     keyboard: false
// });

const modalSalidapaises = new Modal(document.getElementById('modalSalidapaises'),  {})
const formulario = document.getElementById('formularioSalidapaises');
const formulario2 = document.getElementById('formularioSalidapais');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');
const btnBuscar = document.getElementById('btnBuscar');
const ste_cat2 = document.getElementById('ste_cat2');
const idPais = document.getElementById('pai_codigo')
const idTransporte = document.getElementById('transporte_id')
const addPdf = document.getElementById('addPdf');
const pdf = document.getElementById('formularioPdf');
const iframe = document.getElementById('pdfIframe')

formulario2.ste_cat.disabled = true;
formulario2.ste_fecha.disabled = true;
formulario2.nombre.disabled = true;


let contador = 1;
const datatable = new Datatable('#tablaSalidapaises', {
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
            title: 'FECHA SALIDA DEL PAIS',
            className: 'text-center',
            data: function (row) {
                return row.sal_salida.substring(0, 10);
            }
        },
        {
            title: 'FECHA INGRESO DEL PAIS',
            className: 'text-center',           
            data: function (row) {
                return row.sal_ingreso.substring(0, 10);
            }
        },
        {
            title: 'PAIS',
            className: 'text-center',
            data: 'pai_desc_lg'
        },
        {
            title: 'CIUDAD',
            className: 'text-center',
            data: 'dsal_ciudad'
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
            data: 'sal_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" 
            data-id='${data}'>Modificar</button>`
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
    const url = `/soliciudes_e/API/busquedasalpais/buscar`;

    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        // console.log(data);
        datatable.clear().draw();
        if (data) {
            contador = 1;
            datatable.rows.add(data).draw();
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

    const traeDatos = (e) => {  

        modalSalidapaises.show()

        const button = e.target;
        console.log(button.dataset.nombre);
        const sal_id = button.dataset.id
        const sal_autorizacion = button.dataset.sal_autorizacion
        const ste_id = button.dataset.ste_id
        const ste_cat = button.dataset.ste_cat
        const sol_id = button.dataset.sol_id
        const ste_fecha = button.dataset.ste_fecha
        const ste_telefono = button.dataset.ste_telefono;
        const dsal_id = button.dataset.dsal_id;
        const dsal_sol_salida = button.dataset.dsal_sol_salida;
        const dsal_ciudad = button.dataset.dsal_ciudad;
        const dsal_pais = button.dataset.dsal_pais;
        const pai_codigo = button.dataset.pai_codigo;
        const pai_desc_lg = button.dataset.pai_desc_lg;
        const dsal_transporte = button.dataset.dsal_transporte;
        const transporte_id = button.dataset.transporte_id;
        const transporte_descripcion = button.dataset.transporte_descripcion;
        const sal_salida = button.dataset.sal_salida;
        const sal_ingreso = button.dataset.sal_ingreso;
        const nombre = button.dataset.nombre;
        const grado = button.dataset.grado
        const pdf_ruta = button.dataset.pdf_ruta;
      


    const dataset = {
        sal_id,
        sal_autorizacion,
        ste_id,
        ste_cat,
        ste_telefono,
        ste_fecha,
        sol_id,
        dsal_id,
        dsal_sol_salida,
        dsal_ciudad,
        dsal_pais,
        pai_codigo,
        pai_desc_lg,
        dsal_transporte,
        transporte_id,
        transporte_descripcion,
        sal_salida,
        sal_ingreso,
        nombre,
        grado,
        pdf_ruta
    };

    colocarDatos(dataset);

    };

    const colocarDatos = (dataset) => {

        // const sal_salida = formatearFecha(dataset.sal_salida);
        // const sal_ingreso = formatearFecha(dataset.sal_ingreso);
        // const ste_fecha = formatearFecha(dataset.ste_fecha);

        formulario2.ste_id.value = dataset.ste_id;
        formulario2.ste_cat.value = dataset.ste_cat;
        formulario2.nombre.value = dataset.nombre;
        formulario2.ste_gra.value = dataset.grado;
        formulario2.ste_fecha.value = ste_fecha;
        formulario2.ste_telefono.value = dataset.ste_telefono;
        formulario2.sal_id.value = dataset.sal_id;
        formulario2.sal_salida.value = sal_salida;
        formulario2.sal_ingreso.value = sal_ingreso;
        formulario2.dsal_id.value = dataset.dsal_id;
        formulario2.dsal_ciudad.value = dataset.dsal_ciudad;
        formulario2.dsal_pais.value = dsal_pais;
        formulario2.dsal_transporte.value = dsal_transporte;
        idPais.value = dataset.pai_codigo;
        formulario2.pai_desc_lg.value = dataset.pai_desc_lg;
        idTransporte.value = dataset.transporte_id;
        // formulario2.transporte_descripcion.value = dataset.transporte_descripcion;
        

    //     let pdf = btoa(btoa(btoa(dataset.pdf_ruta)));
    //     let ver = `/soliciudes_e/API/busquedasalpais/pdf?ruta=${pdf}`;

    //     iframe.src = ver

    }

    const limpiarModelSalidapaises = async () => {
        modalSalidapaises.hide()
    }
    

    // const traePdf = (e) => {

    //     modalPdf.show()
    //     const button = e.target;
    //     const ste_cat = button.dataset.ste_cat;
    //     const pdf_id = button.dataset.pdf_id;
    //     const pdf_solicitud = button.dataset.pdf_solicitud;


    //     const dataset = {

    //         ste_cat,
    //         pdf_id,
    //         pdf_solicitud
    //     };
    //     colocarPdf(dataset)

    // };

    // const colocarPdf = (dataset) => {
    //     ste_cat2.value = dataset.ste_cat;
    //     pdf.pdf_solicitud.value = dataset.pdf_solicitud;
    //     pdf.pdf_id.value = dataset.pdf_id;


    // }

    const modificar = async (evento) => {

        evento.preventDefault();
        let catalogo = formulario2.ste_cat.value
        let fecha = formulario2.ste_fecha.value

        const body = new FormData(formulario2);
        body.append('ste_cat', catalogo)
        body.append('ste_fecha', fecha)
        const url = '/soliciudes_e/API/busquedasalpais/modificar';  
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'POST',
            body,
        };
    
        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { codigo, mensaje, detalle } = data;
            let icon = 'info'
            switch (codigo) {
                case 1:
                    formulario.reset();
                    icon = 'success'
                    buscar();
                        // modalSalidapaises.hide();
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

    // const modificarPdf = async (evento) => {

    //     evento.preventDefault();
    
    
    //     const body = new FormData(pdf);
    //     body.append('ste_cat2', ste_id)
    //     const url = '/soliciudes_e/API/busquedasalpais/modificarPdf';
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
    //                 modalPdf.hide()
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

    const eliminar = async (e) => {
        const button = e.target;
        const id = button.dataset.id;
    
        if (await confirmacion('warning', 'Desea elminar este registro?')) {
    
            const body = new FormData()
            body.append('sol_id', id)
            const url = '/soliciudes_e/API/busquedasalpais/eliminar';
    
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

        const boton = e.target
        let ruta = boton.dataset.ruta
    
        let pdf = btoa(btoa(btoa(ruta)))
    
        window.open(`/soliciudes_e/API/busquedasalpais/pdf?ruta=${pdf}`)
    
    }
    buscar();
    
    btnBuscar.addEventListener('click', buscar);
    btnModificar.addEventListener('click', modificar)
    btnCancelar.addEventListener('click', limpiarModelSalidapaises)
    datatable.on('click', '.btn-warning', traeDatos);
    datatable.on('click', '.btn-outline-warning', traePdf);
    datatable.on('click', '.btn-outline-info', verPDF);
    datatable.on('click', '.btn-danger', eliminar);
    
