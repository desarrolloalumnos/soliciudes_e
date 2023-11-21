import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioProtocolo');
const btnGuardar = document.getElementById('btnGuardar');


const catalogo = document.getElementById('ste_cat')
const nombre = document.getElementById('nombre');
const grado = document.getElementById('ste_gra');
const arma = document.getElementById('ste_arm');
const empleo = document.getElementById('ste_emp');
const comando = document.getElementById('ste_comando');
const observaciones = document.getElementById('sol_obs');
const motivos = document.getElementById('sol_motivo');
const nombre2 = document.getElementById('nombre2');
const catalogo2 = document.getElementById('aut_cat');
const grado2 = document.getElementById('aut_gra');
const arma2 = document.getElementById('aut_arm');
const empleo2 = document.getElementById('aut_emp');
const comando2 = document.getElementById('aut_comando');



// motivos.disabled = true;
nombre.disabled = true;
nombre2.disabled = true;
observaciones.disabled = true;
btnGuardar.parentElement.style.display = 'block';


const guardar = async (evento) => {
    evento.preventDefault();
    let ruta = formulario.pdf_ruta.value
    const body = new FormData(formulario);
    body.append('pdf_ruta',ruta)
    const url = '/soliciudes_e/API/protocolosol/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        evento.preventDefault();
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        // console.log(data);
        // return
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

    // location.reload();

};

catalogo.addEventListener('change', async (e) => {
const solicitante = await buscarCatalogo();
colocarCatalogo(solicitante);

});


const buscarCatalogo = async () => {

let validarCatalogo = catalogo.value;

const url = `/soliciudes_e/API/protocolosol/buscarCatalogo?per_catalogo=${validarCatalogo}`;


const config = {
    method: 'GET',
}

try {
    const respuesta = await fetch(url, config)
    const data = await respuesta.json();

    console.log(data);

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
console.log(dato);
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

const url = `/soliciudes_e/API/protocolosol/buscarCatalogo?per_catalogo=${validarCatalogo2}`;


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


btnGuardar.addEventListener('click', guardar)

        
       
