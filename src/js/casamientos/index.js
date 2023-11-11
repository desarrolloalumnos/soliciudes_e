import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

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
const modalC = new Modal(document.getElementById('modalC'), {})
const modalM = new Modal(document.getElementById('modalM'), {})
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

const guardar = async (evento) => {
    evento.preventDefault();

    const body = new FormData(formulario);
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

