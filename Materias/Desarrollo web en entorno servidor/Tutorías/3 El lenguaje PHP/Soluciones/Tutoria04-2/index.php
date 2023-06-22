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
            if (isset($_POST["disparo"])) {
                $letra= substr($_POST["disparo"], 0,1);
                $fila=ord($letra)-ord("A");
                $num= substr($_POST["disparo"], 1);
                $columna = intval($num)-1;
                
                echo '<table border="1">';
                echo "<tr>";
                echo "<td></td>";
                for ($i=1;$i<11;$i++) {
                    echo "<td>$i</td>";
                }
                echo "</tr>";
                
                for ($i=0;$i<10;$i++) {
                    echo "<tr>";
                    $car=chr(65+$i);
                    echo "<td>$car</td>";
                    for ($j=0;$j<10;$j++) {
                        if ($i==$fila && $j==$columna) {
                            echo "<td>X</td>";
                        } else {
                            echo "<td>-</td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
        
        <form action="" method="post">
            <input type="text" name="disparo"><!-- comment -->
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
