import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatearFecha, formatoTiempo } from "../funciones";
import { data } from "jquery";

const modalSalCorrecciones = new Modal(document.getElementById('modalSalCorrecciones'), {
    backdrop: 'static',
    keyboard: false
});
const modalProtoCorrecciones = new Modal(document.getElementById('modalProtoCorrecciones'), {
    backdrop: 'static',
    keyboard: false
});
const modalCorrecionLicencias = new Modal(document.getElementById('modalCorrecionLicencias'), {
    backdrop: 'static',
    keyboard: false
});
const modalCorreccionCasamiento = new Modal(document.getElementById('modalCorreccionCasamiento'), {
    backdrop: 'static',
    keyboard: false
});
const modalPdfCorreccionCasamiento = new Modal(document.getElementById('modalPdfCorreccionCasamiento'), {
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
//modal para modificar protocolo 
const formularioProto = document.getElementById('formularioProto');
const iframeProto = document.getElementById('pdfSalida');
const divPdfProto = document.getElementById('pdf');
const divProtocolo = document.getElementById('Protocolo');
const btnModificarPdfProtocolo = document.getElementById('pdfProtocolo')
const btnModificarProtocolo = document.getElementById('modificarProtocolo');
//modal para modificar licencias temporales
const formularioModalLicencia = document.getElementById('formularioLicenciasB');
const btnModficarDatosLicencia = document.getElementById('modificarLicencia')
const divPdfLicencias = document.getElementById('licencias');
const divLicencias = document.getElementById('divPdfLicencia');
const btnModificarPdfLicencia = document.getElementById('pdfLicencias')
const iframeLicencias = document.getElementById('pdfLicencia');
//modal para modificar casamientos 
const formularioCorreccionCasamiento = document.getElementById('formularioCasamiento');
const pdf = document.getElementById('formularioPdf');
const ste_cat2 = document.getElementById('catalogo');
const idPareja = document.getElementById('parejac_id')
const iframeCasamiento = document.getElementById('pdfIframe');
const btnModificarModificarCasamiento = document.getElementById('btnModificaCasamiento');
const addPdf = document.getElementById('modificarPdfCas');
const parejam_cat = document.getElementById('parejam_cat');
const divMilitar = document.getElementById('parejaMilitar');
const divCivil = document.getElementById('parejaCivil');

divMilitar.style.display = 'none';
divCivil.style.display = 'none';
formularioCorreccionCasamiento.ste_cat.disabled = true;
formularioCorreccionCasamiento.ste_fecha.disabled = true;
formularioCorreccionCasamiento.nombre.disabled = true;
formulario2.ste_cat2.disabled = true;
formulario2.nombre.disabled = true;
formulario2.ste_fecha2.disabled = true;
formularioProto.ste_cat2.disabled = true;
formularioProto.ste_fecha.disabled = true;
formularioProto.nombre.disabled = true;
formularioModalLicencia.ste_cat.disabled = true;
formularioModalLicencia.nombre.disabled = true;

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
            title: 'Telefono',
            data: 'ste_telefono',
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
                    } else if (data === '7') {
                        return `
                     <span style="color: red;">COMANDO CORRECCIONES</span>
                    <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                    </div>
                `;
                    } else if (data === '8') {
                        return `
                 <span >DPEMDN CORREGIDO</span>
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
            title: 'CORRECCIONES',
            className: 'text-center',
            data: 'sol_situacion',
            render: function (data, type, row) {
                if (type === 'display') {
                    if (data === '7') {
                        return `
                        <div class="btn-group">                        
                                     <button class="btn btn-warning" 
                                    data-id="${data}"data-sol_id='${row.ste_id}'data-sol_tipo='${row.sol_tipo}'>
                                    DATOS
                                    </button>
                                    <button class="btn btn-outline-warning" data-id="${data}"data-sol_tipo='${row.sol_tipo}' data-pdf_id='${row["pdf_id"]}' data-ste_cat='${row["ste_cat"]}'data-pdf_solicitud='${row["pdf_solicitud"]}'>PDF</button>
                                    <button id="verPdf" class="btn btn-success"data-sol_id='${row.sol_id}'>Boleta</button> 
                                    </div>`;
                    } else if (data === '8') {
                        return `<button  class="btn btn-warning" >CORREGIDO</button>`;
                    } else if (data !== '7' && data !== '8' && data !== '1') {
                        return `<span>SIN CORRECCIONES</span>`;
                    } else if (data === '1') {
                        return `<span> PENDIENTE DE ENVIAR </span>`;
                    } else {
                        return '';
                    }
                }
                return data;
            }
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
                        return `<button id="enviarCorrecciones"class="btn btn-success" data-id='${data}'>Enviar Corrección</button>`;
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
    columnDefs: [
        { className: 'text-center', targets: '_all' },
        { className: 'align-middle', targets: '_all' }
    ]

});
const CorreccionDatos = async (e) => {
    e.preventDefault();
    const boton = e.target;
    const tipoSol = boton.dataset.sol_tipo;

    let ids = boton.dataset.sol_id

    let id = ids


    if (tipoSol === '1') {
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
                formularioCorreccionCasamiento.parejac_nombres.value = nombres;
                formularioCorreccionCasamiento.parejac_apellidos.value = apellidos;
                formularioCorreccionCasamiento.ste_id.value = dato.ste_id;
                formularioCorreccionCasamiento.ste_cat.value = dato.ste_cat;
                formularioCorreccionCasamiento.nombre.value = dato.nombres_solicitante;
                formularioCorreccionCasamiento.ste_fecha.value = ste_fecha;
                formularioCorreccionCasamiento.ste_telefono.value = dato.ste_telefono;
                formularioCorreccionCasamiento.mat_id.value = dato.mat_id;
                formularioCorreccionCasamiento.mat_lugar_civil.value = dato.mat_lugar_civil;
                formularioCorreccionCasamiento.mat_fecha_bodac.value = mat_fecha_bodac;
                formularioCorreccionCasamiento.mat_lugar_religioso.value = dato.mat_lugar_religioso;
                formularioCorreccionCasamiento.mat_fecha_bodar.value = mat_fecha_bodar;
                formularioCorreccionCasamiento.mat_per_civil.value = dato.mat_per_civil;
                idPareja.value = dato.parejac_id;
                formularioCorreccionCasamiento.parejac_direccion.value = dato.parejac_direccion;
                formularioCorreccionCasamiento.parejac_dpi.value = dato.parejac_dpi;
                formularioCorreccionCasamiento.mat_per_army.value = dato.mat_per_army;
                formularioCorreccionCasamiento.parejam_id.value = dato.parejam_id;
                parejam_cat.value = dato.parejam_cat;
                formularioCorreccionCasamiento.parejaNombre.value = dato.nombres_pareja;
                formularioCorreccionCasamiento.mat_fecha_lic_ini.value = mat_fecha_lic_ini;
                formularioCorreccionCasamiento.mat_fecha_lic_fin.value = mat_fecha_lic_fin;

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

                iframeCasamiento.src = ver

                modalCorreccionCasamiento.show()


            } else {
                Toast.fire({
                    title: 'No se encontraron registros',
                    icon: 'info'

                })
            }

        } catch (error) {
            console.log(error);
        }
    } else if (tipoSol === '2') {
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
                modalCorrecionLicencias.show();
                const dato = data[0];
                divPdfLicencias.style.display = 'block';
                formularioModalLicencia.lit_id.value = dato.lit_id;
                formularioModalLicencia.sol_id.value = dato.sol_id;
                formularioModalLicencia.ste_id.value = dato.ste_id;
                formularioModalLicencia.ste_cat.value = dato.ste_cat;
                formularioModalLicencia.ste_telefono.value = dato.ste_telefono;
                formularioModalLicencia.sol_obs.value = dato.sol_obs;
                formularioModalLicencia.sol_motivo.value = dato.sol_motivo;
                formularioModalLicencia.nombre.value = dato.nombres_solicitante;
                formularioModalLicencia.tiempo.value = dato.tiempo;
                const numero = dato.tiempo;
                formatoTiempo(numero).then((tiempoFormateado) => {
                    formularioModalLicencia.tiempo_servicio.value = tiempoFormateado;
                    formularioModalLicencia.tiempo_servicio.disabled = true;
                })
                const numeroEntero = parseInt(numero, 10);
                if (numeroEntero >= 10000 && numeroEntero <= 50000) {
                    formularioModalLicencia.lit_mes_consueldo.setAttribute('max', '0');
                    formularioModalLicencia.lit_mes_sinsueldo.setAttribute('max', '3');
                    formularioModalLicencia.lit_articulo.value = '2'
                } else if (numeroEntero >= 50001 && numeroEntero <= 100000) {
                    formularioModalLicencia.lit_mes_consueldo.setAttribute('max', '0');
                    formularioModalLicencia.lit_mes_sinsueldo.setAttribute('max', '6');
                    formularioModalLicencia.lit_articulo.value = '3'
                } else if (numeroEntero >= 100001 && numeroEntero <= 200000) {
                    formularioModalLicencia.lit_mes_consueldo.setAttribute('max', '1');
                    formularioModalLicencia.lit_mes_sinsueldo.setAttribute('max', '6');
                    formularioModalLicencia.lit_articulo.value = '4'
                } else if (numeroEntero >= 200001 && numeroEntero <= 280000) {
                    formularioModalLicencia.lit_mes_consueldo.setAttribute('max', '2');
                    formularioModalLicencia.lit_mes_sinsueldo.setAttribute('max', '6');
                    formularioModalLicencia.lit_articulo.value = '5'
                } else if (numeroEntero >= 280001 && numeroEntero <= 330000) {
                    formularioModalLicencia.lit_mes_consueldo.setAttribute('max', '1');
                    formularioModalLicencia.lit_mes_sinsueldo.setAttribute('max', '6');
                    formularioModalLicencia.lit_articulo.value = '6'
                } else if (numeroEntero >= 33001) {
                    formularioModalLicencia.lit_mes_consueldo.setAttribute('max', '2');
                    formularioModalLicencia.lit_mes_sinsueldo.setAttribute('max', '6');
                    formularioModalLicencia.lit_articulo.value = '6'
                } else {
                    return
                }
                formularioModalLicencia.lit_mes_consueldo.value = dato.lit_mes_consueldo;
                formularioModalLicencia.lit_mes_sinsueldo.value = dato.lit_mes_sinsueldo;
                divLicencias.style.display = 'none';
                let fecha1SinFormato = dato.lit_fecha1
                let fecha1ConFormato = formatearFecha(fecha1SinFormato)
                formularioModalLicencia.lit_fecha1.value = fecha1ConFormato;
                let fecha2SinFormato = dato.lit_fecha2
                let fecha2ConFormato = formatearFecha(fecha2SinFormato)
                formularioModalLicencia.lit_fecha2.value = fecha2ConFormato;
                let pdf = btoa(btoa(btoa(dato.pdf_ruta)));
                let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`;
                iframeLicencias.src = ver
            } else {
                Toast.fire({
                    title: 'No se encontraron registros',
                    icon: 'info'

                })
            }

        } catch (error) {
            console.log(error);
        }
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

                let fechaIngreso = formatearFecha(fecha2)
                let fechaSalida = formatearFecha(fecha3)

                formulario2.ste_id.value = dato.ste_id
                formulario2.ste_cat2.value = dato.ste_cat
                formulario2.nombre.value = dato.nombre
                formulario2.ste_fecha2.value = dato.ste_fecha
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
                formularioProto.ste_fecha.value = fechaSolicitud
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
            formularioCorreccionCasamiento.parejam_arm.value = dato.per_arma;
            formularioCorreccionCasamiento.parejam_gra.value = dato.per_grado;
            formularioCorreccionCasamiento.parejam_emp.value = dato.org_plaza_desc
            formularioCorreccionCasamiento.parejam_comando.value = dato.dep_llave
            formularioCorreccionCasamiento.parejam_cat.value = dato.per_catalogo
            formularioCorreccionCasamiento.parejaNombre.value = dato.nombres;
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
const modificarProtocolo = async (evento) => {

    evento.preventDefault();
    let catalogo = formularioProto.ste_cat2.value
    let fecha = formularioProto.ste_fecha.value
    const body = new FormData(formularioProto)
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
    buscar()
}
const modificarPdfProtocolo = async (evento) => {
    evento.preventDefault();
    let ste_id = formularioProto.ste_cat2.value
    const body = new FormData(formularioProto);
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

                icon = 'success'
                modalProtoCorrecciones.hide()
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
const modificarLicencia = async (evento) => {
    evento.preventDefault();
    const body = new FormData(formularioModalLicencia)
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

                icon = 'success'
                buscar();
                modalCorrecionLicencias.hide()
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
const modificarPdfLicencia = async (evento) => {
    evento.preventDefault();
    let ste_id = formulario2.ste_cat2.value
    const body = new FormData(formularioModalLicencia);
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
                icon = 'success'
                modalCorrecionLicencias.hide()
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
const modificarCasamiento = async (evento) => {

    evento.preventDefault();
    let catalogo = formularioCorreccionCasamiento.ste_cat.value
    let fecha = formularioCorreccionCasamiento.ste_fecha.value
    const body = new FormData(formularioCorreccionCasamiento)
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
                icon = 'success'
                modalCorreccionCasamiento.hide()
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
const modificarPdfCas = async (evento) => {

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
        const data = await respuesta.text();
        console.log(data)
        return

        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                icon = 'success'
                modalPdfCorreccionCasamiento.hide()
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
const traePdfParaCorrecciones = (e) => {
    const boton = e.target;
    const tipoSol = boton.dataset.sol_tipo;
    console.log(tipoSol)
    if (tipoSol === '1') {
        modalPdfCorreccionCasamiento.show()
        const button = e.target;
        const ste_cat = button.dataset.ste_cat;
        const pdf_id = button.dataset.pdf_id;
        const pdf_solicitud = button.dataset.pdf_solicitud;


        const dataset = {

            ste_cat,
            pdf_id,
            pdf_solicitud
        };
        ste_cat2.value = dataset.ste_cat;
        pdf.pdf_solicitud.value = dataset.pdf_solicitud;
        pdf.pdf_id.value = dataset.pdf_id;

    } else if (tipoSol === '2') {
        modalCorrecionLicencias.show()
        divPdfLicencias.style.display = 'none';
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
        formularioModalLicencia.pdf_solicitud.value = dataset.pdf_solicitud;
        formularioModalLicencia.pdf_id.value = dataset.pdf_id;
    } else if (tipoSol === '3') {
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
        divPdf.style.display = 'block';
        modalSalCorrecciones.className = 'modal fade modal-sm'
        modalSalCorrecciones.show();

    } else if (tipoSol === '4') {
        modalProtoCorrecciones.show()
        divPdfProto.style.display = 'block';
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

        formularioProto.pdf_solicitud.value = dataset.pdf_solicitud;
        formularioProto.pdf_id.value = dataset.pdf_id;

    }


};
const buscar = async () => {

    const catalogo = formulario.ste_cat.value
    const fecha = formulario.ste_fecha.value
    const estado = formulario.sol_situacion.value
    const tipo = formulario.tse_id.value

    const url = `/soliciudes_e/API/administraciones/buscar?catalogo=${catalogo}&fecha=${fecha}&estado=${estado}&tipo=${tipo}`;


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
const buscarPdf = async (e) => {
    e.preventDefault();

    let boton = e.target
    let solicitud = boton.dataset.sol_id


    const url = `/soliciudes_e/pdf/buscar?sol_id=${solicitud}`;

    // const config = {
    //     method: 'GET',
    // }
    try {
        const respuesta = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'fetch'
            }
        });
        // const respuesta = await fetch(url, config)
        // const data = await respuesta.json();
        // console.log(data);
        // return

        if (respuesta.ok) {
            // Abre el PDF en una nueva ventana o pestaña del navegador
            const blob = await respuesta.blob();
            const urlBlob = window.URL.createObjectURL(blob);
            window.open(urlBlob, '_blank');
        } else {
            console.log('Error en la respuesta del servidor');
        }
    } catch (error) {
        console.log(error);
    }
}
const corregir = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

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

buscar();

btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-primary', enviar);
ofModal.addEventListener('click', borrarTodo);
datatable.on('click', '.btn-warning', CorreccionDatos)
btnModificarSalidas.addEventListener('click', modificarSal)
btnModificarPdf.addEventListener('click', modificarPdfSalidas);
datatable.on('click', '.btn-outline-warning', traePdfParaCorrecciones);
btnModificarProtocolo.addEventListener('click', modificarProtocolo);
btnModificarPdfProtocolo.addEventListener('click', modificarPdfProtocolo)
btnModficarDatosLicencia.addEventListener('click', modificarLicencia);
btnModificarPdfLicencia.addEventListener('click', modificarPdfLicencia);
btnModificarModificarCasamiento.addEventListener('click', modificarCasamiento);
addPdf.addEventListener('click', modificarPdfCas);
datatable.on('click', '#verPdf', buscarPdf);
datatable.on('click', '#enviarCorrecciones', corregir)