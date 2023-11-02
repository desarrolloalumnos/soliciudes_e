import Swal from "sweetalert2";
import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioSalidasPais');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('tablaTransportes'); 
const catalogo = document.getElementById ('ste_cat'); 
const grado = document.getElementById('ste_gra');
const arma = document.getElementById('ste_arm');
const empleo = document.getElementById('ste_emp');
const comando = document.getElementById('ste_comando');
const observaciones = document.getElementById('sol_obs');
const motivos = document.getElementById('sol_motivo');


observaciones.disabled = true;
btnGuardar.parentElement.style.display = 'block';
btnBuscar.parentElement.style.display = 'block';
btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';




const guardar = async (evento) => {
    evento.preventDefault();
    
    
    if (!validarFormulario(formulario,['cmv_id']) ) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los campos'
        });
        return;
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
    
    motivos.addEventListener('change', () => {
        let motivo = motivos.value;
    
        if (motivo === "7") {
            observaciones.disabled = false;
        } else {
            observaciones.disabled = true;
        }
    });
             
    
    const buscarCatalogo = async () => {  
        
    let validarCatalogo = catalogo.value;
    
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
    console.log(datos)
    const dato = datos[0]
    arma.value = dato.per_arma;  
    catalogo.disabled = true;
    grado.value = dato.per_grado;
    empleo.value = dato.org_plaza_desc
    comando.value = dato.dep_llave
  
    
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
    const url = '/soliciudes_e/API/salidapaises/modificar';
    const headers = new Headers();
    headers.append("X-Requested-With","fetch");
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
                    headers.append("X-Requested-With","fetch");
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


  
formulario.addEventListener('submit', guardar);
// btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', cancelarAccion)



    