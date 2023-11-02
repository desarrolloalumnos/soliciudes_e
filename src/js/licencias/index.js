import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioLicencias');
const btnGuardar = document.getElementById('btnGuardar');

formulario.tiempo_servicio.disabled = true;
formulario.nombre.disabled = true;
formulario.nombre2.disabled = true;
btnGuardar.parentElement.style.display = 'block';


formulario.ste_cat.addEventListener('change', async (e) => {
    const solicitante = await buscarCatalogo();
    const tiempo = await buscarTiempo();
    colocarCatalogo(solicitante);
    colocarTiempo(tiempo)

});
const buscarTiempo = async () => {

    let validarCatalogo = formulario.ste_cat.value;

    const url = `/soliciudes_e/API/licencias/buscarTiempo?t_catalogo=${validarCatalogo}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        const dato = data[0];
        const numero = dato.t_oficial;
        const rusultado = await formatoTiempo(numero);
        formulario.tiempo_servicio.value = rusultado

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
    formulario.ste_cat.value = dato.per_catalogo
    formulario.ste_arm.value = dato.per_arma;
    formulario.nombre.value = dato.nombres;
    formulario.ste_gra.value = dato.per_grado;
    formulario.ste_emp.value = dato.org_plaza_desc
    formulario.ste_comando.value = dato.dep_llave
}
async function formatoTiempo(numero) {
    return new Promise((resolve) => {
        const numeroStr = String(numero);
        const anios = numeroStr.slice(0, -4);
        const meses = numeroStr.slice(-4, -2);
        const dias = numeroStr.slice(-2);

        const aniosTexto = anios + (anios === '1' ? ' año' : ' años');
        const mesesTexto = meses + ' meses';
        const diasTexto = dias + ' días';

        const resultado = `${aniosTexto} ${mesesTexto} ${diasTexto}`;

        resolve(resultado);
    });
}

async function colocarTiempo(datos) {
    formulario.lit_mes_sinsueldo.value = ''
    formulario.lit_mes_consueldo.value =''
    const dato = datos[0];
    const numero = dato.t_oficial;
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
    }else{
        return
    }
}




    formulario.aut_cat.addEventListener('change', async (e) => {
        const autorizador = await buscarCatalogo2();
        colocarCatalogo2(autorizador);

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
        formulario.aut_cat.value = dato.per_catalogo
        formulario.aut_arm.value = dato.per_arma;
        formulario.nombre2.value = dato.nombres;
        formulario.aut_gra.value = dato.per_grado;
        formulario.aut_emp.value = dato.org_plaza_desc
        formulario.aut_comando.value = dato.dep_llave

    }

    const guardar = async (evento) => {
        evento.preventDefault();
    
        const body = new FormData(formulario);
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
    

