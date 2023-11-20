import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatearFecha, formatoTiempo } from "../funciones";


const modalSalidapaises = new Modal(document.getElementById('modal1'), {
    backdrop: 'static',
    keyboard: false
});
const modalProtocolo = new Modal(document.getElementById('modalProto'), {
    backdrop: 'static',
    keyboard: false
});
const modalM = new Modal(document.getElementById('modalCasamiento'), {
    backdrop: 'static',
    keyboard: false
});
const modalL = new Modal(document.getElementById('modalMostrarLicencias'), {
    backdrop: 'static',
    keyboard: false
});
const formulario = document.getElementById('formularioDepersonal');
const formulario2 = document.getElementById('formularioSalidapais');
const formulario4 = document.getElementById('formularioCasamiento');
const idPareja = document.getElementById('parejac_id')
const iframeCasamiento = document.getElementById('pdfIframe');
const parejam_cat = document.getElementById('parejam_cat');
const divMilitar = document.getElementById('parejaMilitar');
const divCivil = document.getElementById('parejaCivil');
const formularioModal = document.getElementById('formularioLicenciasB');
const iframeLicencias = document.getElementById('pdfLicencia');
const formulario3 = document.getElementById('formularioProto');
const btnBuscar = document.getElementById('btnBuscar')
const divInpust = document.getElementById('masInputs');
const iframe = document.getElementById('pdfSalidaPais')
const iframeProto = document.getElementById('pdfSalida');
divMilitar.style.display = 'none';
divCivil.style.display = 'none';
formularioModal.ste_cat.disabled = true;
formularioModal.nombre.disabled = true;

let contador = 1;
const datatable = new Datatable('#tablaDepersonal', {
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
            title: 'Telefono',
            data: 'ste_telefono',
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
            title: 'Dependencia',
            className: 'text-center',
            data: 'dependencia_solicitante'
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
                        return `<button class="btn btn-warning">CORRECCIONES</button>`;
                    } else {
                        return '';
                    }
                }
                return data;
            }
        },
        {
            title: 'Revision',
            className: 'text-center',
            data: 'ste_id',
            searchable: false,
            orderable: false,
            render: function (data, type, row) {
                if (type === 'display') {
                    return `<button class="btn btn-primary" data-id='${data}' data-tse_id='${row.tse_id}'>Revisar</button>`;
                }
                return data;
            }
        },

    ],
});

