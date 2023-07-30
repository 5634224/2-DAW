<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if (isset($_POST["anyo"])) {
                $a=$_POST["anyo"];
                $m=$_POST["mes"];
                
                echo '<table border="1">';
                echo "<tr><td>Lunes</td><td>Martes</td><td>Miércoles</td><td>Jueves</td><td>Viernes</td><td>Sábado</td><td>Domingo</td></tr>";
                $fecha=$a."-".$m."-1";  // Creamos un string con la fecha del primer día
                $f= strtotime($fecha);  // Pasamos la cadena a timestamp, un estándar de UNIX para marcar el tiempo
                
                $diasemana=date("N",$f); // Obtenemos el día de la semana por el que comienza ese mes
                
                echo "<tr>";
                for ($i=1;$i<$diasemana;$i++) {
                    echo "<td></td>";   //Rellenamos con huecos los días anteriores al 1. Por ejemplo, si empieza el mes en jueves habrá que poner 3 huecos
                }                
                
                $diasmes=date("t",$f);  // Nos devuelve el número de días de ese mes
                
                for ($i=1,$d=$diasemana;$i<=$diasmes;$i++,$d++) {
                    if ($d%1==1 && $i!=1) {
                        echo "<tr>";  // Si es un nuevo lunes, empezamos la semana
                    }
                    echo "<td>$i</td>"; // Escribimos el día
                    
                    if ($d%7==0) {  // Si es domingo, cerramos la semana
                        echo "</tr>";
                    }                    
                }
                
                if ($d%1!=1) {
                        echo "</tr>";  // Si el día 1 del mes siguiente no es lunes, hay que cerrar la última semana
                }
                
                echo "</table><br><br>";
                
            }
        
        ?>
        

        <form action="" method="post">
            Mes<select name="mes">
              
            <?php
                $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                
                for ($i=1;$i<=12;$i++) {    // Los valores de los años los introducimos con PHP, el bucle nos ahorra trabajo
                    echo '<option value="'.$i.'"';
                    
                    if ($_POST["mes"]==$i)
                        echo "selected";    // Dejamos marcado el mes que habíamos seleccionado previamente
                    echo ">";

                    echo $meses[$i-1];                                                                                        
                    echo '</option>';
                }            
            ?>                
                
            </select><br>
            
            
            Año<select name="anyo">
            <?php
                for ($i=2000;$i<2051;$i++) {    // Los valores de los años los introducimos con PHP, el bucle nos ahorra trabajo
                    echo '<option value="'.$i.'"';
                    
                    if ($_POST["anyo"]==$i)
                        echo "selected";    // Dejamos marcado el mes que habíamos seleccionado previamente
                    echo ">$i</option>";
                }            
            ?>
            </select><br> 
            
            <input type="submit" value="Enviar">
        </form>        
    </body>
</html>
