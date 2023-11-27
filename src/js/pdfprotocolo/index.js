import Swal from "sweetalert2";

const btnBuscar = document.querySelector('form');

const buscar = async (event) => {
    event.preventDefault();

    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFin = document.getElementById('fechaFin').value;

    // Formatea las fechas al formato 'yyyy-mm-dd'

    const url = `/reporte_pdf2/pdf?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;

    try {
        const respuesta = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'fetch'
            }
        });

        if (respuesta.ok) {
            // Abre el PDF en una nueva ventana o pestaña del navegador
            const blob = await respuesta.blob();
            const urlBlob = window.URL.createObjectURL(blob);
            window.open(urlBlob, '_blank');
        } else {
            console.log('Error en la respuesta del servidor');
        }
    } catch (error) {
        console.log(error);
    }
}

btnBuscar.addEventListener('submit', buscar);
