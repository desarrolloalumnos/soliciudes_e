import Swal from "sweetalert2";
import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMatrimonio');
const botonSlide2 = document.getElementById('botonSlide2');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('tablaProtocolos');
const catalogo = document.getElementById('ste_cat');
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
const modalC = document.getElementById('modalC');
const modalM = document.getElementById('modalM');
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
const idEsposaCivilSol = document.getElementById('pareja_civil')
const botonGuardar2 = document.getElementById('buttonGuardar2');
const botonCancelar2 = document.getElementById('buttonCancelar2');



motivos.disabled = true;
nombre.disabled = true;
nombre2.disabled = true;
nombre3.disabled = true
observaciones.disabled = true;
btnGuardar.parentElement.style.display = 'block';
btnBuscar.parentElement.style.display = 'block';
btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
// botonSlide2.disabled = true;




checkboxCivil.addEventListener('change', () => {
    if (checkboxCivil.checked) {
        modalC.classList.add('show');
        modalC.style.display = 'block';
        checkboxMilitar.disabled = true;
    } else {
        modalC.classList.remove('show');
        modalC.style.display = 'none';
        checkboxMilitar.disabled = false;
    }
});

checkboxMilitar.addEventListener('change', () => {
    if (checkboxMilitar.checked) {
        modalM.classList.add('show');
        modalM.style.display = 'block';
        checkboxCivil.disabled = true;
    } else {
        modalM.classList.remove('show');
        modalM.style.display = 'none';
        checkboxCivil.disabled = false;
    }
});

const guardar = async (evento) => {
    evento.preventDefault();


    if (!validarFormulario(formulario, ['cmv_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los campos'
        });
        return;
    }
    let nombreesposa = nombreEsposaCivil.value
    const body = new FormData(formulario);
    body.append('nombreesposa', nombreesposa )
    const url = '/soliciudes_e/API/protocolos/guardar';
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

// motivos.addEventListener('change', () => {
//     let motivo = motivos.value;

//     if (motivo === "7") {
//         observaciones.disabled = false;
//     } else {
//         observaciones.disabled = true;
//     }
// });


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
    arma2.value = dato.per_arma;
    nombre2.value = dato.nombres;
    grado2.value = dato.per_grado;
    empleo2.value = dato.org_plaza_desc
    comando2.value = dato.dep_llave
    const nombres1 = nombre.value;
    const nombres2 = nombre2.value;
    if (nombres1 === '' && nombres2 === '') {
        botonSlide2.disabled = true;
    } else {
        botonSlide2.disabled = false;
    }


}

catalogo3.addEventListener('change', async (e) => {
    const pareja = await buscarCatalogo3();
    colocarCatalogo3(pareja);

});


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
    arma3.value = dato.per_arma;
    nombre3.value = dato.nombres;
    grado3.value = dato.per_grado;
    empleo3.value = dato.org_plaza_desc
    comando3.value = dato.dep_llave
    
    agregarEsposaCivil(datos)
 }

const agregarEsposaCivil = async (datos) => {
    modalM.classList.remove('show');
    const valores = datos[0]
    console.log(valores)
    arma4.value = arma3.valores
    nombre4.value = nombre3.
    grado4.value = grado3.value
    empleo4.value = empleo3.value
    comando4.value = comando3.value
    modal.style.display = 'none';
}

const traeDatos = (e) => {
    const button = e.target;
    const numero = button.dataset.id
    const dependencia = button.dataset.dependencia
    const llave = button.dataset.llave
    const tipo = button.dataset.tipo


    const dataset = {
        numero,
        llave,
        dependencia,
        tipo

    };


    colocarDatos(dataset);


};

const colocarDatos = (dataset) => {


    dependencias.value = dataset.llave;
    tipos.value = dataset.tipo;
    id.value = dataset.numero;

    btnGuardar.disabled = true
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.disabled = true
    btnBuscar.parentElement.style.display = 'none'
    btnModificar.disabled = false
    btnModificar.parentElement.style.display = ''
    btnCancelar.disabled = false
    btnCancelar.parentElement.style.display = ''



}

const cancelarAccion = () => {
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    divTabla.style.display = ''
    formulario.reset(); f
}

const modificar = async (evento) => {

    evento.preventDefault();


    const body = new FormData(formulario)
    const url = '/soliciudes_e/API/protocolos/modificar';
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
                formulario.reset();
                icon = 'success'
                buscar();
                cancelarAccion();
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
// buscar();





botonCancelar1.addEventListener('click', function() {
    // Agregar código para reiniciar el modal aquí
    
    // Cierra el modal
    modal.style.display = 'none';
});

botonGuardar2.addEventListener('click', agregarEsposaCivil );
formulario.addEventListener('submit', guardar);
// btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', cancelarAccion)
