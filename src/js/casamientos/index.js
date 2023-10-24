import { Carousel, Dropdown, Modal } from "bootstrap";
import { Toast, confirmacion, ocultarLoader, soloNumeros, validarFormulario }  from "../funciones";




const modalPuntosElement = document.querySelector('#modalPuntos')
const modalPuntos = new Modal(modalPuntosElement);
const formPuntos = document.querySelector('#formPuntos')
const formOperacion = document.querySelector('#formOperacion')
const inputCatalogo = document.querySelector('#ope_pla_cat_responsable');
const inputTelefono = document.querySelector('#ope_pla_tel_resp');
const inputArea = document.querySelector('#ope_pla_area');
const inputFechaInicio = document.querySelector('#ope_pla_inicia');
const inputFechaFIn = document.querySelector('#ope_pla_termina')
const selectOperaciones = document.querySelector('#ope_pla_operacion');
const nombreResponsable = document.querySelector('#nombreResponsable')
const areaResponsabilidad = document.querySelector('#areaResponsabilidad')
const carouselOperacionElement = document.querySelector('#carouselOperacion')
const btnAgregarVehiculo = document.querySelector('#btnAgregarVehiculo')
const btnQuitarVehiculo = document.querySelector('#btnQuitarVehiculo')
const btnAgregarInstitucion = document.querySelector('#btnAgregarInstitucion')
const btnQuitarInstitucion = document.querySelector('#btnQuitarInstitucion')
const btnLimpiarPuntos = document.querySelector('#btnLimpiarPuntos')
const divVehiculos = document.querySelector('#divVehiculos')
const divInstituciones = document.querySelector('#divInstituciones')
const tablaPuntos = document.querySelector("#tablaPuntos")
const apiKeyESRI = "AAPKeac49368553f4e4b831d13f125b711d3CeI6Xu_Q3MpirWVtO19GSFhKZIL_eOblhmUpNfv4HYhnvGzwpY_TiL-gjB5UL59w";
const carouselOperacion = new Carousel(carouselOperacionElement, {
  interval: 1000,
  ride: false,
  touch : false,
  keyboard: false,
  pause: false,
  wrap: false
})
let vehiculos = [], embarcaciones = [], aeronaves = [];
let instituciones = [];
let operaciones = [];
let contadorInputsVehiculos = 0;
let contadorInputsInstituciones = 0;
let latitudActual = 15.825158
let longitudActual =  -89.72959
let puntos = [];
let catalogoValido = false;
let fechaValida = false;
carouselOperacion.to(0);
carouselOperacion.pause()

/* FORMULARIO VEHICULOS E INSTITUCIONES */
const getVehiculos = async () => {
  try {
    const url = '/sicop3.0/API/planificarRRCCMM/buscar-vehiculos'
    const headers = new Headers();
    headers.append('X-Requested-With','fetch');
    const config = {
        method : 'GET',
        headers
    }

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // console.log(data)
    if(data){
      vehiculos = data;
    }
    // console.log(data);
  }catch(e){
    console.log(e)
  }

}
const getEmbarcaciones = async () => {
  try {
    const url = '/sicop3.0/API/planificarRRCCMM/buscar-embarcaciones'
    const headers = new Headers();
    headers.append('X-Requested-With','fetch');
    const config = {
        method : 'GET',
        headers
    }

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // console.log(data)
    if(data){
      embarcaciones = data;
    }
    // console.log(data);
  }catch(e){
    console.log(e)
  }

}
const getAeronaves = async () => {
  try {
    const url = '/sicop3.0/API/planificarRRCCMM/buscar-aeronaves'
    const headers = new Headers();
    headers.append('X-Requested-With','fetch');
    const config = {
        method : 'GET',
        headers
    }

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // console.log(data)
    if(data){
      aeronaves = data;
    }
    // console.log(data);
  }catch(e){
    console.log(e)
  }

}

