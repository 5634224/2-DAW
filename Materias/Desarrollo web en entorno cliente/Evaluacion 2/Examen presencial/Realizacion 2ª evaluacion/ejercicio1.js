/*-- Declaración de variables --*/
const personas = Array("raul", "juan", "pedro", "Ana", "Maria", "Julia", "Alejandra");
let cargar_datos;
let lista_activos;
let lista_no_activos;
let bajar; // boton
let subir; // boton
let eliminar; // boton

/*-- Controla el evento DOMContentLoaded de la pagina --*/
document.addEventListener('DOMContentLoaded', () => {
    /*-- Inicialización de variables --*/
    cargar_datos = document.querySelector("#cargar_datos");
    lista_activos = document.querySelector("#lista_activos");
    lista_no_activos = document.querySelector("#lista_no_activos");
    bajar = document.querySelector("#bajar"); // boton
    subir = document.querySelector("#subir"); // boton
    eliminar = document.querySelector("#eliminar"); // boton

    /*-- Controla los eventos --*/
    cargar_datos.addEventListener("click", fCargarDatos);
    lista_activos.addEventListener("click", fSeleccionarItem); // Para controlar click sobre los "li" del "ul" de activos
    lista_no_activos.addEventListener("click", fSeleccionarItem); // Para controlar click sobre los "li" del "ul" de no activos
    bajar.addEventListener("click", fClickBajar);
    subir.addEventListener("click", fClickSubir);
    eliminar.addEventListener("click", fClickEliminar);
});

function fCargarDatos(evento) {
    this.disabled = true; // Deshabilita el botón una vez importa los nombres a la lista
    /*-- Añade los nombres a la lista --*/
    personas.forEach(persona => {
        let listItem = document.createElement("li");
        listItem.textContent = persona;
        lista_activos.append(listItem);
    });
}

function fSeleccionarItem(evento) {
    /*-- Obtiene el "li" que ha sido pulsado --*/
    let li = evento.target;

    /*-- Selecciona o desselecciona, en funcion de su estado actual --*/
    if (li.className != "") { // Estaba seleccionado, lo desselecciona
        li.className = "";
    } else { // No estaba seleccionado, lo selecciona
        li.classList.add("selected-item");
    }
}

/**
 * Este metodo controla el evento click para el boton bajar. Lo que hace es bajar las personas seleccionadas de "Activos" a "No activos".
 * @param {event} evento Objeto que contiene informacion sobre el evento
 */
function fClickBajar(evento) {
    /*-- Declaracion de variables --*/
    let seleccionados = document.querySelectorAll("#lista_activos .selected-item");
    
    /*-- Añade los elementos a la lista de no activos --*/
    seleccionados.forEach(persona => {
        lista_no_activos.append(persona);
        persona.classList.remove("selected-item");
    });
    /* Solo con añadirlos de una lista a otra, JavaScript entiende que se debe mover de una lista a otra,
    por lo que no es necesario eliminarlos manualmente de la primera lista.*/
}

function fClickSubir(evento) {
    /*-- Declaracion de variables --*/
    let seleccionados = document.querySelectorAll("#lista_no_activos .selected-item");
    
    /*-- Añade los elementos a la lista de no activos --*/
    seleccionados.forEach(persona => {
        lista_activos.append(persona);
        persona.classList.remove("selected-item");
    });
    /* Solo con añadirlos de una lista a otra, JavaScript entiende que se debe mover de una lista a otra,
    por lo que no es necesario eliminarlos manualmente de la primera lista.*/
    /* Lo que si ha hecho falta, es quitarles la clase de selected-item */
}

function fClickEliminar(evento) {
    /*-- Declaracion de variables --*/
    let seleccionados = document.querySelectorAll("#lista_no_activos .selected-item");

    /*-- Añade los elementos a la lista de no activos --*/
    seleccionados.forEach(persona => {
        persona.remove();
    });
}