const buscar = async () => {


    const url = `/soliciudes_e/API/direccionpersonal/buscar`;


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
    let tse_id = boton.dataset.tse_id
    let tipoSolicitud = tse_id
    console.log(tipoSolicitud)
    try {
        const boton = e.target
        let ste_id = boton.dataset.id
        let id = ste_id
        if (tipoSolicitud == 1) {
            console.log(id)
            const url = `/soliciudes_e/API/busquedasc/buscarModal?id=${id}`;
            const config = {
                method: 'GET',
            }
            const respuesta = await fetch(url, config)
            const data = await respuesta.json();
            if (data) {
                Toast.fire({
                    title: 'Abriendo Solicitud',
                    icon: 'success'

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
                formulario4.parejac_nombres.value = nombres;
                formulario4.parejac_apellidos.value = apellidos;
                formulario4.ste_id.value = dato.ste_id;
                formulario4.ste_cat.value = dato.ste_cat;
                formulario4.nombre.value = dato.nombres_solicitante;
                formulario4.ste_fecha.value = ste_fecha;
                formulario4.ste_telefono.value = dato.ste_telefono;
                formulario4.mat_id.value = dato.mat_id;
                formulario4.mat_lugar_civil.value = dato.mat_lugar_civil;
                formulario4.mat_fecha_bodac.value = mat_fecha_bodac;
                formulario4.mat_lugar_religioso.value = dato.mat_lugar_religioso;
                formulario4.mat_fecha_bodar.value = mat_fecha_bodar;
                formulario4.mat_per_civil.value = dato.mat_per_civil;
                idPareja.value = dato.parejac_id;
                formulario4.parejac_direccion.value = dato.parejac_direccion;
                formulario4.parejac_dpi.value = dato.parejac_dpi;
                formulario4.mat_per_army.value = dato.mat_per_army;
                formulario4.parejam_id.value = dato.parejam_id;
                parejam_cat.value = dato.parejam_cat;
                formulario4.parejaNombre.value = dato.nombres_pareja;
                formulario4.mat_fecha_lic_ini.value = mat_fecha_lic_ini;
                formulario4.mat_fecha_lic_fin.value = mat_fecha_lic_fin;

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

                modalM.show()
            } else {
                Toast.fire({
                    title: 'No se encontraron registros',
                    icon: 'info'
                });
            }

        } else if (tipoSolicitud == 2) {
            const url = `/soliciudes_e/API/busquedaslict/buscarModal?id=${id}`;
            const config = {
                method: 'GET',
            }

            const respuesta = await fetch(url, config)
            const data = await respuesta.json();

            if (data) {
                Toast.fire({
                    title: 'Abriendo Solicitud',
                    icon: 'success'

                })
                modalL.show();
                const dato = data[0];
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
         
                let fecha1SinFormato = dato.lit_fecha1
                let fecha1ConFormato = formatearFecha(fecha1SinFormato)
                formularioModal.lit_fecha1.value = fecha1ConFormato;
                let fecha2SinFormato = dato.lit_fecha2
                let fecha2ConFormato = formatearFecha(fecha2SinFormato)
                formularioModal.lit_fecha2.value = fecha2ConFormato;
                let pdf = btoa(btoa(btoa(dato.pdf_ruta)));
                let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`;
                iframeLicencias.src = ver
            } else {
                Toast.fire({
                    title: 'No se encontraron registros',
                    icon: 'info'

                })
            }

        } else if (tipoSolicitud == 3) {
            const url = `/soliciudes_e/API/busquedasalpais/buscarModal?id=${id}`;

            const config = {
                method: 'GET',
            }
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

                        $div.appendChild(label);
                        $div.appendChild(select);
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
                        $div.appendChild(label);
                        $div.appendChild(select);

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

                        $div.appendChild(label);
                        $div.appendChild(input);

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
                modalSalidapaises.show()


            } else {
                Toast.fire({
                    title: 'No se encontraron registros',
                    icon: 'info'
                });
            }
        } else if (tipoSolicitud == 4) {
            const url = `/soliciudes_e/API/busquedasproto/buscarModal?id=${id}`;
            const config = {
                method: 'GET',
            }

            const respuesta = await fetch(url, config)
            const data = await respuesta.json();


            if (data) {
                Toast.fire({
                    title: 'Abriendo solicitud',
                    icon: 'success'
                });
                const dato = data[0]
                let fechaSinFormato = dato.ste_fecha
                let fechaSolicitud = formatearFecha(fechaSinFormato)

                let fecha2SinFormato = dato.pco_fechainicio
                let fechaInicio = formatearFecha(fecha2SinFormato)

                let fecha3SinFormato = dato.pco_fechafin
                let fechaFin = formatearFecha(fecha3SinFormato)


                formulario3.ste_id.value = dato.ste_id
                formulario3.ste_cat2.value = dato.ste_cat
                formulario3.nombre.value = dato.nombre
                formulario3.ste_fecha2.value = fechaSolicitud
                formulario3.ste_telefono.value = dato.ste_telefono
                formulario3.sol_motivo.value = dato.sol_motivo
                formulario3.sol_obs2.value = dato.sol_obs
                formulario3.pco_autorizacion.value = dato.pco_autorizacion
                formulario3.pco_id.value = dato.pco_id
                formulario3.pco_cmbv.value = dato.cmv_id
                formulario3.pco_just.value = dato.pco_just
                formulario3.pco_fechainicio.value = fechaInicio
                formulario3.pco_fechafin.value = fechaFin
                formulario3.pco_dir.value = dato.pco_dir

                let pdfSinCorregir = dato.pdf_ruta;
                let pdfCorregido = pdfSinCorregir.substring(10);

                let verDoc = btoa(btoa(btoa(pdfCorregido)));
                let ver = `/soliciudes_e/API/busquedasc/pdf?ruta=${verDoc}`
                iframeProto.src = ver
                modalProtocolo.show()

            } else {
                Toast.fire({
                    title: 'No se encontraron registros',
                    icon: 'info'
                });
            }
        }

    } catch (error) {
        console.log(error);
    }
}

const enviar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea enviar esta solicitud?')) {
        const body = new FormData()
        body.append('sol_id', id)
        const url = '/soliciudes_e/API/direccionpersonal/enviarMdn';
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'POST',
            body
        }
        try {
            const respuesta = await fetch(url, config)
            const data = await respuesta.json();
            console.log(data);

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
buscar();


btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-primary', buscarModal);