const getInstituciones = async () => {
  try {
    const url = '/sicop3.0/API/planificarRRCCMM/buscar-instituciones'
    const headers = new Headers();
    headers.append('X-Requested-With','fetch');
    const config = {
        method : 'GET',
        headers
    }

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();

    if(data){
      instituciones = data;
    }
    // console.log(data);
  }catch(e){
    console.log(e)
  }
}

const getOperaciones = async () => {
  try {
    const url = '/sicop3.0/API/planificarRRCCMM/buscar-operaciones'
    const headers = new Headers();
    headers.append('X-Requested-With','fetch');
    const config = {
        method : 'GET',
        headers
    }

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();

    if(data){
      operaciones = data;
    }
    // console.log(data);
  }catch(e){
    console.log(e)
  }
}

const comprobarSeleccionInstituciones = (e) => {
  let selectsVehiculos = document.querySelectorAll('[id^=institucion]')
  selectsVehiculos.forEach(s => {
    if(s.value == e.target.value && s.id != e.target.id){
      Toast.fire({
        icon : 'warning',
        title : 'Esta institución ya fue seleccionada'
      })
      e.target.value = ''
      return;
    }
  })
}

const agregarInputsInstituciones = () => {
  const row = document.createElement('div')
  const col = document.createElement('div')
  const label = document.createElement('label')
  const select = document.createElement('select')
  const option = document.createElement('option')

  row.classList.add('row')
  col.classList.add('col')
  label.innerText = `Intitución ${++contadorInputsInstituciones}`
  select.classList.add('form-control','mb-2')
  select.name = 'instituciones[]'
  select.id = `institucion${contadorInputsInstituciones}`
  option.value = ''
  option.innerText = 'SELECCIONE...'
  select.appendChild(option);
  select.onchange = comprobarSeleccionInstituciones

  // console.log(vehiculos);
  instituciones.forEach(i => {
    const option = document.createElement('option')
    option.value = i.inst_codigo
    option.innerText = `${i.inst_descripcion}`
    select.appendChild(option);
  })

  col.appendChild(label)
  col.appendChild(select)
  row.appendChild(col)
  divInstituciones.appendChild(row)

}

const quitarInputsInstituciones = () => {
  if(contadorInputsInstituciones > 0){
    divInstituciones.removeChild(divInstituciones.lastElementChild)
    contadorInputsInstituciones--
  }else{
    Toast.fire({
      icon : 'warning',
      title : 'No hay campos para quitar'
    })
    return;
  }
}
const comprobarSeleccionVehiculos = (e) => {
  let selectsVehiculos = document.querySelectorAll('[id^=vehiculo]')
  selectsVehiculos.forEach(s => {
    if(s.value == e.target.value && s.id != e.target.id){
      Toast.fire({
        icon : 'warning',
        title : 'Este vehículo ya fue seleccionado'
      })
      e.target.value = ''
      return;
    }
  })
}

const agregarInputsVehiculos = () => {
  const row = document.createElement('div')
  const col = document.createElement('div')
  const label = document.createElement('label')
  const select = document.createElement('select')
  const option = document.createElement('option')

  row.classList.add('row')
  col.classList.add('col')
  label.innerText = `Vehículo ${++contadorInputsVehiculos}`
  select.classList.add('form-control','mb-2')
  select.name = 'vehiculos[]'
  select.id = `vehiculo${contadorInputsVehiculos}`
  option.value = ''
  option.innerText = 'SELECCIONE...'
  select.appendChild(option);
  select.onchange = comprobarSeleccionVehiculos

  let tipoVehiculo = document.querySelector('input[type="radio"][name^="checkVehiculo"]:checked').value
  let selectVehiculos = [];
  switch (tipoVehiculo) {
    case '1':
      selectVehiculos = aeronaves
      break;
    case '2':
      selectVehiculos = embarcaciones
      break;
    case '3':
      selectVehiculos = vehiculos
      break;
      
    default:
      selectVehiculos = vehiculos
        
      break;
  }
  selectVehiculos.forEach(v => {
    const option = document.createElement('option')
    option.value = v.id
    option.innerText = `${v.descripcion} catalogo(${v.catalogo}) placas(${v.placas})`
    select.appendChild(option);
  })

  col.appendChild(label)
  col.appendChild(select)
  row.appendChild(col)
  divVehiculos.appendChild(row)

}

