/*-- 1. Modifica el contenido del título, poniéndole tu nombre. --*/
document.querySelector("#titulo").innerHTML = "Santiago Francisco San Pablo Raposo";

/*-- 2. Modifica la imagen que muestra el segundo artículo --*/
document.querySelectorAll("img")[1].src = "noticia1.jpg";

/*-- 3. Modifica la imagen que muestra el segundo artículo --*/
document.querySelector(".fila:last-child article:last-child").style.display = "none";

/*-- 4. Recorre los artículos y añade al inicio de la cabecera el número de noticia (1 Hospitalizando...) --*/
//let noticias = document.querySelectorAll("article");
let noticias = document.querySelectorAll("article div:first-child");
for (let i = 0; i < noticias.length; i++) {
    noticias[i].prepend("" + (i + 1) + " ")
}

/*-- 5. Añade la clase cabecera (ya esta declarada en los estilos), al primer div de cada artículo --*/
//let divsNoticias = document.querySelectorAll("article div:first-child");
//for (let div of divsNoticias) {
for (let div of noticias) {
    div.classList.add("cabecera")
}

/*-- 6. Busca en todos los artículos donde aparece la cadena "Servicio Murciano de Salud", y sustitúyela por "S.M.S"(¿método replace de cadenas?). --*/

let sms = document.querySelectorAll('article div');
for (let s of sms) {
    // for (let c of s.childNodes) {
    //     c.
    // }
    s.textContent = s.textContent.replace("Servicio Murciano de Salud", "S.M.S");
}