<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caballo ajedrez</title>
        <style>
            td {
                width: 25px;
                height: 20px;
                text-align: center;
            }
            
            .back-azul {
                background-color: aqua;
            }
            
            .back-khaki {
                background-color: khaki;
            }
            
            .back-rojo {
                background-color: maroon;
            }
            
            .back-blanco {
                background-color: white;
            }
        </style>
    </head>
    <body>
        <?php
            /*===============================================
             *          DECLARACION DE CONSTANTES
             ================================================*/
            const casillas = 8;
            
            /*===============================================
             *          DECLARACION DE FUNCIONES
             ================================================*/
            
            /**
             * Funcion que permite inicializar un tablero de ajedrez.
             * @return La matriz que hace de tablero de ajedrez.
             */
            function inicializarTablero() {
                $tablero;
                for ($i = 0; $i < casillas; $i++) {
                    for ($j = 0; $j < casillas; $j++) {
                        $tablero[$i][$j] = "";
                    }
                }
                return $tablero;
            }
            
            /**
             * Función que devuelve la lista de movimientos a partir de la posicion actual del caballo.
             * @param type $fila Actual.
             * @param type $col Actual.
             * @return array Devuelve la lista de movimientos. Es un array de arrays de posiciones.
             */
            function getListaMovimientos($fila, $col) {
                $movimientos = array();
                
                if (($fila - 1) >= 0 && ($fila - 1) < casillas && ($col + 2) >= 0 && ($col + 2) < casillas) {
                    $movDerUp = array($fila - 1, $col + 2);
                    $movimientos[] = $movDerUp;
                }
                
                if (($fila + 1) >= 0 && ($fila + 1) < casillas && ($col + 2) >= 0 && ($col + 2) < casillas) {
                    $movDerDown = array($fila + 1, $col + 2);
                    $movimientos[] = $movDerDown;
                }
                
                if (($fila - 1) >= 0 && ($fila - 1) < casillas && ($col - 2) >= 0 && ($col - 2) < casillas) {
                    $movIzqUp = array($fila - 1, $col - 2);
                    $movimientos[] = $movIzqUp;
                }
                
                if (($fila + 1) >= 0 && ($fila + 1) < casillas && ($col - 2) >= 0 && ($col - 2) < casillas) {
                    $movIzqDown = array($fila + 1, $col - 2);
                    $movimientos[] = $movIzqDown;
                }
                
                if (($fila - 2) >= 0 && ($fila - 2) < casillas && ($col + 1) >= 0 && ($col + 1) < casillas) {
                    $movUpDer = array($fila - 2, $col + 1);
                    $movimientos[] = $movUpDer;
                }
                
                if (($fila - 2) >= 0 && ($fila - 2) < casillas && ($col - 1) >= 0 && ($col - 1) < casillas) {
                    $movUpIzq = array($fila - 2, $col - 1);
                    $movimientos[] = $movUpIzq;
                }
                
                if (($fila + 2) >= 0 && ($fila + 2) < casillas && ($col + 1) >= 0 && ($col + 1) < casillas) {
                    $movDownDer = array($fila + 2, $col + 1);
                    $movimientos[] = $movDownDer;
                }
                
                if (($fila + 2) >= 0 && ($fila + 2) < casillas && ($col - 1) >= 0 && ($col - 1) < casillas) {
                    $movDownIzq = array($fila + 2, $col - 1);
                    $movimientos[] = $movDownIzq;
                }
                
//                $movimientos = array(array($fila - 1, $col + 2), array($fila + 1, $col + 2), array($fila - 1, $col - 2), array($fila + 1, $col - 2),
//                    array($fila - 2, $col + 1), array($fila - 2, $col - 1), array($fila + 2, $col + 1), array($fila + 2, $col - 1));
                return $movimientos;
            }
            
            /**
             * Busca un movimiento en un array listaMovimientos. Si lo encuentra, devuelve su posicion dentro del array movimientos.
             * De lo contrario, devuelve -1
             * @param type $movimiento Array dupla de posición de fila + posición
             * @param type $listaMovimientos Array de duplas de posiciones de movimientos posibles
             */
            function buscarMovimiento($movimiento, &$listaMovimientos) {
                //print_r($listaMovimientos);
//                $mov = $listaMovimientos;
                for ($i = 0; $i < count($listaMovimientos); $i++) { // En cada movimiento de la lista de movimientos
                    $coordenadas = 0;
                    for ($j = 0; $j < count($listaMovimientos[$i]); $j++) { // Por cada coordenada
                        if ($movimiento[$j] == $listaMovimientos[$i][$j]) {
                            $coordenadas++;
                        } else {
                            $coordenadas = 0;
                        }
                    }
                    /*-- Verifica si se han obtenido las 2 coordenadas iguales --*/
                    if ($coordenadas == count($listaMovimientos[$i])) {
                        return $i;
                    }
                }
                /*-- Si no ha encontrado el movimiento --*/
                return -1;
            }
            
            /**
             * Función que permite mover una pieza de caballo por un tablero de ajedrez (matriz).
             * @param type $fila Especifica la fila de la matriz en la que se ha de posicionar el caballo.
             * @param type $col Especifica la columna de la matriz en la que se ha de posicionar el caballo.
             * @param type $tablero Especifica la matriz tablero.
             * @return array si logra posicionar el caballo en la posicion especificada por parametros segun los movimientos disponibles que se calculen, o string si devuelve un error.
             */
            function moverCaballo($fila, $col, &$tablero) {
                //var_dump($tablero);
                /*-- Descarta que la posicion indicada sea invalida --*/
                if (!($fila >= 0 && $col >= 0 && $fila < casillas && $col < casillas)) {
                    echo "El caballo no se puede mover a la posición " . $fila . ", " . $col;
                }
                
                /*-- Declaracion de variable para los posibles movimientos --*/
                $movimientos = getListaMovimientos($fila, $col);
                
                /*-- Descarta que la posicion a ocupar no estuviera ya ocupada --*/
                if (isset($tablero[$fila][$col]) && $tablero[$fila][$col] == 'X') {
                    return "Ese movimiento ya ha sido hecho anteriormente.";
                }
                
                /*-- Marca la nueva posicion del caballo --*/
                $tablero[$fila][$col] = 'C';
                
                /*-- Marca en el tablero los nuevos movimientos posibles, y si detecta alguna posicion anterior, la establece con X --*/
                for ($i = 0; $i < count($movimientos); $i++) {
                    /*-- Si el caballo estaba posicionado antes en esta posicion, lo marca con una X --*/
                    $x = $movimientos[$i][0];
                    $y = $movimientos[$i][1];
                    
                    if (isset($tablero[$x][$y]) && ($tablero[$x][$y] == 'C' || $tablero[$x][$y] == 'X')) {
                        $tablero[$x][$y] = 'X';
                        /*-- Modifica la lista de movimientos posibles quitando este movimiento --*/
                        $movimientos[$i][0] = -1;
                        $movimientos[$i][1] = -1;
                    }
                }
                
                /*-- Devuelve la lista de posibles movimientos para pasársela al método dibujarTabla --*/
                return $movimientos;
            }
            
            /**
             * Funcion que permite dibujar una tabla HTML con el tablero de
             * ajedrez, la posicion actual que ocupa el caballo, los posibles
             * siguientes movimientos, y los movimientos ya realizados.
             * @param type $tablero Especifica una matriz tablero de ajedrez.
             * @param type $movimientos Especifica un array de posiciones de movimientos posibles.
             * @return type Nada.
             */
            function dibujarTabla(&$tablero, $movimientos) {
                /*-- Comprueba --*/
//                var_dump($tablero);
//                var_dump($movimientos);
                if (gettype($movimientos) == 'string') { // Si devuelve un error la funcion moverCaballo en lugar del array de movimientos...
                    echo $movimientos;
                    return;
                }
                
                for ($i = 0; $i < count($tablero); $i++) { // Dentro de cada fila
                    echo "<tr>";
                    for ($j = 0; $j < count($tablero[$i]); $j++) { // Por cada columna
                        echo "<td";
                        /*-- Comprueba si es un movimiento posible, en cuyo caso, pone un botón para pulsar --*/
                        if (buscarMovimiento(array($i, $j), $movimientos) != -1) {
                            echo '>';
                            echo '<form action="" method="post">';
                            echo '<input type="text" name="posicion[]" value="' . $i . '" hidden>';
                            echo '<input type="text" name="posicion[]" value="' . $j . '" hidden>';
                            echo '<input type="submit" value="' . "M" . '">';
                            echo "</form>";
                        } else {
                            /*-- Si no es un movimiento posible, será otra cosa --*/
                            switch ($tablero[$i][$j]) {
                                case "C":
                                    echo ' class="back-khaki">';
                                    echo $tablero[$i][$j];
                                    break;
                                case "X":
                                    echo ' class="back-rojo">';
                                    echo $tablero[$i][$j];
                                    break;
                                default:
                                    echo ' class="back-azul">';
                                    echo "-";
                                    break;
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            }
            
            /*=================================
             *          GUION PHP
             =================================*/
            
            $movimientos;
            session_start();
            if (isset($_SESSION['tablero'])) {
                /*-- Comprueba si hay algún movimiento nuevo en el POST --*/
                if (isset($_POST['posicion'])) {
                    /*-- Añade el nuevo movimiento a la variable tablero de la sesion --*/
                    $movimientos = moverCaballo($_POST['posicion'][0],
                            $_POST['posicion'][1],
                            $_SESSION['tablero']);
                    $_SESSION['movimientos']++;
                } else if (isset($_POST['reset'])) {
                    /*-- Si se ha pulsado el boton de reiniciar tablero --*/
                    session_unset();
                    $_SESSION['tablero'] = inicializarTablero();
                    $movimientos = moverCaballo(0, 0, $_SESSION['tablero']);
                    $_SESSION['movimientos'] = 1;
                }
            } else {
                /*-- Si no hay nada en el session --*/
                $_SESSION['tablero'] = inicializarTablero();
                $movimientos = moverCaballo(0, 0, $_SESSION['tablero']);
                $_SESSION['movimientos'] = 1;
            }
        ?>
        <p id="puntuacion">
            Puntuación:
            <?php
                echo $_SESSION['movimientos'];
            ?>            
        </p>
        <table border="1">
            <tbody>
                <?php
                    $tablero = $_SESSION['tablero'];
                    dibujarTabla($tablero, $movimientos);
                ?>
            </tbody>
        </table>
        <p>
            <form action="" method="post">
                <input type="submit" name="reset" value="Reiniciar">
            </form>
        </p>
    </body>
</html>
