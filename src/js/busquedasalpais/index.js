import { Dropdown, Modal } from "bootstrap";
import Swal from "sweetalert2";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatearFecha } from "../funciones";

const modalSalidapaises = new Modal(document.getElementById('modalSalidapaises'), {
    backdrop: 'static',
    keyboard: false
});
const divInpust = document.getElementById('masInputs')
const btnAddPais = document.getElementById('addPais');
const divAddPaises = document.getElementById('seleccion');
const formulario = document.getElementById('formularioSalidapaises');
const formulario2 = document.getElementById('formularioSalidapais');
const btnCerrarModal = document.getElementById('cerrarModal');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');
const btnBuscar = document.getElementById('btnBuscar');
const addPdf = document.getElementById('addPdf');
const pdf = document.getElementById('formularioPdf');
const iframe = document.getElementById('pdfSalidaPais')
const ofModal = document.getElementById('cerrarModal')

formulario2.ste_cat2.disabled = true;
formulario2.ste_fecha2.disabled = true;
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
            data: 'paises'
        },
        {
            title: 'CIUDAD',
            className: 'text-center',
            data: 'ciudad'
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
            render: (data, type, row, meta) => `
            <div class="btn-group">
            <button class="btn btn-warning" 
            data-id='${data}'>DATOS</button>
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
    const url = `/soliciudes_e/API/busquedasalpais/buscar`;

    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

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





let counter = 1;



const buscarModal = async (e) => {
    const contenedorElementos = document.getElementById("elementos");

    const boton = e.target
    let ids = boton.dataset.id

    let id = ids

    const url = `/soliciudes_e/API/busquedasalpais/buscarModal?id=${id}`;

    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();


        if (data) {
            const dato = data[0]
            console.log(dato)
            let fecha1 = dato.ste_fecha
            let fecha2 = dato.sal_ingreso
            let fecha3 = dato.sal_salida

            let fechaSolicitud = formatearFecha(fecha1)
            let fechaIngreso = formatearFecha(fecha2)
            let fechaSalida = formatearFecha(fecha3)

            formulario2.ste_id.value = dato.ste_id
            formulario2.ste_cat2.value = dato.ste_cat
            formulario2.nombre.value = dato.nombre
            formulario2.ste_fecha2.value = fechaSolicitud
            formulario2.ste_telefono.value = dato.ste_telefono
            formulario2.sol_id.value = dato.sol_id
            formulario2.sol_motivo.value = dato.sol_motivo
            formulario2.sol_obs.value = dato.sol_obs
            formulario2.sal_id.value = dato.sal_id
            formulario2.sal_salida.value = fechaSalida
            formulario2.sal_ingreso.value = fechaIngreso

            const paises = dato.paises;
            const ciudades = dato.ciudad;
            const transportes = dato.transporte;

            paises.forEach((pais, index) => {
                const agregaDivPais = async () => {
                    const $div = document.createElement("div");
                    $div.className = "col-lg-4 mb-3";
                    $div.id = `dsal_pais${counter++}`;
                    const label = document.createElement("label")
                    label.for = `dsal_pais${index}`;
                    label.class = 'form-label';
                    const i = document.createElement("i")
                    i.class = "bi bi-globe-americas";
                    label.appendChild(i);
                    label.innerText = 'Pais a visitar:'

                    const select = document.createElement("select");
                    select.name = `dsal_pais${index}[]`;
                    select.id = `dsal_pais${index}`;
                    select.className = "form-select";

                    // Agrega una opción por defecto
                    const defaultOption = document.createElement('option');
                    defaultOption.value = "";
                    defaultOption.innerText = "Seleccione";
                    select.appendChild(defaultOption);

                    // Agrega opciones desde paisesData
                    paisesData.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.pai_codigo;
                        option.innerText = item.pai_desc_lg;
                        select.appendChild(option);
                    });
                    const closeButton = document.createElement('button');
                    closeButton.type = 'button';
                    closeButton.className = 'btn btn-danger mt-3';
                    closeButton.style.marginLeft = '10px';
                    closeButton.innerText = 'X';
                    closeButton.addEventListener('click', () => {
                        // Elimina el div actual
                        $div.remove();
                    });
                    const addButton = document.createElement('button');
                    addButton.type = 'button';
                    addButton.className = 'btn btn-success mt-3';
                    addButton.style.marginLeft = '10px';
                    addButton.innerText = 'ADD';
                    addButton.addEventListener('click', () => {
                        // Elimina el div actual
                        agregaDivPais();
                    });


                    $div.appendChild(label);
                    $div.appendChild(select);
                    $div.appendChild(addButton)
                    $div.appendChild(closeButton);
                    divInpust.appendChild($div);
                    formulario2[`dsal_pais${index}`].value = pais;

                };

                agregaDivPais();
            });
            transportes.forEach((transporte, indice) => {
                const agregaDivTransporte = async () => {
                    const $div = document.createElement("div");
                    $div.className = "col-lg-3 mb-3";
                    $div.id = `dsal_transporte${counter++}`;
                    const label = document.createElement("label")
                    label.for = `dsal_transporte${indice}`;
                    label.class = 'form-label';
                    const i = document.createElement("i")
                    i.class = "bi bi-globe-americas";
                    label.appendChild(i);
                    label.innerText = 'Tipo de transporte:'

                    const select = document.createElement("select");
                    select.name = `dsal_transporte${indice}[]`;
                    select.id = `dsal_transporte${indice}`;
                    select.className = "form-select";

                    // Agrega una opción por defecto
                    const defaultOption = document.createElement('option');
                    defaultOption.value = "";
                    defaultOption.innerText = "Seleccione";
                    select.appendChild(defaultOption);

                    // Agrega opciones desde dsal_transporteesData
                    transporteData.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.transporte_id;
                        option.innerText = item.transporte_descripcion;
                        select.appendChild(option);
                    });
                    const closeButton = document.createElement('button');
                    closeButton.type = 'button';
                    closeButton.className = 'btn btn-danger mt-3';
                    closeButton.style.marginLeft = '10px';
                    closeButton.innerText = 'X';
                    closeButton.addEventListener('click', () => {
                        // Elimina el div actual
                        $div.remove();
                    });
                    const addButton = document.createElement('button');
                    addButton.type = 'button';
                    addButton.className = 'btn btn-success mt-3';
                    addButton.style.marginLeft = '10px';
                    addButton.innerText = 'ADD';
                    addButton.addEventListener('click', () => {
                        // Elimina el div actual
                        agregaDivTransporte();
                    });


                    $div.appendChild(label);
                    $div.appendChild(select);
                    $div.appendChild(addButton)
                    $div.appendChild(closeButton);
                    divInpust.appendChild($div);
                    formulario2[`dsal_transporte${indice}`].value = transporte;

                };

                agregaDivTransporte();
            });
            ciudades.forEach((ciudad, indice) => {
                const agregaDivCiudad = async () => {
                    const $div = document.createElement("div");
                    $div.className = "col-lg-3 mb-3";
                    $div.id = `dsal_ciudad${counter++}`;
                    const label = document.createElement("label")
                    label.for = `dsal_ciudad${indice}`;
                    label.class = 'form-control';
                    label.innerText = 'Ciudades:'

                    const input = document.createElement("input");
                    input.name = `dsal_ciudad${indice}[]`;
                    input.id = `dsal_ciudad${indice}`;
                    input.type = "text";
                    input.className = "form-control";
                    input.appendChild(label)

                
                    const closeButton = document.createElement('button');
                    closeButton.type = 'button';
                    closeButton.className = 'btn btn-danger mt-3';
                    closeButton.style.marginLeft = '10px';
                    closeButton.innerText = 'X';
                    closeButton.addEventListener('click', () => {
                        // Elimina el div actual
                        $div.remove();
                    });
                    const addButton = document.createElement('button');
                    addButton.type = 'button';
                    addButton.className = 'btn btn-success mt-3';
                    addButton.style.marginLeft = '10px';
                    addButton.innerText = 'ADD';
                    addButton.addEventListener('click', () => {
                        // Elimina el div actual
                        agregaDivCiudad();
                    });


                    $div.appendChild(label);
                    $div.appendChild(input);
                    $div.appendChild(addButton)
                    $div.appendChild(closeButton);
                    divInpust.appendChild($div);
                    formulario2[`dsal_ciudad${indice}`].value = ciudad;

                };

                agregaDivCiudad();
            });

            let pdfSinCorregir = dato.pdf_ruta;
            let pdfCorregido = pdfSinCorregir.substring(10);
            
            let pdf = btoa(btoa(btoa(pdfCorregido)));
            let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`;
            iframe.src = ver


            Toast.fire({
                title: 'Abriendo solicitud',
                icon: 'success'
            });
            modalSalidapaises.show();

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


const borrarTodo = (e) => {
    e.preventDefault()
    divInpust.innerHTML = ''

};
buscar();

// btnBuscar.addEventListener('click', buscar);
// // btnModificar.addEventListener('click', modificar)
// btnCancelar.addEventListener('click', limpiarModelSalidapaises)
datatable.on('click', '.btn-warning', buscarModal);
ofModal.addEventListener('click',borrarTodo)

// datatable.on('click', '.btn-outline-warning', traePdf);
datatable.on('click', '.btn-outline-info', verPDF);
// datatable.on('click', '.btn-danger', eliminar);



