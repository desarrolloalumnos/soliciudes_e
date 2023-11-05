import Chart from "chart.js/auto";
import { Toast } from "../funciones";

const canvas = document.getElementById('chartAprobadas')
const btnActualizar = document.getElementById('btnActualizar')
const context = canvas.getContext('2d');


const chartReporteSol = new Chart(context, {
    type : 'doughnut',
    data : {
        labels : [],
        datasets : [
            {
                label : 'Cantidad',
                data : [],
                backgroundColor : []
            },
           
        ]
    },
    options : {
        indexAxis : 'y'
    }
})

const getEstadisticas = async () => {
    const url = `/soliciudes_e/API/solicitudes/estadistica/reportesolicitudes`;
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        console.log(data);

        chartReporteSol.data.labels = [];
        chartReporteSol.data.datasets[0].data = [];
        chartReporteSol.data.datasets[0].backgroundColor = []



        if(data){

            data.forEach( registro => {
                console.log(registro);
                chartReporteSol.data.labels.push(registro.sol_tipo);
                chartReporteSol.data.datasets[0].data.push(registro.cantidad);
                chartReporteSol.data.datasets[0].backgroundColor.push(getRandomColor())
            });

        }else{
            Toast.fire({
                title : 'No se encontraron registros',
                icon : 'info'
            })
        }
        
        chartReporteSol.update();
       
    } catch (error) {
        console.log(error);
    }
}

const getRandomColor = () => {
    const r = Math.floor( Math.random() * 256)
    const g = Math.floor( Math.random() * 256)
    const b = Math.floor( Math.random() * 256)

    const rgbColor = `rgba(${r},${g},${b},0.5)`
    return rgbColor
}

getEstadisticas();

btnActualizar.addEventListener('click', getEstadisticas )