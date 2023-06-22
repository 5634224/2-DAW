document.addEventListener("DOMContentLoaded", () => {
    let contenedor = document.querySelector("#contenedor");
    let consulta = new XMLHttpRequest();

    consulta.addEventListener("readystatechange", fProcesarRespuesta);

    consulta.open('GET', 'http://ejemplo.php?p1=v1&p2=v1', true);
    consulta.send(null); //si usaramos post, en vez de null, tendriamos que pasar por parametro p1=v1&p2=v1
    

    function fProcesarRespuesta(e) {
        if (consulta.readyState == 4 && consulta.status == 200) {
            let alumnos = consulta.responseXML.getElementsByTagName('alumno');

            for (let i = 0; i < alumnos.length; i++) {
                contenedor.innerHTML += alumnos[i].getAttribute('nombre');
                contenedor.innerHTML += alumnos[i].getAttribute('apellido') + '<br/>';
            }
        }
        //readyState: 1(leyendo), 2(leído), 3(interactiva), 4(completo)
        //status: 200 OK, 404 NotFound…
    }
});