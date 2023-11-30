import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const modalC = new Modal(document.getElementById('modalC'), {
    backdrop: 'static',
    keyboard: false
})
const modalM = new Modal(document.getElementById('modalM'), {
    backdrop: 'static',
    keyboard: false
})
const dpi = document.getElementById('parejac1_dpi')
const fileInput = document.getElementById('pdf_ruta');
const formulario = document.getElementById('formularioMatrimonio');
const botonSlide2 = document.getElementById('botonSlide2');
const btnGuardar = document.getElementById('btnGuardar');
const divTabla = document.getElementById('tablaProtocolos');
const catalogo = document.getElementById('ste_cat');
const nombre = document.getElementById('nombre');
const grado = document.getElementById('ste_gra');
const arma = document.getElementById('ste_arm');
const empleo = document.getElementById('ste_emp');
const comando = document.getElementById('ste_comando');
const nombre2 = document.getElementById('nombre2');
const catalogo2 = document.getElementById('aut_cat');
const grado2 = document.getElementById('aut_gra');
const arma2 = document.getElementById('aut_arm');
const empleo2 = document.getElementById('aut_emp');
const comando2 = document.getElementById('aut_comando');
const checkboxCivil = document.getElementById('pareja_civil');
const checkboxMilitar = document.getElementById('pareja_militar');
const catalogo3 = document.getElementById('parejam1_cat');
const nombre3 = document.getElementById('nombre3');
const grado3 = document.getElementById('parejam1_gra');
const arma3 = document.getElementById('parejam1_arm');
const empleo3 = document.getElementById('parejam1_emp');
const comando3 = document.getElementById('parejam1_comando');
const catalogo4 = document.getElementById('parejam_cat');
const nombre4 = document.getElementById('nombre4');
const grado4 = document.getElementById('parejam_gra');
const arma4 = document.getElementById('parejam_arm');
const empleo4 = document.getElementById('parejam_emp');
const comando4 = document.getElementById('parejam_comando');
const nombreEsposaCivil = document.getElementById('parejac1_nombres');
const apellidoEsposaCivil = document.getElementById('parejac1_apellidos');
const direccionEsposaCivil = document.getElementById('parejac1_direccion');
const dpiEsposaCivil = document.getElementById('parejac1_dpi');
const nombreEsposaCivil2 = document.getElementById('parejac_nombres');
const apellidoEsposaCivil2 = document.getElementById('parejac_apellidos');
const direccionEsposaCivil2 = document.getElementById('parejac_direccion');
const dpiEsposaCivil2 = document.getElementById('parejac_dpi');
const btnAddEspMilitar = document.getElementById('buttonGuardar2');
const btnCancelModalM = document.getElementById('buttonCancelar2');
const btnAddEspCivil = document.getElementById('buttonGuardar1');
const btnCancelModalC = document.getElementById('buttonCancelar1');

const mensajesPersonalizados = {
    ste_cat: 'Ingrese el número de catálogo del solicitante',
    nombre: 'Ingrese el nombre y apellidos',
    ste_fecha: 'Ingrese la fecha de solicitud',
    ste_telefono: 'Ingrese el número telefónico del solicitante',
    sol_motivo: 'Seleccione el motivo de su solicitud',
    aut_cat: 'Ingrese el número de catálogo del autorizador',
    nombre2: 'Ingrese el nombre y apellidos del autorizador',
    aut_fecha: 'Ingrese la fecha de autorización',
    mat_lugar_civil: 'Ingrese la ubicación de la boda civil',
    mat_fecha_bodac: 'Ingrese la fecha de la boda civil',
    mat_lugar_religioso: 'Ingrese la ubicación de la boda religiosa',
    mat_fecha_bodar: 'Ingrese la fecha de la boda religiosa',
    mat_fecha_lic_ini: 'Ingrese la fecha de inicio de la licencia',
    mat_fecha_lic_fin: 'Ingrese la fecha de finalización de la licencia',
    pdf_ruta: 'Adjunte el documento PDF',
};

const validarFormularioMatrimonio = (formulario) => {
    const camposRequeridos = ['ste_cat', 'nombre', 'ste_fecha', 'ste_telefono', 'sol_motivo', 'aut_cat', 'nombre2', 'aut_fecha', 'mat_lugar_civil', 'mat_fecha_bodac', 'mat_lugar_religioso', 'mat_fecha_bodar', 'mat_fecha_lic_ini', 'mat_fecha_lic_fin', 'pdf_ruta'];

    for (const campo of camposRequeridos) {
        const input = formulario.querySelector(`[name="${campo}"]`);
        if (!input.value.trim()) {
            const mensaje = mensajesPersonalizados[campo] || `Ingrese datos en el campo ${campo.replace('_', ' ')}`;
            Toast.fire({
                icon: 'info',
                text: mensaje,
            });
            return false;
        }
    }

    return true;
};

nombre.disabled = true;
nombre2.disabled = true;
nombre3.disabled = true

