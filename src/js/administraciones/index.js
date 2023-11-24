import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatearFecha, formatoTiempo} from "../funciones";
import { data } from "jquery";

const modalSalCorrecciones = new Modal(document.getElementById('modalSalCorrecciones'), {
    backdrop: 'static',
    keyboard: false
});  
const modalProtoCorrecciones = new Modal(document.getElementById('modalProtoCorrecciones'), {
    backdrop: 'static',
    keyboard: false
}); 
const formulario = document.getElementById('formularioAdministracion');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificarPdf = document.getElementById('addPdf');
const divInpust = document.getElementById('masInputs');
const formulario2 = document.getElementById('formularioSalidapais');
const divSalidas = document.getElementById('divSalidas');
const divPdf = document.getElementById('divPdf');
const iframe = document.getElementById('pdfSalidaPais')
const ofModal = document.getElementById('cerrarModal')
const btnModificarSalidas = document.getElementById('modificarSalidas');
const formularioProto = document.getElementById('formularioProto');
const iframeProto = document.getElementById('pdfSalida');
const divPdfProto = document.getElementById('pdf');
const divProtocolo = document.getElementById('Protocolo');


let contador = 1;
const datatable = new Datatable('#tablaAdministracion', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            className: 'text-center',
            render: () => contador++
        },

        {
            title: 'Solicitante',
            className: 'text-center',
            data: 'solicitante'
        },
        {
            title: 'Tipo',
            className: 'text-center',
            data: 'tipo'
        },
        {
            title: 'Motivo',
            className: 'text-center',
            data: 'motivo'
        },
        {
            title: 'Estado',
            className: 'text-center',
            data: 'sol_situacion',
            render: function (data, type, row) {
                if (type === 'display') {
                    if (data === '1') {
                        return `
            <span style="color: red;">COMANDO</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
                </div>
            `;
                    } else if (data === '2') {
                        return `
                        <span >DGAEMDN</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>
                </div>
            `;
                    } else if (data === '3') {
                        return `
                        <span >DPEMDN</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                </div>
            `;
                    } else if (data === '4') {
                        return `
                        <span >MDN</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                </div>
            `;
                    } else if (data === '5') {
                        return `
                        <span>AUTORIZADO</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            `;
                    } else if (data === '6') {
                        return `<button class="btn btn-danger">RECHAZADA</button>`;
                    } else if (data === '7') {
                        return `<span style="color: red;">CORRECCIONES</span>
                        <div class="btn-group">                        
                                     <button class="btn btn-warning" 
                                    data-id="${data}"data-sol_id='${row.ste_id}'data-sol_tipo='${row.sol_tipo}'>
                                    DATOS
                                    </button>
                                    <button class="btn btn-outline-warning" data-pdf_id='${row["pdf_id"]}' data-ste_cat='${row["ste_cat"]}'data-pdf_solicitud='${row["pdf_solicitud"]}'>PDF</button>
                                     </div>`;
                    } else if (data === '8') {
                        return `<button  class="btn btn-warning" >CORREGIDO</button>`;
                    } else {
                        return '';
                    }
                }
                return data;
            }
        },
        {
            title: 'Telefono',
            data: 'ste_telefono',
        },
        {
            title: 'Enviar',
            className: 'text-center',
            data: 'sol_id',
            searchable: false,
            orderable: false,
            render: function (data, type, row) {
                if (type === 'display') {
                    if (row.sol_situacion === '7') {
                        return `<button class="btn btn-success" data-id='${data}'>Enviar Corrección</button>`;
                    } else if (row.sol_situacion !== '1' && row.sol_situacion !== '7') {
                        return `<button class="btn btn-secondary">Enviado</button>`;
                    } else {
                        return `<button class="btn btn-primary" data-id='${data}'>Enviar</button>`;
                    }
                }
                return data;
            }
        },

    ],

});
const CorreccionDatos = async (e) => {
    e.preventDefault();
    const boton = e.target;
    const tipoSol = boton.dataset.sol_tipo;

    let ids = boton.dataset.sol_id

    let id = ids


    if (tipoSol === '1') {
        let ver = '/soliciudes_e/busquedasc';
        // iframeCorreccion.src = ver;
    } else if (tipoSol === '2') {
        let ver2 = '/soliciudes_e/busquedaslict';
        // iframeCorreccion.src = ver2
    } else if (tipoSol === '3') {


        const url = `/soliciudes_e/API/busquedasalpais/buscarModal?id=${id}`;

        const config = {
            method: 'GET',
        }

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            if (data) {
                Toast.fire({
                    title: 'Abriendo solicitud',
                    icon: 'success'
                });
                const dato = data[0]
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
                        $div.id = `dsal_pais${contador++}`;
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
                        $div.id = `dsal_transporte${contador++}`;
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

                            $div.remove();
                        });
                        const addButton = document.createElement('button');
                        addButton.type = 'button';
                        addButton.className = 'btn btn-success mt-3';
                        addButton.style.marginLeft = '10px';
                        addButton.innerText = 'ADD';
                        addButton.addEventListener('click', () => {

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
                        $div.id = `dsal_ciudad${contador++}`;
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

                            $div.remove();
                        });
                        const addButton = document.createElement('button');
                        addButton.type = 'button';
                        addButton.className = 'btn btn-success mt-3';
                        addButton.style.marginLeft = '10px';
                        addButton.innerText = 'ADD';
                        addButton.addEventListener('click', () => {

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
                divPdf.style.display = 'none';
                divSalidas.style.display = 'block';
                modalSalCorrecciones.show();

            } else {
                Toast.fire({
                    title: 'No se encontraron registros',
                    icon: 'info'
                });
            }
        } catch (error) {
            console.log(error);
        }

        

    } else if (tipoSol === '4') {
        modalProtoCorrecciones.show();
        divPdfProto.style.display = 'none';
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
    
                
                formularioProto.ste_id.value = dato.ste_id
                formularioProto.ste_cat2.value = dato.ste_cat
                formularioProto.nombre.value = dato.nombre
                formularioProto.ste_fecha2.value = fechaSolicitud
                formularioProto.ste_telefono.value = dato.ste_telefono
                formularioProto.sol_motivo.value = dato.sol_motivo
                formularioProto.sol_obs2.value = dato.sol_obs            
                formularioProto.pco_autorizacion.value = dato.pco_autorizacion
                formularioProto.pco_id.value = dato.pco_id
                formularioProto.pco_cmbv.value = dato.cmv_id
                formularioProto.pco_just.value = dato.pco_just
                formularioProto.pco_fechainicio.value = fechaInicio
                formularioProto.pco_fechafin.value = fechaFin
                formularioProto.pco_dir.value = dato.pco_dir
    
                let pdfSinCorregir = dato.pdf_ruta;
                let pdfCorregido = pdfSinCorregir.substring(10);
                
                let verDoc = btoa(btoa(btoa(pdfCorregido)));
                let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${verDoc}`
                iframeProto.src = ver   
    
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

}
const modificarSal = async (evento) => {

    evento.preventDefault();
    let catalogo = formulario2.ste_cat2.value
    let fecha = formulario2.ste_fecha2.value

    const body = new FormData(formulario2);
    body.append('ste_cat2', catalogo)
    body.append('ste_fecha2', fecha)
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
                modalSalCorrecciones.hide()
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

const traePdfSalida = (e) => {

    const button = e.target;
    const pdf_id = button.dataset.pdf_id;
    const pdf_solicitud = button.dataset.pdf_solicitud;
    const ste_catalogo = button.dataset.ste_cat
    const dataset = {
        pdf_id,
        pdf_solicitud,
        ste_catalogo
    };
        formulario2.pdf_solicitud.value = dataset.pdf_solicitud;
        formulario2.pdf_id.value = dataset.pdf_id;
        formulario2.ste_cat2.value = dataset.ste_catalogo
        divSalidas.style.display = 'none'
        divPdf.style.display ='block';
        modalSalCorrecciones.className = 'modal fade modal-sm'
        modalSalCorrecciones.show();     
};
const modificarPdfSalidas = async (evento) => {

    evento.preventDefault();
    let ste_id = formulario2.ste_cat2.value
    const body = new FormData(formulario2);
    body.append('ste_cat2', ste_id)
    const url = '/soliciudes_e/API/busquedasalpais/modificarPdf';
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
                modalSalCorrecciones.hide()
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

const buscar = async () => {

    // let dep_valor = dependencias.value 
    // let tipo = tipos.value 

    const url = `/soliciudes_e/API/administraciones/buscar`;


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

const enviar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea enviar esta solicitud?')) {
        const body = new FormData()
        body.append('sol_id', id)
        const url = '/soliciudes_e/API/administraciones/enviarDga';
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
            let icon = 'info';
            switch (codigo) {
                case 1:
                    icon = 'success';
                    buscar();
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

}
const borrarTodo = (e) => {
    e.preventDefault()
    divInpust.innerHTML = ''

};

buscar();

btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-primary', enviar);
ofModal.addEventListener('click', borrarTodo);
datatable.on('click', '.btn-warning', CorreccionDatos)
btnModificarSalidas.addEventListener('click', modificarSal)
btnModificarPdf.addEventListener('click',modificarPdfSalidas);
datatable.on('click', '.btn-outline-warning', traePdfSalida);