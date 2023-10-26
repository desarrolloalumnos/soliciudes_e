import Swal from "sweetalert2";
import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioProtocolos');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('tablaProtocolos'); 
const dependencias = document.getElementById ('cmv_dependencia');
const id= document.getElementById ('cmv_id');
const tipos = document.getElementById ('cmv_tip');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';


let contador = 1;
const datatable = new Datatable('#tablaProtocolos', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            className: 'text-center',
            width: 'auto',
            render: () => contador++
        },
        {
            title: 'Llave',
            className: 'text-center',
            width: 'auto',
            data: 'dep_llave'
        },
        {
            title: 'Dependencia',
            className: 'text-center',
            width: 'auto',
            data: 'cmv_dependencia'
        },
        {
            title: 'Tipo de evento',
            className: 'text-center',
            width: 'auto',
            data: 'cmv_tip'
        },
        {
            title: 'MODIFICAR',
            className: 'text-center',
            width: 'auto',
            data: 'cmv_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-dependencia='${row["cmv_dependencia"]}'data-llave='${row["dep_llave"]}' data-tipo ='${row["cmv_tip"]}' >Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            className: 'text-center',
            width: 'auto',
            data: 'cmv_id',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
    columnDefs: [
        {
            targets: 1,
            visible: false, 
            searchable: false, 
        }
    ]
});

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

const buscar = async () => {

    let dep_valor = dependencias.value 
    let tipo = tipos.value 
    
    const url = `/soliciudes_e/API/protocolos/buscar?cmv_dependencia=${dep_valor}&cmv_tip=${tipo}`;
    

    const config = {
        method: 'GET',
    }
    
    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log (data)
              
      
     
        datatable.clear().draw()
        if(data){
            contador = 1;
            datatable.rows.add(data).draw();
            
        }else{
            Toast.fire({
                title : 'No se encontraron registros',
                icon : 'info'
                
            })
        }
        
    } catch (error) {
        console.log(error);
    }
    formulario.reset();
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
    
    buscar();
}
buscar();



formulario.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', cancelarAccion)