const quitarInputsVehiculos = () => {
  if(contadorInputsVehiculos > 0){
    divVehiculos.removeChild(divVehiculos.lastElementChild)
    contadorInputsVehiculos--
  }else{
    Toast.fire({
      icon : 'warning',
      title : 'No hay campos para quitar'
    })
    return;
  }
}

navigator.geolocation.getCurrentPosition(position => {
  latitudActual = position.coords.latitude
  longitudActual = position.coords.longitude
  // console.log(position);
});

carouselOperacionElement.addEventListener('slide.bs.carousel', event => {
  setTimeout(function() {
    map.invalidateSize();
  
    map.setView( [latitudActual, longitudActual],15)

  }, 500);

 
})


/* FORMULARIO MAPA */

const map = L.map('mapaPlanificar', {
  center: [15.825158, -89.72959],
  zoom: 7.5,
  maxZoom: 15,
  minZoom: 4,
})

const markers = L.layerGroup();
markers.addTo(map)
const grayScale = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  maxZoom: 100,
  id: 'mapbox/streets-v11',
  tileSize: 512,
  zoomOffset: -1,
  accessToken: 'pk.eyJ1IjoiZGFuaWVsZmo5NzUiLCJhIjoiY2tpcWNlbHM0MXZmbDJ6dTZvdDV3NGticiJ9.7ciIi1FKO5-BqgE0zz5UFw'
}).addTo(map);

const onMapClick = e =>{
  const { lat, lng } = e.latlng;
  // console.log(e.latlng)
  // console.log(new latLng(15.508333333333333, -91.50555555555556).utm())
  let lugar = ''
  geocodificador.latlng(e.latlng).run((error, result, response)=>{
    lugar = result.address.Match_addr
    formPuntos.lugar.value = lugar;
  })
  formPuntos.reset();
  formPuntos.latitud.value = lat;
  formPuntos.longitud.value = lng;
  modalPuntos.show();
  

} 

let geocodificador = Geocoding.reverseGeocode({
  apikey: apiKeyESRI
})


let contadorPuntos = 0;
const actualizarTabla = () => {
  for (let i = tablaPuntos.rows.length - 1; i > 0; i--) {
    
    tablaPuntos.deleteRow(i);
  }
  const fragment = document.createDocumentFragment();
  if(puntos.length > 0){
    let i = 1;
    puntos.forEach(p => {
      let tr = document.createElement('tr')
      let tdNumero = document.createElement('td')
      let tdLatitud = document.createElement('td')
      let tdLongitud = document.createElement('td')
      let tdLugar = document.createElement('td')
      let tdBoton = document.createElement('td')
      let boton = document.createElement('button')
      boton.innerHTML = `<i class='bi bi-x-circle'></i>`
      boton.classList.add('btn','btn-danger','btn-sm') 
      boton.type = 'button'
      boton.addEventListener('click' , () => {
        quitarPunto(p.id)
      })
  
      tdLatitud.innerText = p.latitud
      tdLongitud.innerText = p.longitud
      tdLugar.innerText = p.lugar
      tdNumero.innerText = i++
      tdBoton.appendChild(boton)
  
      tr.appendChild(tdNumero)
      tr.appendChild(tdLatitud)
      tr.appendChild(tdLongitud)
      tr.appendChild(tdLugar)
      tr.appendChild(tdBoton)
      fragment.appendChild(tr)
    })
  }else {
    let tr = document.createElement('tr')
    let td = document.createElement('td')
    td.colSpan = 5
    td.innerText = 'Toque el mapa para ingresar un punto'
    tr.appendChild(td)
    fragment.appendChild(tr)
  }
  tablaPuntos.tBodies[0].appendChild(fragment)
}

