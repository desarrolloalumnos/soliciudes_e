import Swal from "sweetalert2";
import { Dropdown, Modal } from "bootstrap";
import 'chartjs-plugin-datalabels';
import Chart from "chart.js/auto";
import { Toast } from "../funciones";

const btnActualizar = document.getElementById('btnActualizar')

const inputFechaInicio = document.getElementById('fechaInicio')
const inputFechaFin = document.getElementById('fechaFin')


const canvas = document.getElementById('chartEstados')
const context = canvas.getContext('2d');
const canvas2 = document.getElementById('chartMotivos')
const context2 = canvas2.getContext('2d');
const canvas3 = document.getElementById('chartConcurrencia')
const context3 = canvas3.getContext('2d');
const canvas4 = document.getElementById('chartTop5')
const context4 = canvas4.getContext('2d');
const canvas5 = document.getElementById('chartTopPaises')
const context5 = canvas5.getContext('2d');


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

const chartConcurrencia = new Chart(context3, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: 'Top 5 ',
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

const chartTop5 = new Chart(context4, {
    type : 'pie',
    data : {
        labels : [],
        datasets : [
            {
                label : 'Oficiales',
                data : [],
                backgroundColor : []
            },
        
        ]
    },
    options : {
        indexAxis : 'x'
    }
});

const chartPaises = new Chart(context5, {
    type : 'bar',
    data : {
        labels : [],
        datasets : [
            {
                label : 'Paises Visitados',
                data : [],
                backgroundColor : []
            },
        
        ]
    },
    options : {
        indexAxis : 'x'
    }
});


const getTop5 = async () => {
    const fechaInicio = inputFechaInicio.value;
    const fechaFin = inputFechaFin.value;
    let url = `/soliciudes_e/API/administraciones/detalleOficialApi`;
    if (fechaInicio && fechaFin) {
        url += `?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
    }
    const config = {
        method: 'GET'
    };
    try {
        let data = [];
        if (fechaInicio && fechaFin) {
            const respuesta = await fetch(url, config);
            data = await respuesta.json();
        } else {
            const respuesta = await fetch(url, config);
            data = await respuesta.json();
            if (Array.isArray(data) && data.length === 0) {
                url = `/soliciudes_e/API/administraciones/detalleOficialApi`;
                const respuesta2 = await fetch(url, config);
                data = await respuesta2.json();
            }
        }

        chartTop5.data.labels = [];
        chartTop5.data.datasets[0].data = [];
        chartTop5.data.datasets[0].backgroundColor = [];

        if (Array.isArray(data) && data.length > 0) {
            data.forEach(registro => {
                chartTop5.data.labels.push(registro.solicitante);
                chartTop5.data.datasets[0].data.push(registro.cantidad);
                chartTop5.data.datasets[0].backgroundColor.push(getRandomColor());
            });

            chartTop5.update();
        } else {
            Toast.fire({
                title: 'No se encontraron registros para el top5 de solicitantes',
                icon: 'info'
            });
        }
        chartConcurrencia.update();
    } catch (error) {
        console.log(error);
    }
};


const getTopPaises = async () => {
    const fechaInicio = inputFechaInicio.value;
    const fechaFin = inputFechaFin.value;
    let url = `/soliciudes_e/API/administraciones/detallePaisesApi`;
    if (fechaInicio && fechaFin) {
        url += `?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
    }
    const config = {
        method: 'GET'
    };
    try {
        let data = [];
        if (fechaInicio && fechaFin) {
            const respuesta = await fetch(url, config);
            data = await respuesta.json();
        } else {
            const respuesta = await fetch(url, config);
            data = await respuesta.json();
            if (Array.isArray(data) && data.length === 0) {
                url = `/soliciudes_e/API/administraciones/detallePaisesApi`;
                const respuesta2 = await fetch(url, config);
                data = await respuesta2.json();
            }
        }

        chartPaises.data.labels = [];
        chartPaises.data.datasets[0].data = [];
        chartPaises.data.datasets[0].backgroundColor = [];

        if (Array.isArray(data) && data.length > 0) {
            data.forEach(registro => {
                chartPaises.data.labels.push(registro.pais);
                chartPaises.data.datasets[0].data.push(registro.cantidad_visitas);
                chartPaises.data.datasets[0].backgroundColor.push(getRandomColor());
            });

            chartPaises.update();
        } else {
            Toast.fire({
                title: 'No se encontraron registros para el el top de paises',
                icon: 'info'
            });
        }
        chartConcurrencia.update();
    } catch (error) {
        console.log(error);
    }
};



const getEstadisticas = async () => {
    const fechaInicio=inputFechaInicio.value
    const fechaFin=inputFechaFin.value


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
          
        } else {
            Toast.fire({
                title: 'No se encontraron registros en la situacion de solicitudes',
                icon: 'info'
            });
        }
    } catch (error) {
        console.log(error);
    }
}

