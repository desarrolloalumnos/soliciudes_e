import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import 'chartjs-plugin-datalabels';
import Chart from "chart.js/auto";
import { Toast } from "../funciones";

const canvas = document.getElementById('chartEstados')
const btnActualizar = document.getElementById('btnActualizar')

const inputFechaInicio = document.getElementById('fechaInicio')
const inputFechaFin = document.getElementById('fechaFin')


const context = canvas.getContext('2d');
const canvas2 = document.getElementById('chartMotivos')
const context2 = canvas2.getContext('2d');


const chartEstados = new Chart(context, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: 'Estados de las solicitudes ',
                data: [],
                backgroundColor: []
            }
        ]
    },
    options: {
        indexAxis: 'x',
 
    }
});


const chartMotivos = new Chart(context2, {
    type : 'bar',
    data : {
        labels : [],
        datasets : [
            {
                label : 'Solicitudes',
                data : [],
                backgroundColor : []
            },
        
        ]
    },
    options : {
        indexAxis : 'x'
    }
});

const getEstadisticas = async () => {
    const fechaInicio=inputFechaInicio.value
    const fechaFin=inputFechaFin.value

    console.log(fechaInicio);
    
    console.log(fechaFin);

    const url = `/soliciudes_e/API/administraciones/estadistica?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
// console.log(data);
        if (data) {
            chartEstados.data.labels = ['Enviadas', 'Autorizadas', 'Rechazadas'];
            chartEstados.data.datasets[0].data = [data[0].enviadas, data[0].autorizadas, data[0].rechazadas];
            chartEstados.data.datasets[0].backgroundColor = [getRandomColor(), getRandomColor()];

            chartEstados.update();
            getEstadisticas2();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
        }
    } catch (error) {
        console.log(error);
    }
}



const getEstadisticas2 = async () => {
    const fechaInicio=inputFechaInicio.value
    const fechaFin=inputFechaFin.value
    const url = `/soliciudes_e/API/administraciones/estadistica2?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
    const config = {
        method: 'GET'
    }

   
    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        // console.log(data)
        // return
        chartMotivos.data.labels = [];
        chartMotivos.data.datasets[0].data = [];
        chartMotivos.data.datasets[0].backgroundColor = []



        if(data){

            data.forEach( registro => {
                chartMotivos.data.labels.push(registro.motivo)
                chartMotivos.data.datasets[0].data.push(registro.cantidad)
                chartMotivos.data.datasets[0].backgroundColor.push(getRandomColor())
            });

        }else{
            Toast.fire({
                title : 'No se encontraron registros',
                icon : 'info'
            })
        }
        
        chartMotivos.update();
       
    } catch (error) {
        console.log(error);
    }
}


const getRandomColor = () => {
    const r = Math.floor(Math.random() * 256)
    const g = Math.floor(Math.random() * 256)
    const b = Math.floor(Math.random() * 256)

    const rgbColor = `rgba(${r},${g},${b},0.5)`
    return rgbColor
}

getEstadisticas();

btnActualizar.addEventListener('click', getEstadisticas)