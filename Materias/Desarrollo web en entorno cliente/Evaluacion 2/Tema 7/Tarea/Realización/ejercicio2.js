/*=============================================
            VARIABLES GLOBALES
==============================================*/
let main;
let categorias = new Set(); // https://es.javascript.info/map-set#set

/*=============================================
            FUNCIONES Y EVENTOS
==============================================*/

document.addEventListener("DOMContentLoaded", () => {
    /*-- Obtiene los objetos de la pagina --*/
    const select = document.querySelector("header select");
    main = document.querySelector("main");

    /*-- Controla eventos --*/
    select.addEventListener("change", sl_onChange);

    /*-- Obtiene los datos de la API y los vuelca en el main --*/
    main.innerHTML = "";
    getDatosFromAPI();
});

/**
 * Función que permite obtener los datos de la API realizando una petición HTTP, con una serie de parámetros (opcionales).
 * @param {object} parametros (Opcional) Objeto literal que contiene los parámetros que se le pasarán a la petición HTTP.
 */
function getDatosFromAPI(parametros = null) {
    obtenerJSON("https://www.raulserranoweb.es/tienda/rest.php", "GET", parametros)
        .then(obj => {
            // console.dir(obj); // Debug
            /*-- Carga las opciones del select --*/
            if (categorias.size == 0) {
                cargarSelect(obj)
            }

            /*-- Muestra la tabla ya rellena --*/
            cargarArticulos(obj, main);

            /*-- Almacena el objeto JSON en una variable global --*/
            datos = obj;
        })
        .catch(err => {
            let error = document.createElement("p");
            error.className = "error";
            error.textContent = err;
            main.append(error);
        });
}

/**
 * Función que carga las categorías de bicicletas en el select.
 * @param {object} objJSON Especifica el objeto JSON con los datos del servidor.
 */
function cargarSelect(objJSON) {
    /*-- Obtiene el select a manipular --*/
    const select = document.querySelector("header select");

    /*-- Carga las categorías en un conjunto (Set) y después las ordena alfabéticamente --*/
    for (let elem of objJSON) {
        categorias.add(elem.cat);
    }
    categorias = Array.from(categorias).sort();
    
    /*-- Despues las carga en el select --*/
    let opcionTodas = document.createElement("option");
    opcionTodas.value = "Todas";
    opcionTodas.textContent = "Todas";
    select.append(opcionTodas);
    for (let elem of categorias) {
        let opcion = document.createElement("option");
        opcion.value = elem;
        opcion.textContent = elem;
        select.append(opcion);
    }
}

/**
 * Función que carga los datos de un objeto JSON en una tabla creada a base de divs y flex como sistema de posicionamiento de los mismos.
 * @param {object} objJSON Especifica el objeto JSON con los datos del servidor.
 * @param {object} container Especifica el objeto HTML en el que se insertará.
 * @param {function} condicion Especifica una función que se ejecutará como algoritmo para filtrar los resultados. Esta función deberá tener un parámetro elem, que corresponderá con un elemento del objeto JSON.
 */
function cargarArticulos(objJSON, container, condicion = null) {
    /*-- Define el algoritmo --*/
    function cargar(elem) {
        /*-- Crea un nuevo elemento dentro del main --*/
        let articulo = document.createElement("article");
        articulo.className = "col";
        container.append(articulo);

        /*-- Crea una img --*/
        let contenedorImg = document.createElement("div");
        let imagen = document.createElement("img");
        imagen.src = "https://raulserranoweb.es/tienda/imagenes_art/" + elem.cod;
        contenedorImg.append(imagen);
        articulo.append(contenedorImg);

        /*-- Crea la descripcion del producto con la informacion requerida por el enunciado --*/
        let divText = document.createElement("div");
        let nombre = elem.nom;
        let descripcion = elem.des;
        let categoria = elem.cat;

        divText.insertAdjacentHTML("beforeend",
            "<b>Nombre:</b> " + nombre + "<br>" + 
            "<b>Descripci&oacute;n:</b> " + descripcion + "<br>" + 
            "<b>Categor&iacute;a:</b> " + categoria
        );

        articulo.append(divText);
    }

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

function sl_onChange(evento) {
    /*-- Variables --*/
    const sl = evento.target;

    /*-- Actualiza la tabla con los nuevos datos solicitados --*/
    main.innerHTML = ""; // Vacía el tbody para volver a rellenarlo
    getDatosFromAPI(sl.options.selectedIndex == 0 ? null : {cat: sl.options[sl.options.selectedIndex].value})
}