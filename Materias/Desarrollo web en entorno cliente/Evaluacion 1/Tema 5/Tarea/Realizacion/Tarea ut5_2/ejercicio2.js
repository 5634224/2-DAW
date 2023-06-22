/*-- 1. Un título con tu nombre --*/
let titulo = document.createElement("h1");
titulo.append("Ejercicio Santiago Francisco San Pablo Raposo");
document.body.append(titulo);

/*-- 2. Un elemento contenedor, que contendrá los artículos de la tienda --*/
let content = document.createElement("main");

/*-- 3. Cada artículo contiene un nombre, una descripción, un precio y una imagen. Estos datos los leemos
del array datos, que tenemos disponible en el archivo datos.js y ya se encuentra cargado en la web --*/
let fila;
let articulos = [];
for (let i = 0; i <= datos.length; i++) {
    /*-- Crea una nueva fila de articulos (si es necesario) --*/
    if ((i % 3 == 0 || (i / 3 == (datos.length - 1) / 3) && i < datos.length - 1)) {
        /*-- Primero añade a la página los 3 elementos ya creados --*/
        if (i != 0 || i == datos.length - 1) {
            for (let j = 0; j < articulos.length; j++) {
                fila.append(articulos[j]);
            }
            
            content.append(fila);
        }

        /*-- Crea otra nueva fila de otros 3 nuevos elementos --*/
        // if (i < datos.length - 1) {
            fila = document.createElement("section");
            articulos = [];
            //articulos = [document.createElement("article"), document.createElement("article"), document.createElement("article")];
        // }
    }

    if (i == datos.length && articulos.length > 0) {
        for (let j = 0; j < articulos.length; j++) {
            fila.append(articulos[j]);
        }

        content.append(fila);
    }

    /*-- Agrega los elementos al nuevo artículo --*/
    if (i < datos.length) {
        articulos.push(document.createElement("article")); // Prueba

        let texto = document.createElement("div");
        texto.insertAdjacentHTML("beforeend", datos[i].nombre);
        texto.insertAdjacentHTML("beforeend", "<br>");
        texto.append(datos[i].descripcion);
        texto.insertAdjacentHTML("beforeend", "<br>");
        texto.append(datos[i].precio + " €");
        texto.insertAdjacentHTML("beforeend", "<br>");
        articulos[i % 3].append(texto);
        let imagen = document.createElement("img");
        imagen.src = datos[i].imagen;
        articulos[i % 3].append(imagen);
    }
}
document.body.append(content);

/*-- 4. Añade las clases necesarias a los elementos y completa el archivo estilos.css --*/
content.classList.add("tb");
for (let i = 0; i < content.childNodes.length; i++) { //section
    // content.childNodes.item(i).classList.add("fl-row");
    // content.childNodes.item(i).classList.add("fl-ai");
    // content.childNodes.item(i).classList.add("fl-sb");
    content.childNodes.item(i).classList.add("fila");
    for (let j = 0; j < content.childNodes.item(i).childNodes.length; j++) { //article
        content.childNodes.item(i).childNodes.item(j).classList.add("celda");
        // let imagenes = content.querySelectorAll("img");
        // for (let k = 0; k < imagenes.length; k++) {
        //     imagenes[k].classList.add("img");
        // }
    }
}


// window.addEventListener("onresize", (e) => {
//     let imagenes = content.querySelectorAll("article img");
//     for (let i = 0; i < imagenes.length; i++) {
//         imagenes.item(i).style.height = window.innerWidth / 3 * 0.75;
//     }
// });