const getConcurrencia = async () => {
    const fechaInicio=inputFechaInicio.value
    const fechaFin=inputFechaFin.value
    const url = `/soliciudes_e/API/administraciones/detalleConcurrenciaApi`;
    const config = {
        method: 'GET'
    }   
    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        // console.log(data);
        // return
        chartConcurrencia.data.labels = [];
        chartConcurrencia.data.datasets[0].data = [];
        chartConcurrencia.data.datasets[0].backgroundColor = [];
        
        if (data) {
            data.forEach(registro => {
                chartConcurrencia.data.labels.push(registro.dependencia);
                chartConcurrencia.data.datasets[0].data.push(registro.cantidad);
                chartConcurrencia.data.datasets[0].backgroundColor.push(getRandomColor());
            });
       
            chartConcurrencia.update();
        }else{
            Toast.fire({
                title : 'No se encontraron registros para concurrencias',
                icon : 'info'
            })
        }        
        chartConcurrencia.update();       
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
                title : 'No se encontraron registros en Motivos',
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

getTop5();
getTopPaises();
getConcurrencia();
btnActualizar.addEventListener("click", async (event) => {
    event.preventDefault();

    const fechaInicio = inputFechaInicio.value;
    const fechaFin = inputFechaFin.value;

    if (!fechaInicio || !fechaFin) {
        Swal.fire({
            icon: 'error',
            title: 'Fechas vacías',
            text: 'Por favor, ingresa ambas fechas.',
        });
        return;
    }

    const startDate = new Date(fechaInicio);
    const endDate = new Date(fechaFin);

    // Verifica que ambas fechas estén definidas
    if (isNaN(startDate.getTime()) || isNaN(endDate.getTime()) || startDate > endDate) {
        Swal.fire({
            icon: 'error',
            title: 'Rango de fechas inválido',
            text: 'Por favor, selecciona un rango de fechas válido.',
        });
        return;
    } 
    const diferenciaMeses = (endDate.getFullYear() - startDate.getFullYear()) * 12 +
        endDate.getMonth() - startDate.getMonth();

    if (diferenciaMeses !== 3) {
        Swal.fire({
            icon: 'error',
            title: 'Rango de fechas inválido',
            text: 'El rango de fechas debe ser exactamente de 3 meses.',
        });
        return;
    }

    try {
        // Fetch and update statistics
        await Promise.all([
            getEstadisticas(),
            getEstadisticas2(),
            getConcurrencia(),
            getTop5(),
            getTopPaises()
        ]);

        const totalCharts = 8;

        const chartsWithData = [
            chartEstados,
            chartMotivos,
            chartConcurrencia,
            chartTop5,
            chartPaises
        ].filter(chart => chart.data.labels.length > 0);

        if (chartsWithData.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'No hay registros',
                text: 'No existen registros para el rango de fechas seleccionado.',
            });
        } else {
            Toast.fire({
                title: "Estadísticas actualizadas",
                icon: "success",
            });
        }
    } catch (error) {
        console.error("Error al actualizar estadísticas", error);

        Toast.fire({
            title: "Error al actualizar estadísticas",
            icon: "error",
        });
    }
});
