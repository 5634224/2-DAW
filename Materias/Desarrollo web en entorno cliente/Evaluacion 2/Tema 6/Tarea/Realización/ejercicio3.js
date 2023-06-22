const nPartidos = 14;
document.addEventListener("DOMContentLoaded", () => {
    /*-- Crea un contenedor flex --*/
    const container = document.createElement("div");
    container.className = "f-column f-align-items-center f-justify-content-center";

    /*-- Crea la barra de arriba --*/
    const row1 = document.createElement("form"); // Barra de comprobacion
    row1.id = "barraComprobacion";
    // row1.className = "f-row f-justify-content-center";
    row1.className = "t-align-center";

    const btnComprobar = document.createElement("input");
    btnComprobar.type = "submit";
    btnComprobar.textContent = "COMPROBAR";

    const txtCombinacionGanadora = document.createElement("input");
    txtCombinacionGanadora.type = "text";
    txtCombinacionGanadora.maxLength = nPartidos;
    txtCombinacionGanadora.placeholder = "Combinación ganadora";
    // txtCombinacionGanadora.pattern = /[12Xx]{14}/;
    txtCombinacionGanadora.setAttribute("pattern", "[12Xx]+")

    row1.append(btnComprobar, " ", txtCombinacionGanadora);

    /*-- Crea la quiniela --*/
    const row2 = document.createElement("div"); // Div que contendrá la quiniela en sí
    row2.className = "f-column f-align-items-center";

    // let btnParagraph = document.createElement("p");
    const btnLimpiar = document.createElement("button"); // Botón de limpiar
    btnLimpiar.className = "d-inline-block";
    btnLimpiar.textContent = "LIMPIAR";

    const quiniela = document.createElement("table"); // Quiniela

    row2.append(btnLimpiar, document.createElement("br"), quiniela);

    let celdasSeleccionadas = new Array(); // Array de 14 posiciones que almacenará la celda seleccionada para cada fila
    for (let i = 0; i < nPartidos; i++) {
        let fila = document.createElement("tr");
        let uno = document.createElement("td");
        let equis = document.createElement("td");
        let dos = document.createElement("td");

        // celdasSeleccionadas[i] = [uno, equis, dos];

        uno.textContent = "1";
        equis.textContent = "X";
        dos.textContent = "2";

        fila.append(uno, equis, dos);

        quiniela.append(fila);
    }

    /*-- Crea un div donde diremos si la combinación es ganadora o no --*/
    const row3 = document.createElement("div");
    const mensaje = document.createElement("p");
    row3.append(mensaje);

    /*-- Añade controlador de evento para el clic dentro de la quiniela --*/
    quiniela.addEventListener("click", (evento) => {
        /*-- Declaración de variables --*/
        let celda = evento.target.closest("td");
        let fila = evento.target.closest("tr");

        /*-- Comprueba si se ha hecho clic en un td --*/
        if (!celda) return;
        
        /*-- Elimina la clase CSS "seleccionada" del td que hay actualmente seleccionado --*/
        if (celdasSeleccionadas[fila.rowIndex]) {
            celdasSeleccionadas[fila.rowIndex].className = "";
        }

        /*-- Aplica la clase a la celda seleccionada esta vez --*/
        celda.className = "seleccionada";

        /*-- Guarda la celda seleccinada en el array de celdas seleccionadas --*/
        celdasSeleccionadas[fila.rowIndex] = celda;
    });

    /*-- Añade el controlador para el botón de "Comprobar" --*/
    btnComprobar.addEventListener("click", (evento) => {
        /*-- Verifica que la combinación ganadora introducida cumple el formato de la expresión regular que le hemos asignado --*/
        if (!txtCombinacionGanadora.checkValidity()) {
            mensaje.textContent = "Por favor, introduce una combinación ganadora en el formato adecuado (1-X-2).";
            mensaje.className = "rojo";
            return;
        }

        /*-- Verifica que el cuadro de texto de la combinación ganadora está completo --*/
        if (txtCombinacionGanadora.value.length != nPartidos) {
            mensaje.textContent = "Por favor, introduce una combinación ganadora de 14 caracteres de longitud en el cuadro de texto.";
            mensaje.className = "rojo";
            return;
        }

        /*-- Descarta que no se haya seleccionado una combinación completa --*/
        if (celdasSeleccionadas.length != nPartidos) {
            mensaje.textContent = "Por favor, rellena los resultados de todos los partidos de la quiniela.";
            mensaje.className = "rojo";
            return;
        }

        /*-- Compara caracter a caracter la combinación con la cadena introducida en el input de la combinación ganadora --*/
        let aciertos = 0;
        let combinacionGanadora = txtCombinacionGanadora.value.toUpperCase();
        for (let i = 0; i < nPartidos; i++) {
            if (celdasSeleccionadas[i].textContent === combinacionGanadora[i]) {
                aciertos++;
            }
        }

        if (aciertos === nPartidos) {
            mensaje.textContent = "¡Enhorabuena! Has acertado los " + aciertos + " partidos.";
            mensaje.className = "verde";
        } else {
            mensaje.textContent = "¡Lo sentimos! Has acertado " + aciertos + " partidos.";
            mensaje.className = "rojo";
        }
    });

    /*-- Añade el controlador para el evento submit del botón "Comprobar" --*/
    row1.addEventListener("submit", (evento) => {
        evento.preventDefault();
    });

    /*-- Añade el controlador para el botón de "Limpiar" --*/
    btnLimpiar.addEventListener("click", (evento) => {
        celdasSeleccionadas.forEach((celda) => {
            celda.className = "";
        });
        celdasSeleccionadas = new Array(); // Vacía el array por completo
        mensaje.textContent = "";
    });

    /*-- Añade los elementos al body --*/
    container.append(row1, row2, row3);
    document.body.append(container);
});