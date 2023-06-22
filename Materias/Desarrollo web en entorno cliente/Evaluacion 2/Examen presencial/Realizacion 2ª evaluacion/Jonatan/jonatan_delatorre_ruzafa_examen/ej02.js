window.onload = function () {
    //Variables
    let tabla = document.getElementById("tabla");
    let numpag = document.getElementById("numpag");
    let retroceder = document.getElementById("retroceder");
    let avanzar = document.getElementById("avanzar");
    let maxpag; //Esta variable almacenará el número máximo de páginas al solicitar datos a la API

    //Funciones

    //Función para solicitar datos con un fetch
    function pedirDatos() {

        let url = ' https://reqres.in/api/users?page=' + numpag.textContent;

        fetch(url)
            .then((resultado) => {
                if (resultado.ok) {
                    return resultado.json();
                } else {
                    throw new Error('Se ha producido un error');
                }
            })
            .then((datos) => mostrarDatos(datos))
            .catch((error) => console.log(error));
    }

    //Función que me muestra los datos de forma dinámica
    function mostrarDatos(datos) {

        maxpag = datos.total_pages;

        tabla.innerHTML = "";

        for (let i = 0; i < datos.data.length; i++) {
            let fila = document.createElement("tr");

            let nombre = document.createElement("td");
            nombre.innerHTML = datos.data[i].first_name;
            fila.append(nombre);

            let correo = document.createElement("td");
            correo.innerHTML = datos.data[i].email;
            fila.append(correo);

            let campofoto = document.createElement("td");
            let foto = document.createElement("img");
            foto.setAttribute("src", datos.data[i].avatar);
            campofoto.append(foto);
            fila.append(campofoto);

            tabla.append(fila);
        }
    }

    //Función que suma uno al número de página si es posible y me cambia de página
    function sumarPag() {
        let valornumerico = parseInt(numpag.textContent);
        if (valornumerico != maxpag) {
            valornumerico++;
            numpag.textContent = valornumerico;
            pedirDatos();
        }
    }

    //Función que resta uno al número de página si es posible y me cambia de página
    function restarPag() {
        let valornumerico = parseInt(numpag.textContent);
        if (valornumerico != 1) {
            valornumerico--;
            numpag.textContent = valornumerico;
            pedirDatos();
        }
    }

    //Llamada principal a la función que iniciar la conexión con la API
    pedirDatos();

    //Eventos de los botones
    retroceder.addEventListener("click", restarPag);
    avanzar.addEventListener("click", sumarPag);

}