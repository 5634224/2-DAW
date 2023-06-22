/*-- Fetch para GET --*/
let direccionGET = new URL("https://www.raulserranoweb.es/tienda/rest.php");
direccionGET.searchParams.append("key", "dato"); // Para añadir parámetros a la consulta, si lo necesitase

fetch(direccionGET)
        .then(response => {
            // console.dir(response);
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("No se ha podido acceder a ese recurso. Status: " + response.status);
            }
        })
        .then(responseText => fProcesarRespuestaGET(responseText))
        .catch(err => Error(err));

function fProcesarRespuestaGET(responseText) {
    let objJson = JSON.parse(responseText); // Si es un objeto JSON, lo convertimos para trabajar con él
    // Do anything con el objeto JSON
}

/*-- Fetch para POST --*/
let direccionPOST = "https://raulserranoweb.es/rest/empleados/empleados.php"
let parametros = new URLSearchParams() //En su defecto, se puede usar FormData, e incluso se puede vincular con un formulario HTML. new FormData(objHTMLForm)
parametros.append("key", datos[key]);

fetch(direccionPOST, {method: "POST", body: parametros})
    .then(response => {
        if (response.ok) {
            return response.text();
        } else {
            throw new Error("No se ha podido acceder a ese recurso. Status: " + response.status);
        }
    })
    .then(responseText => fProcesarRespuestaPOST)
    .catch(err => Error(err));

function fProcesarRespuestaPOST(responseText) {
    let objJson = JSON.parse(responseText); // Si es un objeto JSON, lo convertimos para trabajar con él
    // Do anything con el objeto JSON
}