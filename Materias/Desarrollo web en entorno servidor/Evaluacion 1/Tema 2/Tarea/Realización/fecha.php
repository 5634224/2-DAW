<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Fecha</title>
    </head>
    <body>
        <?php
            /*=============================================================
             *    DECLARACION DE VARIABLES Y FUNCIONES IMPORTANTES
             ==============================================================*/
            $diasDeLaSemana = array("Lunes", "Martes", "Mi&eacutercoles", "Jueves", "Viernes", "S&aacutebado", "Domingo");
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        
            /**
             * Devuelve si un año es bisiesto o no.
             * @param type $anyo Especifica el año.
             * @return boolean true si es bisiesto, false si no.
             */
            function esBisiesto($anyo) {
                // Info: https://www.wikiwand.com/es/A%C3%B1o_bisiesto
                if ($anyo % 100 == 0) { // Si es año secular
                    return $anyo % 4 == 0 && $anyo % 400 == 0 ? true : false;
                } else { // Si no es un año secular
                    return $anyo % 4 == 0 ? true : false;
                }
            }
            
            /**
             * Devuelve el número de días de un mes.
             * @param int $numMes Especifica el mes.
             * @param int $anyo Especifica el año.
             * @return int El número de días de un mes.
             */
            function calcularDiasMes($numMes, $anyo) {
                switch ($numMes) {
                    /*-- Meses de 31 días --*/
                    case 1:
                    case 3:
                    case 5:
                    case 7:
                    case 8:
                    case 10:
                    case 12:
                        return 31;
                        break;
                    /*-- Meses de 30 días --*/
                    case 4:
                    case 6:
                    case 9:
                    case 11:
                        return 30;
                        break;
                    /*-- Febrero: caso especial --*/
                    case 2:
                        return 28 + esBisiesto($anyo) ? 1 : 0;
                        break;
                }
            }
        
            /*======================
             *      GUION PHP
             =======================*/
            date_default_timezone_set('Europe/Madrid'); // Establece antes de nada la zona horaria a la de Madrid
            $fecha = $_POST['fecha'];
            if (isset($fecha)) {
                /*-- Comprueba si la fecha tiene la longitud de 10 caracteres deseada (dd/mm/aaaa) --*/
                if (strlen($fecha) == 10) {
                    $datos = explode("/", $fecha);
                    if (count($datos) == 3) { // Comprueba que el array contiene día, mes y año
                        if (intval($datos[1]) > 0 && intval($datos[1]) < 13) { // Comprueba si el mes es correcto
//                            if ($datos[2] >= 1970) { // La marca temporal de UNIX trabaja con fechas a partir del 1 de enero de 1970
                                /*-- Calcular los días que tiene el mes de la fecha --*/
                                $diasMes = date("t", strtotime("$datos[2]/$datos[1]/1")); //calcularDiasMes(intval($datos[1]), $datos[2]);
//                                $prueba = "$datos[2]/$datos[1]/1";
//                                $pruebados = $datos[2] . "/" . $datos[1] . "/1";
//                                $pruebatres = sprintf("%d/%d/%d", $datos[2], $datos[1], 1);
                                /*-- Comprobar que el día introducido es válido --*/
                                if (intval($datos[0]) > 0 && intval($datos[0]) <= $diasMes) { //Fecha correcta
                                    /*-- Guarda la fecha en una marca temporal UNIX --*/
                                    $marcaTemporal = mktime(0, 0, 0, intval($datos[1]), intval($datos[0]), $datos[2]);
                                    
                                    /*-- Imprime por pantalla el día de la semana --*/
                                    $diaDeLaSemana = date("N", $marcaTemporal);
                                    echo "D&iacutea de la semana: " . $diasDeLaSemana[$diaDeLaSemana - 1] . "<br>";
                                    
                                    /*-- Imprime por pantalla el día del mes --*/
                                    echo "D&iacutea del mes: " . date("d", $marcaTemporal) . "<br>";
                                    //echo "D&iacutea del mes: " . intval($datos[0]) . "<br>";
                                    
                                    /*-- Imprime por pantalla el mes --*/
                                    echo "Mes: " . $meses[intval($datos[1]) - 1] . "<br>";
                                    
                                    /*-- Imprime por pantalla el año --*/
                                    echo "A&ntildeo: " . date("Y", $marcaTemporal) . "<br>";
                                    //echo "A&ntildeo: " . $datos[2];
                                    
                                    /*-- Imprime la fecha entera de la marca temporal interna --*/
                                    //echo date("r", $marcaTemporal);
                                } else {
                                    echo '<span style="color:red">';
                                    echo "Introduce un día válido para el mes de " . $meses[intval($datos[1]) - 1];
                                    echo "</span>";
                                }
//                            } else {
//                                echo '<span style="color:red">';
//                                echo "Introduce una fecha posterior al año 1970.";
//                                echo "</span>";
//                            }
                        } else {
                            echo '<span style="color:red">';
                            echo "Has introducido un mes que no existe. Por favor, introduce una fecha real.";
                            echo "</span>";
                        }
                    } else {
                        echo '<span style="color:red">';
                        echo "No has introducido una fecha correcta. Formato adecuado: dd/mm/aaaa";
                        echo "</span>";
                    }
                } else {
                    echo '<span style="color:red">';
                    echo "No has introducido una fecha correcta. Formato adecuado: dd/mm/aaaa";
                    echo "</span>";
                }
                
                /*-- Separa el resultado del formulario HTML --*/
                echo "<p>";
            }
        ?>
        
        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
            Escribe una fecha (dd/mm/aaaa): <input type='text' name='fecha' /><br>
            <input type='submit' value='Comprobar fecha' />
        </form>
    </body>
</html>
