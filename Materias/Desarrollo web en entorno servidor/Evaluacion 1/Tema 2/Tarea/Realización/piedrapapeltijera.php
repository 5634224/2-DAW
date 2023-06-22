<!DOCTYPE html>
<!--
Ejercicio 1 (piedrapapeltijera.php)

Tenemos un formulario con una lista desplegable mostrando los nombres "piedra",
"papel", "tijera". El usuario elige unode ellos y al hacer el envío del
formulario, el programa calculará aleatoriamente su juego (con la función rand)
y responderá si ha ganado el usuario, la máquina o si ha habido empate.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Piedra, papel, tijera</title>
    </head>
    <body>
        <?php
        /*-- Declaración de variables globales importantes --*/
            $arrayJugadas = array("Piedra", "Papel", "Tijera");
            $arrayWinners = array( //[jugadaJugador][jugadaMaquina]
                array("e", "m", "j"), // Cuando el jugador juega 0 (piedra)
                array("j", "e", "m"), // Cuando el jugador juega 1 (papel)
                array("m", "j", "e") // Cuando el jugador juega 2 (tijera)
            );
        
        /*-- Comprueba si se ha producido una jugada por parte del jugador --*/
            $jugadaJugador = $_POST["jugada"];
            if (isset ($jugadaJugador)) {
                /*-- Convierte a Integer e imprime por pantalla lo que el jugador ha jugado --*/
                settype($jugadaJugador, "integer");
                echo "El jugador juega: " . $arrayJugadas[$jugadaJugador];
                
                /*-- Juega la máquina e imprime su jugada --*/
                $jugadaMaquina = rand() % 3;
                echo "<p>La máquina juega: " . $arrayJugadas[$jugadaMaquina];
                
                /*-- Decide el ganador y lo muestra por pantalla --*/
                switch ($arrayWinners[$jugadaJugador][$jugadaMaquina]) {
                    case "e":
                        echo "<p>Empate";
                        break;
                    case "m":
                        echo "<p>Gana la m&aacutequina";
                        break;
                    case "j":
                        echo "<p>Gana el jugador";
                        break;
                }
            }
        ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <select name="jugada" autofocus="autofocus">
                <option value="0" <?php echo $_POST['jugada'] == "0" ? "selected" : "";?>>Piedra </option>
                <option value="1" <?php echo $_POST['jugada'] == "1" ? "selected" : "";?>>Papel </option>
                <option value="2" <?php echo $_POST['jugada'] == "2" ? "selected" : "";?>>Tijera </option>
            </select>
            <input type="submit" value="Jugar"/>
        </form>
    </body>
</html>
