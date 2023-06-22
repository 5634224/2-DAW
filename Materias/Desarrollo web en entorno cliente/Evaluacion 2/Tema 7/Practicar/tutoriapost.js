let url = "https://raulserranoweb.es/rest/empleados/empleados.php";

//Variables
let contenedor = document.querySelector("#contenedor");
let nombre = document.querySelector("#nombre");
let dni = document.querySelector("#dni");
let insertar = document.querySelector("#insertar");
let eliminar = document.querySelector("#eliminar");
insertar.addEventListener("click", finsertar);
eliminar.addEventListener("click", feliminar);

mostrarPersonas();

// Funciones

function feliminar() {
    let parametros = new URLSearchParams();
    parametros.append("dni", numPersonas.value);

    fetch(url, {method: "POST", body:parametros})
        .then(respuesta => respuesta.json())
        .then(datos => {
            console.log(datos);
            mostrarPersonas();
        })
        .catch(e => alert(e.message));
}

function solicitarDatos() {
    fetch(url)
        .then(respuesta => respuesta.json())
        .then(datos => mostrarDatos(datos))
        .catch(e => alert(e.message));
}

function mostrarPersonas() {
    fetch(url)
        .then(respuesta)
}

function mostrarDatos(datos) {
    contenedor = contenedor.innerHTML = "";

    let lista = document.createElement('ol');
    contenedor.append(lista);
    for (let i of datos) {
        let elemento = document.createElement("li");
        lista.append(elemento);
        elemento.textContent = " Dni: " + i.dni + " Nombre: " + 
    }
}