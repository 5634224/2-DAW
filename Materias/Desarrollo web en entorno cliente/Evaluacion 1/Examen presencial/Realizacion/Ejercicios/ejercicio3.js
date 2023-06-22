class Ascensor {
    constructor(maximoPlantas) {
        this.maximo = maximoPlantas;
        this.planta = 0;
    }

    moverAscensor(planta) {
        /*-- Realiza comporbaciones antes de hacer la asignacion al atributo --*/
        if (!typeof(planta) == "number") {
            alert("No has introducido un numero.");
        }
        if (planta < 0) {
            alert("No se puede desplazar a plantas negativas.");
        }
        if (planta > this.maximo) {
            alert("Solamente hay " + this.maximo + " plantas.")
        }
        /*-- Empieza a subir el ascensor setInterval --*/
        let elemento = document.querySelector("#plantaactual");
        elemento.textContent = this.planta;
        let intervalo = setInterval(() => {
            /*-- Si ya ha terminado de subir --*/
            if (this.planta == planta) {
                clearInterval(intervalo);
                return;
            }
            /*-- Si no ha terminado de subir --*/
            if (planta < this.planta) {
                this.planta--;
            } else {
                this.planta++;
            }
            elemento.textContent = this.planta;
        }
        , 1000);
    }
}

let asc = new Ascensor(10);
asc.moverAscensor(5);
setTimeout(() => {
    asc.moverAscensor(2);
    setTimeout(() => {asc.moverAscensor(7);
    }, 4000); // delay de 2 segundos
    
}, 7000); // delay de 2 segundos
