document.addEventListener('DOMContentLoaded', () => {
    /*-- Declaración de variables --*/
    let form = document.querySelector("form");
    
    /*-- Controla el evento submit --*/
    form.addEventListener("submit", fSubmitForm);
});

function validarDNI(dni) {
    /*-- Descarta que sea null --*/
    if (!dni) return false;

    /*-- Descarta que no sea una cadena --*/
    if (typeof(dni) != "string") {
        return false;
    }
    
    /*-- Empieza la validación con la expresión regular --*/
    const expresion = /^(\d{8})([A-Z])$/;
    const datosDNI = expresion.exec(dni);
    if (!datosDNI) { // Si no valida la expresión regular
        return false;
    }

    /*-- Vamos a comprobar el número del DNI con el algoritmo propuesto por la página del gobierno de España --*/
    //https://www.interior.gob.es/opencms/es/servicios-al-ciudadano/tramites-y-gestiones/dni/calculo-del-digito-de-control-del-nif-nie/
    const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    const letra = datosDNI[2];
    const numero = Number.parseInt(datosDNI[1]); // Obtiene el número del DNI introducido
    
    /*-- Descarta que la letra introducida para el número de DNI especificado no sea válida --*/
    if (letra !== letras[numero % 23]) {
        return false;
    }

    /*-- Si pasa todas las verificaciones, el DNI es válido --*/
    return true;
}

function validarNombre(nombre) {
    /*-- Descarta que sea null --*/
    if (!nombre) return false;

    /*-- Descarta que no sea una cadena --*/
    if (typeof(nombre) != "string") {
        return false;
    }

    /*-- Empieza la validación con la expresión regular --*/
    let expresion = /^([A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]+)\s([A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]+)$/;
    return expresion.test(nombre);
}

function validarCiudad(ciudad) {
    /*-- Descarta que sea null --*/
    if (!ciudad) return false;

    /*-- Descarta que no sea una cadena --*/
    if (typeof(ciudad) != "string") {
        return false;
    }

    /*-- Empieza la validación con la expresión regular --*/
    let expresion = /^[A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]+$/;
    return expresion.test(ciudad);
}

function fSubmitForm(evento) {
    /*-- Comprueba el DNI --*/
    if (!validarDNI(this.elements.dni.value)) {
        this.elements.dni.className = "error";
        evento.preventDefault();
        this.elements.dni.blur(); // Hace que pierda el foco para que se vea el color rojo del borde del input, de error

        /*-- Crea un span de color rojo de error (solo si no existe ya previamente) --*/
        let error = this.dni.parentElement.lastElementChild;
        if (error instanceof HTMLSpanElement == false) {
            error = document.createElement("span");
            error.className = "rojo";
            error.textContent = "* DNI inválido";
            this.dni.parentElement.append(error); // Lo añade al div del campo del DNI
        }
        
    } else {
        this.elements.dni.className = "";

        /*-- Elimina el mensaje de error (si lo hubiera) --*/
        let error = this.dni.parentElement.lastElementChild;
        if (error instanceof HTMLSpanElement) {
            error.remove();
        }
    }

    /*-- Comprueba el nombre --*/
    if (!validarNombre(this.elements.nombre.value)) {
        /*-- Si no es válido el campo --*/
        this.elements.nombre.className = "error";
        evento.preventDefault();
        this.elements.nombre.blur(); // Hace que pierda el foco para que se vea el color rojo del borde del input, de error
        
        /*-- Crea un span de color rojo de error (solo si no existe ya previamente) --*/
        let error = this.nombre.parentElement.lastElementChild;
        if (error instanceof HTMLSpanElement == false) {
            error = document.createElement("span");
            error.className = "rojo";
            error.textContent = "* Nombre inválido";
            this.nombre.parentElement.append(error); // Lo añade al div del campo del Nombre
        }
        
    } else {
        this.elements.nombre.className = "";

        /*-- Elimina el mensaje de error (si lo hubiera) --*/
        let error = this.nombre.parentElement.lastElementChild;
        if (error instanceof HTMLSpanElement) {
            error.remove();
        }
    }

    /*-- Comprueba la ciudad --*/
    if (!validarCiudad(this.elements.ciudad.value)) {
        this.elements.ciudad.className = "error";
        evento.preventDefault();
        this.elements.ciudad.blur(); // Hace que pierda el foco para que se vea el color rojo del borde del input, de error

        /*-- Crea un span de color rojo de error (solo si no existe ya previamente) --*/
        let error = this.ciudad.parentElement.lastElementChild;
        if (error instanceof HTMLSpanElement == false) {
            error = document.createElement("span");
            error.className = "rojo";
            error.textContent = "* Ciudad inválida";
            this.ciudad.parentElement.append(error); // Lo añade al div del campo del Ciudad
        }
        
    } else {
        this.elements.ciudad.className = "";

        /*-- Elimina el mensaje de error (si lo hubiera) --*/
        let error = this.ciudad.parentElement.lastElementChild;
        if (error instanceof HTMLSpanElement) {
            error.remove();
        }
    }
}