window.addEventListener('DOMContentLoaded', inicio);

function inicio() {
    window.addEventListener('keydown', fteclado);

    let cuadrado1 = document.querySelector('#cuadrado1');
    let cuadrado2 = document.querySelector('#cuadrado2');
    let contenedor = document.querySelector("#contenedor");

    contenedor.addEventListener('click', fcuadrado);
    // contenedor.addEventListener('click', fcuadradosalir);

    /*cuadrado1.onclick = fcuadrado1;*/
    // cuadrado1.addEventListener('mouseover', fcuadrado);
    // cuadrado1.addEventListener('mouseout', fcuadradosalir);
    // cuadrado2.addEventListener('mouseover', fcuadrado);
    // cuadrado2.addEventListener('mouseout', fcuadradosalir);
}

function fteclado(evento) {
    alert('TECLA PULSADA');
    /*console.log(evento);*/
}

function fcuadrado(evento) {
    console.log(evento);
    evento.target.classList.remove('rojo');
    evento.target.classList.add('azul');
}

// function fcuadradosalir() {
//     this.classList.remove('azul');
//     this.classList.add('rojo');
// }