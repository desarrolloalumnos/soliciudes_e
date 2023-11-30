import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const mensajesPersonalizados = {
    ste_cat: 'Ingrese el número de catálogo del solicitante',
    nombre: 'Ingrese el nombre y apellidos',
    ste_fecha: 'Ingrese la fecha de solicitud',
    ste_telefono: 'Ingrese el número telefónico del solicitante',
    sol_motivo: 'Seleccione el motivo de su solicitud',
    aut_cat: 'Ingrese el número de catálogo del autorizador',
    nombre2: 'Ingrese el nombre y apellidos del autorizador',
    aut_fecha: 'Ingrese la fecha de autorización',
    pco_cmbv: 'Seleccione el combo o banda musical, marimba o valla',
    pco_just: 'Ingrese la justificación de la actividad',
    pco_fechainicio: 'Ingrese la fecha de inicio de la actividad',
    pco_fechafin: 'Ingrese la fecha de finalización de la actividad',
    pco_dir: 'Ingrese la dirección de la actividad',
    pdf_ruta: 'Adjunte el documento PDF',
};

const validarFormularioProtocolo = (formulario) => {
    const camposRequeridos = ['ste_cat', 'nombre', 'ste_fecha', 'ste_telefono', 'sol_motivo', 'aut_cat', 'nombre2', 'aut_fecha', 'pco_cmbv', 'pco_just', 'pco_fechainicio', 'pco_fechafin', 'pco_dir', 'pdf_ruta'];

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
    if (!validarFormularioProtocolo(formulario)) {
        return;
    }
    const fileInput = document.getElementById('pdf_ruta');
    const file = fileInput.files[0];
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

    let ruta = formulario.pdf_ruta.value
    const body = new FormData(formulario);


    body.append('pdf_ruta',ruta)
    body.append('ste_fecha',formulario.ste_fecha.value)
    body.append('aut_fecha',formulario.aut_fecha.value)
    
    const url = '/soliciudes_e/API/protocolosol/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        evento.preventDefault();
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
       
        // return
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
console.log(dato[0]);
catalogo2.value = dato.per_catalogo
arma2.value = dato.per_arma;
nombre2.value = dato.nombres;
grado2.value = dato.per_grado;
empleo2.value = dato.org_plaza_desc
comando2.value = dato.dep_llave

}

document.addEventListener('DOMContentLoaded', async () => {
    const autorizador = await buscarCatalogo2();
    colocarCatalogo2(autorizador);
});


btnGuardar.addEventListener('click', guardar)

        
       
