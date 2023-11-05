import Swal from "sweetalert2";
import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioSalidapaises');
const btnGuardar = document.getElementById('btnGuardar');


formulario.nombre.disabled = true;
formulario.nombre2.disabled = true;
btnGuardar.parentElement.style.display = 'block';

formulario.ste_cat.addEventListener('change', async (e) => {
    const solicitante = await buscarCatalogo();
    colocarCatalogo(solicitante);

});


    const buscarCatalogo = async () => {  
        
        let validarCatalogo = formulario.ste_cat.value;
    
    const url = `/soliciudes_e/API/salidapaises/buscarCatalogo?per_catalogo=${validarCatalogo}`;
    
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
    formulario.nombre.value = dato.nombre;
    formulario.ste_gra.value = dato.per_grado;
    formulario.ste_emp.value = dato.org_plaza_desc
    formulario.ste_comando.value = dato.dep_llave
}



formulario.aut_cat.addEventListener('change', async (e) => {
    const autorizador = await buscarCatalogo2();
    colocarCatalogo2(autorizador)
    
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

    const url = `/soliciudes_e/API/salidapaises/buscarCatalogo2?per_catalogo=${validarCatalogo2}`;


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
    formulario.aut_cat.value = dato.per_catalogo;
    formulario.aut_arm.value = dato.per_arma;
    formulario.nombre2.value = dato.nombres;
    formulario.aut_gra.value = dato.per_grado;
    formulario.aut_emp.value = dato.org_plaza_desc;
    formulario.aut_comando.value = dato.dep_llave

}



const guardar = async (evento) => {
    evento.preventDefault();
    let paisSeleccionado = formulario.dsal_pais.value;

    if (paisSeleccionado === 596 || paisSeleccionado === 504 || paisSeleccionado === 55 || paisSeleccionado === 506 || paisSeleccionado === 507) {
        formulario.sol_situacion.value = 6;
    } else {
        formulario.sol_situacion.value = 1;
    }
    
    const body = new FormData(formulario);
    const url = '/soliciudes_e/API/salidapaises/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        evento.preventDefault();
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
        return

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

