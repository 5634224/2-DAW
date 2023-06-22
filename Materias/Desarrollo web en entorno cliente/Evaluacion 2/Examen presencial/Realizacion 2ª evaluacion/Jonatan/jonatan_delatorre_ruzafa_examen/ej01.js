window.onload = function () {
    //Variables
    let personas= ["Jonatan","Paco","Pepe","María","Jose","Raúl"];
    let botoncargar = document.createElement('button');
    let botonbajar = document.createElement('button');
    let botoneliminar = document.createElement('button');
    let botonsubir = document.createElement('button');

    //Funciones
    
    //Función que carga todos los datos en la lista
    function cargarDatos () {
        for (let i = 0; i < personas.length; i++) {
            let elemlista = document.createElement("li");
            elemlista.innerHTML=personas[i];
            document.getElementById("activos").append(elemlista);
            elemlista.addEventListener("click",pulsarElemento);
        }
        botoncargar.setAttribute("disabled","");
    }

    //Función que al pulsar un elemento de la lista lo selecciona
    function pulsarElemento (e) {
        if (e.target.classList.contains("seleccionado")) {
            e.target.classList.remove("seleccionado");
        } else {
            e.target.classList.add("seleccionado");
        }
    }

    //Función que baja un elemento seleccionado si está en la zona de activos
    function bajarElemento () {
        let seleccionados=document.getElementById("activos").querySelectorAll(".seleccionado");
        
        for (let i = 0; i < seleccionados.length; i++) {
            seleccionados[i].classList.remove("seleccionado");
            document.getElementById("noactivos").append(seleccionados[i]);
        }
    }

    //Función que elimina un elemento seleccionado si está en la zona de no activos
    function eliminarElemento () {
        let seleccionados=document.getElementById("noactivos").querySelectorAll(".seleccionado");
        
        for (let i = 0; i < seleccionados.length; i++) {
            seleccionados[i].remove();
        }
    }

    //Función que sube un elemento seleccionado si está en la zona de no activos
    function subirElemento () {
        let seleccionados=document.getElementById("noactivos").querySelectorAll(".seleccionado");
        
        for (let i = 0; i < seleccionados.length; i++) {
            seleccionados[i].classList.remove("seleccionado");
            document.getElementById("activos").append(seleccionados[i]);
        }
    }
    
    //Botones y eventos
    botoncargar.innerHTML="Cargar Datos";
    document.body.prepend(botoncargar);
    botoncargar.addEventListener("click",cargarDatos);

    botonbajar.innerHTML="Bajar";
    document.getElementById("botonera").append(botonbajar);
    botonbajar.addEventListener("click",bajarElemento);

    botoneliminar.innerHTML="Eliminar";
    document.getElementById("botonera").append(botoneliminar);
    botoneliminar.addEventListener("click",eliminarElemento);

    botonsubir.innerHTML="Subir";
    document.getElementById("botonera").append(botonsubir);
    botonsubir.addEventListener("click",subirElemento);

}