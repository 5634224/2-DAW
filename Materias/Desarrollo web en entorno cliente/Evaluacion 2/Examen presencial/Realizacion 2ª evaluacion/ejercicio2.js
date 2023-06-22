/*-- Declaracion de variables --*/
let url = "https://reqres.in/api/users";
let tbody;
let btnAnterior;
let numPag; // Almacena el span HTML (el indicador que contiene el numero de pagina), no el numero de pagina en si
let btnSiguiente;
let maxPag;

/*-- Controla el evento DOMContentLoaded de la pagina --*/
document.addEventListener('DOMContentLoaded', () => {
    /*-- Inicialización de variables --*/
    tbody = document.querySelector("#container main table tbody");
    btnAnterior = document.querySelector("#btnAnterior");
    btnSiguiente = document.querySelector("#btnSiguiente");
    numPag = document.querySelector("#numPag");

    /*-- Controla los eventos --*/
    btnAnterior.addEventListener("click", fClickAnterior);
    btnSiguiente.addEventListener("click", fClickSiguiente);

    /*-- Carga los datos desde el servidor mediante AJAX --*/
    try {
        cargarDatos();
    } catch (error) {
        console.log(error)
    }
});

function cargarDatos(parametros = null) {
    /*-- Crea un objeto URL --*/
    let direccion = new URL(url);

    /*-- Insertamos parámetros (en caso de haberlos) --*/
    if (parametros) {
        for (let key in parametros) {
            direccion.searchParams.append(key, parametros[key]);
        }
    }
    
    /*-- Realiza la petición al servidor --*/
    fetch(direccion)
        .then(response => {
            // console.dir(response);
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("No se ha podido acceder a ese recurso. Status: " + response.status);
            }
        })
        .then(responseJson => mostrarDatos(responseJson))
        .catch(err => {throw new Error(err)});
}

function mostrarDatos(objJSON) {
    // console.dir(objJSON);
    /*-- Declaracion de objetos --*/
    let datos = objJSON.data; // Recuperamos nuestro array de datos

    /*-- Rellena la tabla --*/
    tbody.innerHTML = ""; // Vacia la tabla del contenido anterior que hubiera
    
    datos.forEach(persona => {
        /*-- Declaración de variables --*/
        let tdNombre = document.createElement("td");
        let tdCorreo = document.createElement("td");
        let tdAvatar = document.createElement("td");
        let avatar = document.createElement("img");

        /*-- Asigna el contenido en cada td --*/
        tdNombre.textContent = persona.first_name;
        tdCorreo.textContent = persona.email;
        avatar.src = persona.avatar;
        tdAvatar.append(avatar);

        /*-- Agrega todos los elementos a la fila --*/
        let fila = document.createElement("tr");
        fila.append(tdNombre, tdCorreo, tdAvatar);

        /*-- Agrega la fila a la tabla --*/
        tbody.append(fila);
    });

    /*-- Actualiza el número de página y el nº maximo de paginas disponibles --*/
    numPag.textContent = objJSON.page;
    maxPag = objJSON.total_pages;
}

function fClickAnterior() {
    /*-- Descarta que se pase del numero de pagina minimo (1) --*/
    let pageObjetivo = Number.parseInt(numPag.textContent) - 1;
    if (pageObjetivo < 1) {
        return;
    }

    /*-- Carga la pagina anterior solicitada --*/
    try {
        cargarDatos({page: pageObjetivo});
    } catch (error) {
        console.log(error);
    }
}

function fClickSiguiente() {
    /*-- Descarta que se pase del numero máximo de paginas --*/
    let pageObjetivo = Number.parseInt(numPag.textContent) + 1;
    if (pageObjetivo > maxPag) {
        return;
    }

    /*-- Carga la pagina anterior solicitada --*/
    try {
        cargarDatos({page: pageObjetivo});
    } catch (error) {
        console.log(error);
    }
}