checkboxCivil.addEventListener('change', () => {
    if (checkboxCivil.checked) {
        modalC.show()
        //modalC.style.display = 'block
        checkboxMilitar.disabled = true;
    } else {
        modalC.hide()
        //modalC.style.display = 'none';
        checkboxMilitar.disabled = false;
    }
});

checkboxMilitar.addEventListener('change', () => {
    if (checkboxMilitar.checked) {
        modalM.show()
        //modalM.style.display = 'block';
        checkboxCivil.disabled = true;
    } else {
        modalM.hide()
        //modalM.style.display = 'none';
        checkboxCivil.disabled = false;
    }
});
const verificarDPI = (e) => {
 
    let cui = dpi.value
    if (!cui) {
        // console.log("CUI vacío");
        Toast.fire({
            icon: 'warning',
            title: 'LLENE EL CAMPO DEL DPI'
        })
        return true;
    }

    var cuiRegExp = /^[0-9]{4}\s?[0-9]{5}\s?[0-9]{4}$/;

    if (!cuiRegExp.test(cui)) {
        // console.log("CUI con formato inválido");
        Toast.fire({
            icon: 'warning',
            title: 'DPI INCORRECTO'
        })
        formaltas.dpi.value = ""
        return false;
    }

    cui = cui.replace(/\s/, '');
    var depto = parseInt(cui.substring(9, 11), 10);
    var muni = parseInt(cui.substring(11, 13));
    var numero = cui.substring(0, 8);
    var verificador = parseInt(cui.substring(8, 9));

    // Se asume que la codificación de Municipios y 
    // departamentos es la misma que esta publicada en 
    // http://goo.gl/EsxN1a

    // Listado de municipios actualizado segun:
    // http://goo.gl/QLNglm

    // Este listado contiene la cantidad de municipios
    // existentes en cada departamento para poder 
    // determinar el código máximo aceptado por cada 
    // uno de los departamentos.
    var munisPorDepto = [
        /* 01 - Guatemala tiene:      */
        17 /* municipios. */ ,
        /* 02 - El Progreso tiene:    */
        8 /* municipios. */ ,
        /* 03 - Sacatepéquez tiene:   */
        16 /* municipios. */ ,
        /* 04 - Chimaltenango tiene:  */
        16 /* municipios. */ ,
        /* 05 - Escuintla tiene:      */
        13 /* municipios. */ ,
        /* 06 - Santa Rosa tiene:     */
        14 /* municipios. */ ,
        /* 07 - Sololá tiene:         */
        19 /* municipios. */ ,
        /* 08 - Totonicapán tiene:    */
        8 /* municipios. */ ,
        /* 09 - Quetzaltenango tiene: */
        24 /* municipios. */ ,
        /* 10 - Suchitepéquez tiene:  */
        21 /* municipios. */ ,
        /* 11 - Retalhuleu tiene:     */
        9 /* municipios. */ ,
        /* 12 - San Marcos tiene:     */
        30 /* municipios. */ ,
        /* 13 - Huehuetenango tiene:  */
        32 /* municipios. */ ,
        /* 14 - Quiché tiene:         */
        21 /* municipios. */ ,
        /* 15 - Baja Verapaz tiene:   */
        8 /* municipios. */ ,
        /* 16 - Alta Verapaz tiene:   */
        17 /* municipios. */ ,
        /* 17 - Petén tiene:          */
        14 /* municipios. */ ,
        /* 18 - Izabal tiene:         */
        5 /* municipios. */ ,
        /* 19 - Zacapa tiene:         */
        11 /* municipios. */ ,
        /* 20 - Chiquimula tiene:     */
        11 /* municipios. */ ,
        /* 21 - Jalapa tiene:         */
        7 /* municipios. */ ,
        /* 22 - Jutiapa tiene:        */
        17 /* municipios. */
    ];

    if (depto === 0 || muni === 0) {
        // console.log("CUI con código de municipio o departamento inválido.");
        Toast.fire({
            icon: 'warning',
            title: 'DPI INCORRECTO'
        })
        formaltas.dpi.value = ""
        return false;
    }

    if (depto > munisPorDepto.length) {
        // console.log("CUI con código de departamento inválido.");
        Toast.fire({
            icon: 'warning',
            title: 'DPI INCORRECTO'
        })
        formaltas.dpi.value = ""
        return false;
    }

    if (muni > munisPorDepto[depto - 1]) {
        // console.log("CUI con código de municipio inválido.");
        Toast.fire({
            icon: 'warning',
            title: 'DPI INCORRECTO'
        })
        formaltas.dpi.value = ""
        return false;
    }

    // Se verifica el correlativo con base 
    // en el algoritmo del complemento 11.
    var total = 0;

    for (var i = 0; i < numero.length; i++) {
        total += numero[i] * (i + 2);
    }

    var modulo = (total % 11);

    // console.log("CUI con módulo: " + modulo);
    // console.log("CUI con módulo: " + verificador);

    if (modulo !== verificador) {
        Toast.fire({
            icon: 'warning',
            title: 'DPI INCORRECTO'
        })
        formaltas.dpi.value = ""
        return false;

    }
}
const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormularioMatrimonio(formulario)) {
        return;
    }
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

    const body = new FormData(formulario);
    body.append('ste_fecha',formulario.ste_fecha.value)
    body.append('aut_fecha',formulario.aut_fecha.value)
    const url = '/soliciudes_e/API/casamientos/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        evento.preventDefault();
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();     
  
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
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
            text: mensaje
        });
    } catch (error) {
        console.log(error);
    }

    location.reload();

};