const agregarPunto = e => {
  e.preventDefault();
  puntos = [...puntos, {
    id : contadorPuntos++,
    latitud : formPuntos.latitud.value,
    longitud : formPuntos.longitud.value,
    lugar : formPuntos.lugar.value,
  }]

  actualizarTabla();
  actualizarPuntosMapa();
  modalPuntos.hide();
  
}

const quitarPunto = id => {
  puntos = puntos.filter(p => p.id != id)
  contadorPuntos--;
  actualizarTabla();
  actualizarPuntosMapa();
}

const actualizarPuntosMapa = () => {
  markers.clearLayers()
  let i = 1;
  puntos.forEach(p => {
    let marker = L.marker([p.latitud, p.longitud], { icon : getIcon (i)} ).addTo(markers);
    marker.bindPopup(`<b>Punto ${i}</b><br>Latitud: ${p.latitud}<br>Longitud: ${p.longitud}<br>Lugar: ${p.lugar}`, {
      offset : [0, -30]
    })
    i++;
  })

  let puntosPolilyne = puntos.map(p => {
    return {lat: p.latitud, lng : p.longitud}
  })

  L.polyline(puntosPolilyne, {color: 'red'}).addTo(markers)

}

const getIcon = (numero) => {
  const icon = L.icon({
      iconUrl: `./images/green/marker${numero}.png`,
      iconSize: [35, 48],
      iconAnchor: [20, 48],
  });
  return icon;
}

const limpiarPuntos = () => {
  puntos = [];
  contadorPuntos = 0
  actualizarPuntosMapa()
  actualizarTabla();
}

const buscarCatalogo = async e => {
  let catalogo = e.target.value

  if(catalogo.length <6){
    catalogoValido = false;
    nombreResponsable.innerText = 'CATÁLOGO INVALIDO'
    nombreResponsable.classList.add('text-danger')
    nombreResponsable.classList.remove('text-success')
    return
  }
  try {
    const url = `/sicop3.0/API/planificarRRCCMM/buscar-catalogo?catalogo=${catalogo}`
    const headers = new Headers();
    headers.append('X-Requested-With','fetch');
    const config = {
        method : 'GET',
        headers
    }

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();

    if(data){
      catalogoValido = true
      nombreResponsable.innerText = `${data.grado} DE ${data.arma} ${data.nombre}`
      nombreResponsable.classList.remove('text-danger')
      nombreResponsable.classList.add('text-success')
    }else{
      Toast.fire({
        icon : 'warning',
        title : 'Ingrese un catálogo válido'
      })
      catalogoValido = false;
      nombreResponsable.innerText = 'CATÁLOGO INVALIDO'
      nombreResponsable.classList.add('text-danger')
      nombreResponsable.classList.remove('text-success')
    }
    // console.log(data);
  }catch(e){
    console.log(e)
  }
}

const seleccionarResponsabilidad  = e => {
  let option = e.target.selectedOptions[0]
  let responsabilidad = option.dataset.responsabilidad
  let tipo = option.dataset.tipo
  if(option.value != ''){
    areaResponsabilidad.innerText = `${responsabilidad} - ${tipo}`
  }else{
    areaResponsabilidad.innerText = ''
  }

}

const getOperacionesArea = (e) => {
  let area = e.target.value
  let operacionesFiltradas = operaciones.filter(o => o.ope_area_codigo == area)
  let option = document.createElement('option')
  selectOperaciones.innerHTML = ''
  option.innerText = "SELECCIONE..."
  selectOperaciones.appendChild(option)
  operacionesFiltradas.forEach( o => {
    let option = document.createElement('option')
    option.innerText = `${o.ope_descripcion} (${o.ope_observacion})`
    option.value = o.ope_codigo
    selectOperaciones.appendChild(option)
  })
} 

