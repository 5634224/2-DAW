window.addEventListener('DOMContentLoaded', load);

function load() {
    /*-- Declaración de variables --*/
    let tabla = document.querySelector("table"); // Recupera la tabla del código HTML

    /*-- Añade filas y columnas a la tabla --*/
    for (let i = 0; i < 10; i++) { // Por cada fila
        /*-- Crea la fila --*/
        let fila = document.createElement("tr");
        fila.setAttribute("id", i + 1);
        for (let j = 0; j < 20; j++) { // Por cada columna
            /*-- Crea una celda con un botón --*/
            let celda = document.createElement("td");
            celda.setAttribute("id", (i + 1) + "-" + (j + 1));
            let boton = document.createElement("button");
            boton.addEventListener('click', buttonClicked);
            boton.classList.add("verde");

            /*-- Añade el boton a la celda --*/
            celda.append(boton);
            /*-- Añade la celda a la fila --*/
            fila.append(celda);
        }

        /*-- Añade la fila a la tabla --*/
        tabla.append(fila);
    }

    /*-- Añadir eventos --*/
    limpiar.addEventListener('click', flimpiar);
    guardar.addEventListener('click', fguardar);

    /*-- Carga los reservados --*/
    cargarReservados();
}

function cargarReservados() {
    let asientos = document.querySelectorAll("td button");
    if (localStorage.reservas) {
        for (let i = 0; i < localStorage.reservas.length; i++) {
            if (localStorage.reservas[i] == "1") {
                asientos[i].className = "gris";
            }
        }
    }
}

function buttonClicked(evento) {
    console.log(evento);
    let boton = evento.target;
    if (boton.classList.contains("verde")) {
        boton.classList.add("rojo");
        boton.classList.remove("verde");

        let reservas = document.querySelector("#totalReservas");
        reservas.value = parseInt(reservas.value) + 1;
    } else if (boton.classList.contains("rojo")) {
        boton.classList.remove("rojo");
        boton.classList.add("verde");

        let reservas = document.querySelector("#totalReservas");
        reservas.value = parseInt(reservas.value) - 1;
    }
    
}

function flimpiar() {
    let asientos = document.querySelectorAll('td button');
    let totalReservas = document.querySelector('#totalReservas');
    for (let i of asientos) {
        i.className = 'verde';
    }
    totalReservas.value = 0;
}

function fguardar() {
    let asientos = document.querySelectorAll('td button');
    let reservas = ''

    for (let i of asientos) {
        if (i.className == 'verde') {
            reservas += '0';
        } else if (i.className == 'rojo' || i.className == 'gris') {
            reservas += '1';
        }
    }
    console.log(reservas);

    localStorage.reservas = reservas;
    // totalReservas.value = 0;
}