catalogo.addEventListener('change', async (e) => {
    const solicitante = await buscarCatalogo();
    colocarCatalogo(solicitante);

});


const buscarCatalogo = async () => {

    let validarCatalogo = catalogo.value;

    const url = `/soliciudes_e/API/casamientos/buscarCatalogo?per_catalogo=${validarCatalogo}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();


        if (data.length > 0) {
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

async function colocarCatalogo(datos) {
    const dato = datos[0]
    catalogo.value = dato.per_catalogo
    arma.value = dato.per_arma;
    nombre.value = dato.nombres;
    grado.value = dato.per_grado;
    empleo.value = dato.org_plaza_desc
    comando.value = dato.dep_llave


}

catalogo2.addEventListener('change', async (e) => {
    const autorizador = await buscarCatalogo2();
    colocarCatalogo2(autorizador);
});

document.addEventListener('DOMContentLoaded', async () => {
    const autorizador = await buscarCatalogo2();
    colocarCatalogo2(autorizador);
});

const buscarCatalogo2 = async () => {
    let validarCatalogo = catalogo.value
    let validarCatalogo2 = catalogo2.value;
    if (validarCatalogo === validarCatalogo2) {
        Toast.fire({
            icon: 'info',
            text: 'Los catalogos deben de ser distintos'
        });
        return;
    }

    const url = `/soliciudes_e/API/casamientos/buscarCatalogo2?per_catalogo=${validarCatalogo2}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();


        if (data.length > 0) {
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

async function colocarCatalogo2(datos) {

    const dato = datos[0]
    catalogo2.value = dato.per_catalogo
    arma2.value = dato.per_arma;
    nombre2.value = dato.nombres;
    grado2.value = dato.per_grado;
    empleo2.value = dato.org_plaza_desc
    comando2.value = dato.dep_llave

}

catalogo3.addEventListener('change', async (e) => {
    const pareja = await buscarCatalogo3();
    colocarCatalogo3(pareja);

});
async function agregarEsposaMilitar(datos) {

    const valores = datos[0]
    catalogo4.value = valores.per_catalogo
    arma4.value = valores.per_arma
    nombre4.value = valores.nombres
    grado4.value = valores.per_grado
    empleo4.value = valores.org_plaza_desc
    comando4.value = valores.dep_llave
    modalM.hide()

}


const buscarCatalogo3 = async () => {

    let validarCatalogo3 = catalogo3.value;

    const url = `/soliciudes_e/API/casamientos/buscarCatalogo3?per_catalogo=${validarCatalogo3}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        if (data.length > 0) {
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

async function colocarCatalogo3(datos) {

    const dato = datos[0]
    catalogo3.value = dato.per_catalogo
    arma3.value = dato.per_arma;
    nombre3.value = dato.nombres;
    grado3.value = dato.per_grado;
    empleo3.value = dato.org_plaza_desc
    comando3.value = dato.dep_llave

}


const limpiarModelM = async () => {
    catalogo3.value = ''
    arma3.value = ''
    nombre3.value = ''
    grado3.value = ''
    empleo3.value = ''
    comando3.value = ''
    checkboxCivil.disabled = false;
    checkboxMilitar.checked = false;
    modalM.hide()
}

const limpiarModelC = async () => {
    nombreEsposaCivil.value = '';
    apellidoEsposaCivil.value = '';
    direccionEsposaCivil.value = '';
    dpiEsposaCivil.value = '';
    checkboxCivil.disabled = false;
    checkboxMilitar.checked = false;
    modalC.hide()
}
const agregarEsposaCivil = async (value) => {

    let nombre = nombreEsposaCivil.value;
    let apellido = apellidoEsposaCivil.value;
    let direccion = direccionEsposaCivil.value;
    let dpi = dpiEsposaCivil.value;

    nombreEsposaCivil2.value = nombre;
    apellidoEsposaCivil2.value = apellido;
    direccionEsposaCivil2.value = direccion;
    dpiEsposaCivil2.value = dpi;

    modalC.hide()

}

btnAddEspMilitar.addEventListener('click', async (e) => {
    const pareja = await buscarCatalogo3();
    agregarEsposaMilitar(pareja);
});

btnAddEspCivil.addEventListener('click', agregarEsposaCivil)
btnCancelModalC.addEventListener('click', limpiarModelC)
btnCancelModalM.addEventListener('click', limpiarModelM);
btnGuardar.addEventListener('click', guardar);
dpi.addEventListener("change", verificarDPI);

