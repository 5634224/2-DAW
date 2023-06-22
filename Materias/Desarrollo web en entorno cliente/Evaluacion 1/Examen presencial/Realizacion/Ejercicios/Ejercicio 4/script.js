/*-- Apartado a: mi nombre en h2 al principio del body --*/
let nombre = document.createElement("h2");
nombre.textContent = "Santiago";
document.body.prepend(nombre);
/*-- Apartado b: eliminar elemento imagen del logo --*/
let logo = document.querySelector(".logo > img");
logo.remove();
/*-- Apartado c: link al Carlos III --*/
let nav = document.querySelector("nav");
let linkCarlos = document.createElement("a");
linkCarlos.href = "https://cifpcarlos3.es";
linkCarlos.textContent = "CIFP Carlos III";
nav.append(linkCarlos);
/*-- Apartado d: cambiar sugerencias de busueda por Cartagena, Murcia... --*/
let busqueda = document.querySelector(".busqueda");
busqueda.setAttribute("placeHolder", "Cartagena, Murcia...");
/*-- Apartado e: sustituir todos los símbolos $ de la página por € --*/
let precios = document.querySelectorAll(".precio");
for (precio of precios) {
    precio.textContent = precio.textContent.replace("$", "€");
}
// document.body.innerHTML = document.body.innerHTML.replace("$", "€");

/*-- Apartado f: Selecciona todos aquellos elementos con la clase precio --*/
for (precio of precios) {
    precio.className = "paseo";
}
/*-- Apartado g: Elimina todo el contenido del footer --*/
let footer = document.querySelector("footer");
let hijos = Array.from(footer.children);
for (let i = 0; i < hijos.length; i++) {
    hijos[i].remove();   
}

/*-- Apartado h: modificar el ultimo enlace de la pagina para mostrar "Trabajo realizado por Santiago" --*/
let ultimoEnlace = document.querySelector(".btn-flotante");
ultimoEnlace.textContent = "Trabajo realizado por Santiago";
/*-- Apartado i: realiza una captura de pantalla del codigo e insertala en el footer --*/
let captura = document.createElement("img");
captura.src = "img/capturaCodigo.png";
footer.append(captura);
