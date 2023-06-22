/*=============================================
            VARIABLES GLOBALES
==============================================*/
let datos;
let tbody;

/*=============================================
            FUNCIONES Y EVENTOS
==============================================*/

document.addEventListener("DOMContentLoaded", () => {
    /*-- Obtiene los objetos de la pagina --*/
    const formulario = document.querySelector("form");
    const tabla = document.querySelector("table");
    tbody = tabla.querySelector("tbody");
    const error = document.querySelector(".error");

    /*-- Controla eventos --*/
    formulario.addEventListener("submit", form_onSubmit);

    /*-- Obtiene los datos de la API y los vuelca en la tabla --*/
    obtenerJSON('https://jsonplaceholder.typicode.com/users')
    .then(obj => {
        console.dir(obj)
        cargarTabla(obj, tbody);
            
        /*-- Muestra la tabla ya rellena --*/
        tabla.hidden = false;
        error.hidden = true;

        /*-- Almacena el objeto JSON en una variable global --*/
        datos = obj;
    })
    .catch(err => {
        tabla.hidden = true;
        error.textContent = err;
        error.hidden = false;
    })
});

/**
 * Función que carga los datos de un objeto JSON en una tabla HTML.
 * @param {object} objJSON Especifica el objeto JSON con los datos del servidor.
 * @param {object} tabla Especifica el objeto HTML <table>.
 * @param {function} condicion Especifica una función que se ejecutará como algoritmo para filtrar los resultados. Esta función deberá tener un parámetro elem, que corresponderá con un elemento del objeto JSON.
 */
function cargarTabla(objJSON, tabla, condicion = null) {
    /*-- Define el algoritmo --*/
    function cargar(elem) {
        /*-- Crea una nueva fila --*/
        let fila = document.createElement("tr");
        tabla.append(fila);

        /*-- Crea una celda para el Nombre --*/
        let nombre = document.createElement("td");
        nombre.textContent = elem.name;
        fila.append(nombre);

        /*-- Crea una celda para la calle --*/
        let calle = document.createElement("td");
        calle.textContent = elem.address.street;
        fila.append(calle);

        /*-- Crea una celda para la ciudad --*/
        let ciudad = document.createElement("td");
        ciudad.textContent = elem.address.city;
        fila.append(ciudad);
    }

    // if (typeof(objJSON) != "object") {
    //     throw new Error("El parámetro 'objJSON' debe ser un objeto JSON.")
    // }

    // if (typeof(tabla) != "object") {
    //     throw new Error("El parámetro 'tabla' debe corresponder con el objeto de la tabla HTML.")
    // }
    
    // if (typeof(condicion) != "function") {
    //     throw new Error("El parámetro 'condicion' debe ser una función.")
    // }

    /*-- Lo ejecuta solo si cumple la condicion (en caso de tenerla, si no la tiene, tambien se ejecuta) --*/
    for (let i of objJSON) {
        if (condicion == null) {
            cargar(i);
        } else {
            if (condicion(i)) {
                // console.dir(i);
                cargar(i);
            }
        }
    }
}

function form_onSubmit(evento) {
    /*-- Previene la acción submit por defecto --*/
    evento.preventDefault();
    
    /*-- Variables --*/
    const form = evento.target;

    /*-- Actualiza la tabla con los nuevos datos solicitados --*/
    tbody.innerHTML = ""; // Vacía el tbody para volver a rellenarlo

    cargarTabla(datos, tbody, (elem) => {
        let condicion = elem.name.includes(form[0].value);
        return condicion;
    });
}