const validarFechas = (e) => {
  let fechaFin = inputFechaFIn.value, fechaInicio = inputFechaInicio.value
  if(fechaFin <= fechaInicio){
    fechaValida = false;
    Toast.fire({
      icon : 'warning',
      title : 'La fecha final no puede ser menor/igual a la inicial'
    })
    inputFechaFIn.value = ''
  }else{
    
    fechaValida = true;
  }
}

const guardarOperacion = async (e) => {
  e.preventDefault();
  const pregunta = await confirmacion();
  if(pregunta && validarGuardado()){
    try {
      const url = `/sicop3.0/API/planificarRRCCMM/guardar`
      const headers = new Headers();
      const body = new FormData(formOperacion)
      let arrayPuntos = puntos.map(p => [p.latitud, p.longitud])
      // console.log(arrayPuntos);
      puntos.forEach(p  => {
        body.append('latitudes[]', p.latitud)
        body.append('longitudes[]', p.longitud)
        body.append('lugares[]', p.lugar)
      })
      headers.append('X-Requested-With','fetch');
      const config = {
          method : 'POST',
          body,
          headers
      }
  
      const respuesta = await fetch(url, config);
      const data = await respuesta.json();
      // console.log(data);
      const { mensaje, codigo, detalle } = data;
        let icon = '';
        switch (codigo) {
            case 1:
                icon = "success"
                formOperacion.reset();
                limpiarPuntos();
                limpiarInputs();
                carouselOperacion.to(0);
                // buscar()
                break;
            case 2:
                icon = "warning"

                break;
            case 3:
                icon = "error"
                    
                break;
            case 4:
                icon = "error"
                console.log(detalle);
                break;
            
            

            default:
                icon = "info"
                break;
        }

        Toast.fire({
            icon,
            title: mensaje
        })
    }catch(e){
      console.log(e)
    }
  }
}

const limpiarInputs = e => {
  while (contadorInputsInstituciones > 0) {
    quitarInputsInstituciones();
  }

  while (contadorInputsVehiculos > 0 ) {
    quitarInputsVehiculos();
  }

  catalogoValido = false;
  fechaValida = false;
  nombreResponsable.innerText = ''
  areaResponsabilidad.innerText = ''
}

const validarGuardado = () => {
  if(!validarFormulario(formOperacion)){
    Toast.fire({
      icon : 'warning',
      title : 'Debe llenar todos los campos'
    })
    return false
  }

  if(!fechaValida){
    Toast.fire({
      icon : 'warning',
      title : 'Las fecha final es mayor a la inicial'
    })
    return false
  }

  if(!catalogoValido){
    Toast.fire({
      icon : 'warning',
      title : 'El catálogo ingresado es invalido'
    })
    return false
  }

  if(puntos.length < 1 ){
    Toast.fire({
      icon : 'warning',
      title : 'Debe ingresar al menos un punto'
    })
    return false
  }
  return true;
}

ocultarLoader();
getVehiculos();
getEmbarcaciones();
getAeronaves();
getInstituciones();
getOperaciones();
map.on("click", onMapClick)
btnAgregarVehiculo.addEventListener('click', agregarInputsVehiculos)
btnQuitarVehiculo.addEventListener('click', quitarInputsVehiculos);
btnAgregarInstitucion.addEventListener('click', agregarInputsInstituciones)
btnQuitarInstitucion.addEventListener('click', quitarInputsInstituciones);
btnLimpiarPuntos.addEventListener('click', limpiarPuntos )
formPuntos.addEventListener('submit', agregarPunto )
inputCatalogo.addEventListener('input', buscarCatalogo)
inputCatalogo.addEventListener('keypress', e => !soloNumeros(e) && e.preventDefault() )
inputTelefono.addEventListener('keypress', e => !soloNumeros(e) && e.preventDefault() )
inputArea.addEventListener('input', seleccionarResponsabilidad )
inputArea.addEventListener('change', getOperacionesArea)
inputFechaFIn.addEventListener('change', validarFechas )
inputFechaInicio.addEventListener('change', validarFechas )
formOperacion.addEventListener('submit', guardarOperacion)
