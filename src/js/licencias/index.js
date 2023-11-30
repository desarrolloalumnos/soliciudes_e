import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion, formatoTiempo } from "../funciones";
const formulario = document.getElementById('formularioLicencias');
const btnGuardar = document.getElementById('btnGuardar');

formulario.tiempo_servicio.disabled = true;
formulario.nombre.disabled = true;
formulario.nombre2.disabled = true;
btnGuardar.parentElement.style.display = 'block';

const mensajesPersonalizados = {
    ste_cat: 'Ingrese el número de catálogo del solicitante',
    nombre: 'Ingrese el nombre y apellidos',
    ste_fecha: 'Ingrese la fecha de solicitud',
    ste_telefono: 'Ingrese el número telefónico del solicitante',
    sol_motivo: 'Seleccione el motivo de su solicitud',
    aut_cat: 'Ingrese el número de catálogo del autorizador',
    nombre2: 'Ingrese el nombre y apellidos del autorizador',
    aut_fecha: 'Ingrese la fecha de autorización',
    lit_mes_consueldo: 'Seleccione la cantidad de meses con sueldo',
    lit_mes_sinsueldo: 'Seleccione la cantidad de meses sin sueldo',
    lit_fecha1: 'Ingrese la fecha de inicio de la licencia',
    lit_fecha2: 'Ingrese la fecha de finalización de la licencia',
    lit_articulo: 'Ingrese el articulo',
    pdf_ruta: 'Adjunte el documento PDF',
};

const validarFormularioLicencia = (formulario) => {
    const camposRequeridos = ['ste_cat', 'nombre', 'ste_fecha', 'ste_telefono', 'sol_motivo', 'aut_cat', 'nombre2', 'aut_fecha', 'lit_mes_consueldo', 'lit_mes_sinsueldo', 'lit_fecha1', 'lit_fecha2', 'lit_articulo', 'pdf_ruta'];

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



formulario.ste_cat.addEventListener('change', async (e) => {
    buscarCatalogo();
    buscarTiempo();


});

const buscarTiempo = async () => {

    formulario.lit_mes_sinsueldo.value = ''
    formulario.lit_mes_consueldo.value = ''
    let validarCatalogo = formulario.ste_cat.value;

    const url = `/soliciudes_e/API/licencias/buscarTiempo?t_catalogo=${validarCatalogo}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        if (data.length > 0) {
            const dato = data[0]
            const numero = dato.t_oficial;
            formulario.tiempo.value = dato.t_oficial
            formatoTiempo(numero).then((tiempoFormateado) => {
                formulario.tiempo_servicio.value = tiempoFormateado;
            })
            const numeroEntero = parseInt(numero, 10);
            if (numeroEntero >= 10000 && numeroEntero <= 50000) {
                formulario.lit_mes_consueldo.setAttribute('max', '0');
                formulario.lit_mes_sinsueldo.setAttribute('max', '3');
                formulario.lit_articulo.value = '2'
            } else if (numeroEntero >= 50001 && numeroEntero <= 100000) {
                formulario.lit_mes_consueldo.setAttribute('max', '0');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '3'
            } else if (numeroEntero >= 100001 && numeroEntero <= 200000) {
                formulario.lit_mes_consueldo.setAttribute('max', '1');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '4'
            } else if (numeroEntero >= 200001 && numeroEntero <= 280000) {
                formulario.lit_mes_consueldo.setAttribute('max', '2');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '5'
            } else if (numeroEntero >= 280001 && numeroEntero <= 330000) {
                formulario.lit_mes_consueldo.setAttribute('max', '1');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '6'
            } else if (numeroEntero >= 33001) {
                formulario.lit_mes_consueldo.setAttribute('max', '2');
                formulario.lit_mes_sinsueldo.setAttribute('max', '6');
                formulario.lit_articulo.value = '6'
            } else {
                return
            }
        }

        return data;
    } catch (error) {
        console.log(error);
    }


}


const buscarCatalogo = async () => {

    let validarCatalogo = formulario.ste_cat.value;

    const url = `/soliciudes_e/API/licencias/buscarCatalogo?per_catalogo=${validarCatalogo}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        if (data.length > 0) {
            const dato = data[0]
            formulario.ste_cat.value = dato.per_catalogo
            formulario.ste_arm.value = dato.per_arma;
            formulario.nombre.value = dato.nombres;
            formulario.ste_gra.value = dato.per_grado;
            formulario.ste_emp.value = dato.org_plaza_desc
            formulario.ste_comando.value = dato.dep_llave


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


formulario.aut_cat.addEventListener('change', async (e) => {
   buscarCatalogo2();
});



const buscarCatalogo2 = async () => {
    let validarCatalogo = formulario.ste_cat.value
    let validarCatalogo2 = formulario.aut_cat.value;
    if (validarCatalogo === validarCatalogo2) {
        Toast.fire({
            icon: 'info',
            text: 'Los catalogos deben de ser distintos'
        });
        return;
    }
    
    const url = `/soliciudes_e/API/licencias/buscarCatalogo2?per_catalogo=${validarCatalogo2}`;
    
    
    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        
        
        if (data.length > 0) {
            const dato = data[0]
            formulario.aut_cat.value = dato.per_catalogo
            formulario.aut_arm.value = dato.per_arma;
            formulario.nombre2.value = dato.nombres;
            formulario.aut_gra.value = dato.per_grado;
            formulario.aut_emp.value = dato.org_plaza_desc
            formulario.aut_comando.value = dato.dep_llave
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

document.addEventListener('DOMContentLoaded', async () => {
    const autorizador = await buscarCatalogo2();
    colocarCatalogo2(autorizador);
});


const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormularioLicencia(formulario)) {
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

    let tiempo = formulario.tiempo_servicio.value
    const body = new FormData(formulario);
    body.append('tiempo_servicio', tiempo)
    body.append('ste_fecha',formulario.ste_fecha.value)
    body.append('aut_fecha',formulario.aut_fecha.value)
    const url = '/soliciudes_e/API/licencias/guardar';
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



btnGuardar.addEventListener('click', guardar);


