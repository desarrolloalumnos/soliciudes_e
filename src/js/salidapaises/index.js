import Swal from "sweetalert2";
import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const mensajesPersonalizados = {
    ste_cat: 'Ingrese el número de catálogo',
    nombre: 'Ingrese el nombre y apellidos',
    ste_fecha: 'Ingrese la fecha de solicitud',
    ste_telefono: 'Ingrese el número telefónico',
    sol_motivo: 'Seleccione el motivo',
    aut_cat: 'Ingrese el número de catálogo del autorizador',
    nombre2: 'Ingrese el nombre y apellidos del autorizador',
    aut_fecha: 'Ingrese la fecha de autorización',
    sal_salida: 'Ingrese la fecha de salida del pais',
    sal_ingreso: 'Ingrese la fecha de ingreso del pais',
    dsal_pais: 'Seleccione el país a visitar',
    dsal_transporte: 'Seleccione el transporte',
    dsal_ciudad: 'Ingrese la ciudad del país a visitar',
    pdf_ruta: 'Adjunte el documento PDF',
    
};

// Función para validar el formulario
const validarFormularioSalidaPaises = (formulario) => {
    const camposRequeridos = ['ste_cat', 'nombre', 'ste_fecha', 'ste_telefono', 'sol_motivo', 'aut_cat', 'nombre2', 'aut_fecha', 'sal_salida', 'sal_ingreso','pdf_ruta'];
    
    const camposSalidaPaises = ['dsal_pais', 'dsal_transporte', 'dsal_ciudad'];

    for (const campo of camposRequeridos) {
        const esCampoSalidaPaises = camposSalidaPaises.includes(campo);
        const selector = esCampoSalidaPaises ? `[name="${campo}[]"]` : `[name="${campo}"]`;
        const input = formulario.querySelector(selector);
    
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


const formulario = document.getElementById('formularioSalidapaises');
const btnGuardar = document.getElementById('btnGuardar');
const btnClearPais = document.getElementById('clearPais');
const divAddPaises = document.getElementById('seleccion');
const btnAddPais = document.getElementById('addPais');


formulario.nombre.disabled = true;
formulario.nombre2.disabled = true;
btnGuardar.parentElement.style.display = 'block';


window.eliminarDiv = (e) => {
    const $element = e.target.closest('.row');
    if ($element) {
        $element.remove();
    }
}

let counter = 1;
const uniqueId = `eliminarDiv_${counter++}`;

const templateElement = (paises,transportes) => {
       
    return `
        <div class="row justify-content-around mb-4">
            <div id="${uniqueId}" class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 mb-3">                        
                        <label for="dsal_pais" class="form-label"><i class="bi bi-globe-americas"></i>Seleccione el país a viajar:</label>
                        <select name="dsal_pais []" id="dsal_pais"class="form-select">
                            <option value="">Seleccione el país</option>
                            ${paises.map(pais => `<option value="${pais.pai_codigo}">${pais.pai_desc_lg}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="dsal_transporte" class="form-label"><i class="bi bi-airplane-fill"></i>Seleccione el transporte:</label>
                        <select name="dsal_transporte []" id="dsal_transporte" class="form-select">
                            <option value="">Seleccione el transporte</option>
                            ${transportes.map(transporte => `<option value="${transporte.transporte_id}">${transporte.transporte_descripcion}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="dsal_ciudad"><i class="bi bi-file-image-fill"></i>Ciudad del país a visitar</label>
                        <input value="" id="dsal_ciudad" name="dsal_ciudad []" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="control">
                    <button type="button" class="btn btn-danger" onclick="eliminarDiv(event)">X</button>
                </div>
            </div>
        </div>
    `;
    
};

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
    if (!validarFormularioSalidaPaises(formulario)) {
        return;
    }
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

const agregaDiv = async(evento) =>{
    evento.preventDefault();
    const $div = document.createElement("div");
    $div.innerHTML = templateElement(paisesData, transporteData);
    divAddPaises.appendChild($div);
}
btnGuardar.addEventListener('click', guardar);
btnAddPais.addEventListener("click", agregaDiv);

