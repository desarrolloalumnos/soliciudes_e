import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatearFecha } from "../funciones";

const modalM = new Modal(document.getElementById('modalM'), {})
const formulario = document.getElementById('formularioMatrimonio');
const formulario2 = document.getElementById('formularioCasamiento');
const idPareja = document.getElementById('parejac_id')
const nombrePareja = document.getElementById('nombre')
const btnModificar =  document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');
const btnBuscar = document.getElementById('btnBuscar');

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
            title: 'mat_autorizacion',
            className: 'text-center',
            data: 'mat_autorizacion'
        },
        {
            title: 'aut_id',
            className: 'text-center',
            data: 'aut_id'
        },
        {
            title: 'aut_solicitud',
            className: 'text-center',
            data: 'aut_solicitud'
        },
        {
            title: 'sol_id',
            className: 'text-center',
            data: 'sol_id'
        },
        {
            title: 'sol_tipo',
            className: 'text-center',
            data: 'sol_tipo'
        },
        {
            title: 'tse_id',
            className: 'text-center',
            data: 'tse_id'
        },
        {
            title: 'sol_solicitante',
            className: 'text-center',
            data: 'sol_solicitante'
        },
        {
            title: 'ste_id',
            className: 'text-center',
            data: 'ste_id'
        },
        {
            title: 'ste_comando',
            className: 'text-center',
            data: 'ste_comando'
        },
        {
            title: 'ste_cat',
            className: 'text-center',
            data: 'ste_cat'
        },
        {
            title: 'ste_gra',
            className: 'text-center',
            data: 'ste_gra'
        },
        {
            title: 'ste_arm',
            className: 'text-center',
            data: 'ste_arm'
        },
        {
            title: 'ste_emp',
            className: 'text-center',
            data: 'ste_emp'
        },
        {
            title: 'ste_fecha',
            className: 'text-center',
            data: 'ste_fecha'
        },
        {
            title: 'sol_obs',
            className: 'text-center',
            data: 'sol_obs'
        },
        {
            title: 'sol_motivo',
            className: 'text-center',
            data: 'sol_motivo'
        },
        {
            title: 'mot_id',
            className: 'text-center',
            data: 'mot_id'
        },
        {
            title: 'sol_situacion',
            className: 'text-center',
            data: 'sol_situacion'
        },
        {
            title: 'aut_comando',
            className: 'text-center',
            data: 'aut_comando'
        },
        {
            title: 'aut_cat',
            className: 'text-center',
            data: 'aut_cat'
        },
        {
            title: 'aut_gra',
            className: 'text-center',
            data: 'aut_gra'
        },
        {
            title: 'aut_arm',
            className: 'text-center',
            data: 'aut_arm'
        },
        {
            title: 'aut_emp',
            className: 'text-center',
            data: 'aut_emp'
        },
        {
            title: 'aut_fecha',
            className: 'text-center',
            data: 'aut_fecha'
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
            title: 'mat_per_civil',
            className: 'text-center',
            data: 'mat_per_civil'
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
            title: 'mat_per_army',
            className: 'text-center',
            data: 'mat_per_army'
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
            title: 'parejam_comando',
            className: 'text-center',
            data: 'parejam_comando'
        },
        {
            title: 'parejam_gra',
            className: 'text-center',
            data: 'parejam_gra'
        },
        {
            title: 'parejam_arm',
            className: 'text-center',
            data: 'parejam_arm'
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
            title: 'mat_situacion',
            className: 'text-center',
            data: 'mat_situacion'
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
            visible:false
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
            title: 'MODIFICAR',
            className: 'text-center',
            data: 'mat_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-mat_autorizacion='${row["mat_autorizacion"]}'data-aut_id='${row["aut_id"]}' data-aut_solicitud ='${row["aut_solicitud"]}' data-sol_id ='${row["sol_id"]}'data-sol_tipo ='${row["sol_tipo"]}'data-tse_id ='${row["tse_id"]}'data-sol_solicitante ='${row["sol_solicitante"]}'data-ste_id ='${row["ste_id"]}'data-ste_comando ='${row["ste_comando"]}'data-ste_cat ='${row["ste_cat"]}'data-ste_gra ='${row["ste_gra"]}'data-ste_arm ='${row["ste_arm"]}'data-ste_emp ='${row["ste_emp"]}'data-ste_fecha ='${row["ste_fecha"]}'data-sol_obs ='${row["sol_obs"]}'data-sol_motivo ='${row["sol_motivo"]}'data-mot_id ='${row["mot_id"]}'data-sol_situacion ='${row["sol_situacion"]}'data-aut_comando ='${row["aut_comando"]}'data-aut_cat ='${row["aut_cat"]}'data-aut_gra ='${row["aut_gra"]}'data-aut_arm ='${row["aut_arm"]}'data-aut_emp ='${row["aut_emp"]}'data-aut_fecha ='${row["aut_fecha"]}'data-mat_lugar_civil ='${row["mat_lugar_civil"]}'data-mat_fecha_bodac ='${row["mat_fecha_bodac"]}'data-mat_lugar_religioso ='${row["mat_lugar_religioso"]}'data-mat_fecha_bodar ='${row["mat_fecha_bodar"]}'data-mat_per_civil ='${row["mat_per_civil"]}'data-parejac_id ='${row["parejac_id"]}'data-parejac_direccion ='${row["parejac_direccion"]}'data-parejac_dpi ='${row["parejac_dpi"]}'data-mat_per_army ='${row["mat_per_army"]}'data-parejam_id ='${row["parejam_id"]}'data-parejam_cat ='${row["parejam_cat"]}'data-parejam_comando ='${row["parejam_comando"]}'data-parejam_gra ='${row["parejam_gra"]}'data-parejam_arm ='${row["parejam_arm"]}'data-pdf_id ='${row["pdf_id"]}'data-pdf_solicitud ='${row["pdf_solicitud"]}'data-mat_situacion ='${row["mat_situacion"]}'data-grado_solicitante ='${row["grado_solicitante"]}'
                                                data-nombres_solicitante ='${row["nombres_solicitante"]}'data-nombres ='${row["nombres"]}'data-grado_pareja ='${row["grado_pareja"]}'data-nombres_pareja ='${row["nombres_pareja"]}'data-mat_fecha_lic_ini ='${row["mat_fecha_lic_ini"]}'data-mat_fecha_lic_fin ='${row["mat_fecha_lic_fin"]}'data-ste_telefono ='${row["ste_telefono"]}'data-pdf_ruta ='${row["pdf_ruta"]}'>Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            className: 'text-center',
            data: '',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
    columnDefs: [
        {
            targets: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41],
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
    const mat_autorizacion = button.dataset.mat_autorizacion
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
    const mat_lugar_civil = button.dataset.mat_lugar_civil
    const mat_fecha_bodac = button.dataset.mat_fecha_bodac
    const mat_lugar_religioso = button.dataset.mat_lugar_religioso
    const mat_fecha_bodar = button.dataset.mat_fecha_bodar
    const mat_per_civil = button.dataset.mat_per_civil
    const parejac_id = button.dataset.parejac_id
    const parejac_direccion = button.dataset.parejac_direccion
    const parejac_dpi = button.dataset.parejac_dpi
    const mat_per_army = button.dataset.mat_per_army
    const parejam_id = button.dataset.parejam_id
    const parejam_cat = button.dataset.parejam_cat
    const parejam_comando = button.dataset.parejam_comando
    const parejam_gra = button.dataset.parejam_gra
    const parejam_arm = button.dataset.parejam_arm
    const pdf_id = button.dataset.pdf_id
    const pdf_solicitud = button.dataset.pdf_solicitud
    const mat_situacion = button.dataset.mat_situacion
    const grado_solicitante = button.dataset.grado_solicitante
    const nombres_solicitante = button.dataset.nombres_solicitante
    const nombres = button.dataset.nombres
    const grado_pareja = button.dataset.grado_pareja
    const nombres_pareja = button.dataset.nombres_pareja
    const mat_fecha_lic_ini = button.dataset.mat_fecha_lic_ini
    const mat_fecha_lic_fin = button.dataset.mat_fecha_lic_fin
    const ste_telefono = button.dataset.ste_telefono
    const pdf_ruta = button.dataset.pdf_ruta

    const dataset = {

        mat_id,
        mat_autorizacion,
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
        parejam_comando,
        parejam_gra,
        parejam_arm,
        pdf_id,
        pdf_solicitud,
        mat_situacion,
        grado_solicitante,
        nombres_solicitante,
        nombres,
        grado_pareja,
        nombres_pareja,
        mat_fecha_lic_ini,
        mat_fecha_lic_fin,
        ste_telefono,
        pdf_ruta

    };

    colocarDatos(dataset);


};

const colocarDatos = (dataset) => {
    //se formatean las fechas para colacarlas en el formulario
    let inicioLicencia = dataset.mat_fecha_lic_ini;
    const mat_fecha_lic_ini = formatearFecha(inicioLicencia);
    
    let finLicencia = dataset.mat_fecha_lic_fin;
    const mat_fecha_lic_fin = formatearFecha(finLicencia);

    let fechaSolicitante = dataset.ste_fecha;
    const ste_fecha = formatearFecha(fechaSolicitante);
    
    let fechaAutorizacion = dataset.aut_fecha;
    const aut_fecha = formatearFecha(fechaAutorizacion);

    let fechaBodaCivil = dataset.mat_fecha_bodac;
    const mat_fecha_bodac = formatearFecha(fechaBodaCivil);

    let fechaBodaReligiosa = dataset.mat_fecha_bodar;
    const mat_fecha_bodar = formatearFecha(fechaBodaReligiosa);

    const partes = dataset.nombres.split(' ');
    const maxNombres = 2;
    const maxApellidos = 2;
    const nombres = [];
    const apellidos = [];
    for (let i = 0; i < partes.length; i++) {
    if (i < maxNombres) {
        nombres.push(partes[i]);
    } else if (i < maxNombres + maxApellidos) {
        apellidos.push(partes[i]);
    }
    }


    
    formulario2.mat_fecha_bodac.value = mat_fecha_bodac
    formulario2.mat_fecha_bodar.value = mat_fecha_bodar
    formulario2.mat_fecha_lic_ini.value = mat_fecha_lic_ini;
    formulario2.mat_fecha_lic_fin.value = mat_fecha_lic_fin
    formulario2.aut_fecha.value = aut_fecha;
    formulario2.ste_fecha.value = ste_fecha
    formulario2.sol_id.value = dataset.sol_id
    formulario2.sol_tipo.value = dataset.sol_tipo
    formulario2.tse_id.value = dataset.tse_id
    formulario2.sol_solicitante.value = dataset.sol_solicitante
    formulario2.ste_id.value = dataset.ste_id
    formulario2.ste_comando.value = dataset.ste_comando
    formulario2.ste_cat.value = dataset.ste_cat
    formulario2.ste_gra.value = dataset.ste_gra
    formulario2.ste_arm.value = dataset.ste_arm
    formulario2.ste_emp.value = dataset.ste_emp
    formulario2.sol_obs.value = dataset.sol_obs
    formulario2.sol_motivo.value = dataset.sol_motivo
    formulario2.mat_id.value = dataset.mat_id
    // formulario2.sol_situacion.value = dataset.sol_situacion
    formulario2.aut_comando.value = dataset.aut_comando;
    formulario2.aut_id.value = dataset.aut_id;
    formulario2.aut_solicitud.value = dataset.aut_solicitud;
    formulario2.aut_cat.value = dataset.aut_cat;
    formulario2.aut_gra.value = dataset.aut_gra;
    formulario2.aut_arm.value = dataset.aut_arm;
    formulario2.aut_emp.value = dataset.aut_emp;
    formulario2.mat_id.value = dataset.mat_id
    formulario2.mat_per_army.value = dataset.mat_per_army
    formulario2.mat_autorizacion.value = dataset.mat_autorizacion;
    formulario2.mat_lugar_civil.value = dataset.mat_lugar_civil
    formulario2.mat_lugar_religioso.value = dataset.mat_lugar_religioso
    formulario2.mat_per_civil.value = dataset.mat_per_civil
    formulario2.parejac_nombres.value = nombres.join(' '); 
    formulario2.parejac_apellidos.value = apellidos.join(' ');   
    
    idPareja.value = dataset.parejac_id
    formulario2.parejac_direccion.value = dataset.parejac_direccion
    formulario2.parejac_dpi.value = dataset.parejac_dpi
    formulario2.parejam_id.value = dataset.parejam_id
    formulario2.parejam_cat.value = dataset.parejam_cat
    formulario2.parejam_comando.value = dataset.parejam_comando
    formulario2.parejam_gra.value = dataset.parejam_gra
    formulario2.parejam_arm.value = dataset.parejam_arm
    formulario2.ste_telefono.value = dataset.ste_telefono
    // formulario2.pdf_id.value = dataset.pdf_id
    // formulario2.pdf_solicitud.value = dataset.pdf_solicitud
    // formulario2.mat_situacion.value = dataset.mat_situacion
    formulario2.nombre.value = dataset.nombres_solicitante
    // formulario2.grado_pareja.value = dataset.grado_pareja
    // formulario2.pdf_ruta.value = dataset.pdf_ruta


}


const limpiarModelM = async () => {
    modalM.hide()
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
        body.append('cmv_id', id)
        const url = '/soliciudes_e/API/protocolos/eliminar';
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

window.open(`/soliciudes_e/API/busquedasc/pdf?ruta=${pdf}`)
 
}
buscar();

btnBuscar.addEventListener('click', buscar);
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', limpiarModelM )
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-outline-info', verPDF);
